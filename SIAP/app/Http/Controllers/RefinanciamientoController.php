<?php

namespace siap\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use siap\Cliente;
use siap\Cuenta;
use siap\DetalleLiquidacion;
use siap\TipoCredito;
use siap\Prestamo;
use siap\Negocio;
use siap\Codeudor;
use siap\TipoDesembolso;
use siap\Fecha;

use Carbon\Carbon;

class RefinanciamientoController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $usuarioactual = \Auth::user();
        $fecha_actual = Fecha::spanish();

        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('nombre', 'asc')->get();
        $interesList = DB::table('tipo_credito')->orderby('tipo_credito.interes', 'asc')->get();

        return view('tipoCredito.refinanciamiento.create', ["clientes" => $clientes, "interesList" => $interesList, "fecha_actual" => $fecha_actual, "usuarioactual" => $usuarioactual]);

    }

    public function store(Request $request)
    {
        $usuarioactual = \Auth::user();

        //Extraemos todos los datos del credito
        $fechacredito = $request->get('fechacredito');
        $fechacomienzo = $request->get('fechacomienzo');
        $tipo1 = $request->get('tipo1');                    // Cobro de comision
        $tipo2 = $request->get('tipo2');                    // Tipo de desembolso
        $numcheque = $request->get('numcheque');
        $cliente = Cliente::where('idcliente', $request->get('searchItem'))->first();
        $negocio = Negocio::where('idnegocio', $request->get('idnegocio'))->first();
        $idcodeudor = $request->get('idcodeudor');
        $codeudor = Codeudor::where('idcodeudor', $idcodeudor)->first();
        $tipoCredito = TipoCredito::where('idtipocredito',$request->get('idtipocredito'))->first();
        $monto = $request->get('monto');
        $cuota = $request->get('cuota');

        //se validan las fechas
        if ($fechacomienzo < $fechacredito) {
            Session::flash('ban',2);
            Session::flash('msj1', "La fecha de comienzo de la cartera de pagos -- ".($fechacomienzo)." -- debe ser mayor o igual a la fecha de creacion del credito -- ".$fechacredito." --");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan el cliente
        if (is_null($cliente)) {
            Session::flash('ban',2);
            Session::flash('msj2', "Hay un problema con el cliente, al parecer no se encuentra en nuesta base de datos");
            return view('tipoCredito.fracaso', ["clientes" => $clientes, "usuarioactual" => $usuarioactual]);
        }

        //se validan el negocio
        if (is_null($negocio)) {
            Session::flash('ban',2);
            Session::flash('msj3', "El cliente debe poseer un negocio activo");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan la tasa de interes
        if (is_null($tipoCredito)) {
            Session::flash('ban',2);
            Session::flash('msj4', "Debe seleccionar una tasa de interes de la lista");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();


        //Se valida que el cliente posea un credito abierto con ese negocio
        $cuenta = Cuenta::where('idnegocio', $negocio->idnegocio)->where('estado','=','ACTIVO')->first();        
        if (is_null($cuenta)) {
            Session::flash('ban',2);
            Session::flash('msj8', "El cliente -- ".$cliente->nombre." ".$cliente->apellido." -- no posee un credito en el cual -- refinanciar --");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //Se valida que el cliente no posea abonos pendientes de pago
        $banderaDetalleLiquidacion = DetalleLiquidacion::where('idcuenta', $cuenta->idcuenta)->where('estado', '=', 'ABONO')->first();
        if (!is_null($banderaDetalleLiquidacion)) {
            Session::flash('ban',2);
            Session::flash('msj9', "El cliente ".$cliente->nombre." ".$cliente->apellido." tiene abonos pendientes.");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual,"cuenta"=>$cuenta->idcuenta]);
        }

        $montoCapital = ((intdiv($monto, 50)) * 2.25) + $monto;

        // Validacion: Redefinir cuota
        $interesDiario = $montoCapital * $tipoCredito->interes;
        $interesDiario = round($interesDiario,2);

        if($interesDiario>$cuota){
        Session::flash('ban',2);
        Session::flash('msj6', "Debe redefinir la cuota, debe ser mayor de $".($interesDiario+0.01)."");
        return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual, "cuota"=>$interesDiario]);
        }

        //se valida que el cliente este apto para adquirir un nuevo credito
        if ($cliente->idcategoria == 5) {
            Session::flash('ban',1);
            Session::flash('msj7', "El cliente no es apto para adquirir un nuevo refinanciamiento, esta clasificado como categoria -- E --");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        $resultado = Self::calculoCredito($request->get('monto'), $request->get('cuota'), $request->get('credito'), $cliente->idcliente, $request->get('idnegocio'),$request->get('fechaCredito'));
        
        Session::flash('exito1', $resultado);

        $count = Cuenta::where('idnegocio',$request->get('idnegocio'))->where('estado','=','ACTIVO')->first();
        $prestamo = Prestamo::where('idprestamo',$count->idprestamo)->first();
        $negocio = Negocio::where('idnegocio',$request->get('idnegocio'))->first();

        if($resultado=='excede')
        {
            Session::flash('ban',1);
            Session::flash('error8', "El monto a refinanciar excede el total capital del credito anterior");
            return view('tipoCredito.fracaso', ["clientes" => $clientes, "usuarioactual" => $usuarioactual,"cuenta"=>$cuenta->idcuenta]);
        }
        $ok = Prestamo::actualizarEstado();
        return view('tipoCredito.exito', ["clientes" => $clientes, "usuarioactual" => $usuarioactual,"cuenta"=> $count,"persona"=>$cliente,"prestamo"=>$prestamo,"negocio"=>$negocio]);
        

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    /*
    Nombre: calculoCredito
    Objetivo: bifurca entre los diferentes tipos de creditos
    Autor: Lexan
    parámetros de entrada: monto, cuota,tipo del credito, ID de cliente y ID del negocio
    parámetros de salida: mensaje exito o fracaso.
     */
    public function calculoCredito($monto, $cuota, $tipo, $id, $idN,$fecha)
    {
        $usuarioactual = \Auth::user();
        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();
        //$saldoCapitalCreditoAnterior = Self::calculoSaldoCapital($idN);
        $saldoCapitalCreditoAnterior = DetalleLiquidacion::saldoCapital($idN);
        $montoCapitalInicial = ((intdiv($monto, 100)) * 4.50) + $monto;
        // $montoTotal = $saldoCapitalCreditoAnterior + $montoCapitalInicial;
        $montoTotal=$montoCapitalInicial;

        
        
        $cuenta = Cuenta::where('idnegocio', $idN)->where('estado','=','ACTIVO')->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
        $estadoanterior=$prestamo->estadodos;
        $cuotas = (Self::cuotasAtrasadas($cuenta->idcuenta))+1;

        $interesDiario = Self::getInteres($tipo,$montoTotal);

        if($saldoCapitalCreditoAnterior>$monto)
        {
            return 'excede';
        }

        DetalleLiquidacion::calculoN_modificado($cuenta->idcuenta);
        $n=DetalleLiquidacion::estados_cuotas($cuenta->idcuenta);


        

        if ($prestamo->estadodos=='ACTIVO') {
            $cuenta->capitalanterior = $saldoCapitalCreditoAnterior;
            $cuenta->mora = 0;
            $cuenta->cuotaatrasada = $cuotas;
            $cuenta->estado = 'INACTIVO';
            $cuenta->update();

           
            $prestamo->estadodos = 'CERRADO';
            
            $prestamo->update();

           
        } 
        
        if($prestamo->estadodos=='VENCIDO')
        {
            //$prestamo = Prestamo::where('idprestamo', $cuenta->idprestamo)->first();
            $fechaActual = Carbon::now();
            $fechaFinalizacionContrato = Carbon::parse($prestamo->fechaultimapago);
            $diasExpirados=$fechaActual->diffInDays($fechaFinalizacionContrato);
            $mora = $saldoCapitalCreditoAnterior * $cuenta->interes * $diasExpirados;
            

            $cuenta->capitalanterior = $saldoCapitalCreditoAnterior;
            $cuenta->mora = $mora;
            $cuenta->cuotaatrasada = $cuotas;
            $cuenta->estado = 'INACTIVO';
            $cuenta->update();

            $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
            
            $prestamo->estadodos = 'CERRADO';
            $prestamo->update();

        }

        switch ($tipo) {
            case 'normal':

                if ($montoTotal <= 80) {
                    $tipoCredito = 1;
                } elseif ($montoTotal > 80 && $montoTotal <= 105) {
                    $tipoCredito = 2;
                } else {
                    $tipoCredito = 3;
                }

                $idPrestamo = Self::insertarCuentaPrestamo($montoTotal, $cuota, $tipoCredito, $id, $idN,$monto,$cuenta->idcuenta,$fecha,$estadoanterior);

                Self::calculoDetalleLiquidacion($montoTotal, $tipoCredito, $cuota, $id, $idPrestamo, $idN,$fecha,$cuenta->idcuenta);
                return 'Refinanciamiento de tipo NORMAl guardado con exito';
                break;

            case 'preferencial':
                $tipoCredito = 4;
                $idPrestamo = Self::insertarCuentaPrestamo($montoTotal, $cuota, $tipoCredito, $id, $idN,$monto,$cuenta->idcuenta,$fecha,$estadoanterior);

                Self::calculoDetalleLiquidacion($montoTotal, $tipoCredito, $cuota, $id, $idPrestamo, $idN,$fecha,$cuenta->idcuenta);
                return 'Refinanciamiento de tipo Preferencial guardado con exito';

                break;

            case 'oro':
                $tipoCredito = 5;
                $idPrestamo = Self::insertarCuentaPrestamo($montoTotal, $cuota, $tipoCredito, $id, $idN,$monto,$cuenta->idcuenta,$fecha,$estadoanterior);

                Self::calculoDetalleLiquidacion($montoTotal, $tipoCredito, $cuota, $id, $idPrestamo, $idN,$fecha,$cuenta->idcuenta);
                return 'Refinanciamiento de tipo ORO guardado con exito';
                break;
        }

    }

    /*
    Nombre: cuotasAtrasadas
    Objetivo: cuenta el numero de cuotas atrasadas de un cliente
    Autor: Lexan
    parámetros de entrada: 
    parámetros de salida:
     */
    public function cuotasAtrasadas($cuenta)
    {
        //$cuenta = Cuenta::where('idnegocio', $idN)->first();
        $cuotas = DetalleLiquidacion::where('idcuenta', $cuenta)->where('estado', '=', 'ATRASO')->count();

        if (is_null($cuotas)) {
            return -1;
        } else {
            return $cuotas;
        }
    }

    /*
    Nombre: calcula el saldo del monto capital de la cuenta anterior.
    Objetivo: cuenta el numero de cuotas atrasadas de un cliente
    Autor: Lexan
    parámetros de entrada:
    parámetros de salida:
     */
    public function calculoSaldoCapital($idN)
    {
        $saldo = 0;
        $cuenta = Cuenta::where('idnegocio', $idN)->where('estado', '=', 'ACTIVO')->firstorFail();
        $detallesLiquidaciones = DetalleLiquidacion::where('idcuenta', $cuenta->idcuenta)->get();

        foreach ($detallesLiquidaciones as $detalle) {
            if (is_null($detalle->fechaefectiva) && !is_null($detalle->monto)) {
                $saldo = $detalle->monto;
            }
        }

        if (is_null($saldo)) {
            return 0;
        } else {
            return $saldo;
        }
    }

    /*
    Nombre: insertarCuentaPrestamodetalleLiquidacion
    Objetivo: crea la correspondiente cuenta a un cliente y la definiciones del prestamo asociado a la cuenta recien creada.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID del cliente.
    parámetros de salida: el ID del prestamo recien creado.
     */
    public function insertarCuentaPrestamo($montoCapital, $cuota, $tipoCredito, $id, $idN,$monto,$idcuenta,$date,$estadoanterior)
    {
        $nuevoTipoCredito = TipoCredito::where('idtipocredito', $tipoCredito)->first();
        $number = Self::numeroPrestamo($id);
        //se crea un nuevo prestamo
        $fechaUno= Carbon::parse($date);
        $prestamo = new Prestamo;
        $fecha = $fechaUno->addDay();
        $prestamo->fecha = $fecha->format('Y-m-d');
        $prestamo->monto = $montoCapital;
        $prestamo->cuotadiaria = $cuota;
        $prestamo->estado = 'REFINANCIAMIENTO';
        $prestamo->estadodos = 'ACTIVO';
        $prestamo->montooriginal = $monto;
        $prestamo->cuentaanterior = $idcuenta;
        $prestamo->save();

        //se crea una nueva cuenta
        $cuenta = new Cuenta;
        $cuenta->montocapital = $montoCapital;
        $cuenta->interes = $nuevoTipoCredito->interes;
        $cuenta->idtipocredito = $nuevoTipoCredito->idtipocredito;
        $cuenta->idprestamo = $prestamo->idprestamo;
        $cuenta->numeroprestamo = $number+1;
        $cuenta->idnegocio=$idN;
        $cuenta->estado = 'ACTIVO';
        $cuenta->estadocuenta=$estadoanterior;
        $cuenta->save();
        return $prestamo->idprestamo;
    }

    /*
    Nombre: calculoDetalleLiquidacion
    Objetivo: inserta la tuplas correspondientes a cada cuota de pago del credito.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID de cliente
    parámetros de salida: ninguno
     */
    public function calculoDetalleLiquidacion($montoCapital, $tipoCredito, $cuota, $id, $idPrestamo, $idN,$Date,$idCuenta)
    {
        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();
        $usuarioactual = \Auth::user();
        $nuevoTipoCredito = TipoCredito::where('idtipocredito', $tipoCredito)->first();
        $fechaDos= Carbon::parse($Date);
        $cuenta = Cuenta::where('idnegocio', $idN)->where('estado', '=', 'ACTIVO')->first();
        $cuentados = Cuenta::where('idcuenta',$idCuenta)->first();
        
 
        $interesDiario = $montoCapital * $nuevoTipoCredito->interes;
    
       /*  $detalleLiquidacion = new DetalleLiquidacion;
        $count = 0;
        $detalleLiquidacion->idcuenta = $cuenta->idcuenta;
        $detalleLiquidacion->fechadiaria = $fechaDos->format('Y-m-d');
        $detalleLiquidacion->estado = "ACTIVO";
        $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
        $detalleLiquidacion->contador = $count;
        //esta linea ingresaria el monto anterior 
       // $detalleLiquidacion->monto = $cuentados->capitalanterior;
        $detalleLiquidacion->save(); */
        
        $fecha = $fechaDos->addDay();

        $detalleLiquidacion = new DetalleLiquidacion;
        $count = 1;
        $detalleLiquidacion->idcuenta = $cuenta->idcuenta;
        $detalleLiquidacion->fechadiaria = $fecha->format('Y-m-d');
        $detalleLiquidacion->estado = "ACTIVO";
        $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
        $detalleLiquidacion->contador = $count;
        $detalleLiquidacion->save();

        while ($montoCapital > $cuota) {
            $count++;
            if ($cuota > $interesDiario) {
                $cuotaCapital = $cuota - $interesDiario;
            } else {
                Session::flash('error1', "Defina bien la cuota");
                return view('tipoCredito.refinanciamiento.create', ["clientes" => $clientes, "usuarioactual" => $usuarioactual]);
            }

            $montoCapital = $montoCapital - $cuotaCapital;
            $interesDiario = $montoCapital * $nuevoTipoCredito->interes;

            $detalleLiquidacion = new DetalleLiquidacion;

            $detalleLiquidacion->idcuenta = $cuenta->idcuenta;
            $fechadiaria = $fecha->addDay();
            $detalleLiquidacion->fechadiaria = $fechadiaria->format('Y-m-d');
            //  $detalleLiquidacion->monto = $montoCapital;
            //$detalleLiquidacion->interes = $interesDiario;
            $detalleLiquidacion->estado = "ACTIVO";
            $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
            $detalleLiquidacion->contador = $count;
           // $detalleLiquidacion->idcartera = $cliente->idcartera;
            $detalleLiquidacion->save();

        }

        //guarda la ultima fecha de pago
        $prestamo = Prestamo::where('idprestamo', $idPrestamo)->first();
        $prestamo->fechaultimapago = $detalleLiquidacion->fechadiaria;
        $prestamo->update();
    }


    public function getInteres($tipo,$montoCapital)
    {
        $tipoCredito=null;
        switch ($tipo) {
            case 'normal':

                if ($montoCapital <= 80) {
                    $tipoCredito = 1;
                } elseif ($montoCapital > 80 && $montoCapital <= 105) {
                    $tipoCredito = 2;
                } else {
                    $tipoCredito = 3;
                }

                break;

            case 'preferencial':
                $tipoCredito = 4;
               

                break;

            case 'oro':
                $tipoCredito = 5;
               
                break;
        }

        $nuevoTipoCredito = TipoCredito::where('idtipocredito', $tipoCredito)->first();
        $interes = $montoCapital * $nuevoTipoCredito->interes;
        return $interes;
    }

    public function validacion($tipo,$montoCapital)
    {
        switch ($tipo) {
            case 'normal':

                if ($montoCapital <= 80) {
                    $tipoCredito = 1;
                } elseif ($montoCapital > 80 && $montoCapital <= 105) {
                    $tipoCredito = 2;
                } else {
                    $tipoCredito = 3;
                }
                break;

            case 'preferencial':
                $tipoCredito = 4;
                break;

            case 'oro':
                $tipoCredito = 5;
                break;
        }

        return $tipoCredito;
    }


    public function numeroPrestamo($idcliente)
    {
        $consulta = DB::table('cuenta')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->where('negocio.idcliente','=',$idcliente)
        ->count();
        return $consulta;
    }

}
