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

    /*
    Nombre: create
    Objetivo: Formulario de refinanciamiento
    Autor: Lexan
    Fecha creación: 18-03-2019, 10:10
    Fecha modificacion: 18-03-2019, 10:10
    Parámetros de entrada: fechas, cuotas, montos, saldos anteriores
    Parámetros de salida: nuevo credito
     */
    public function create()
    {
        $usuarioactual = \Auth::user();
        $fecha_actual = Fecha::spanish();
        $clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('nombre', 'asc')->get();
        $interesList = DB::table('tipo_credito')->orderby('tipo_credito.interes', 'desc')->get();

        return view('tipoCredito.refinanciamiento.create', ["clientes" => $clientes, "interesList" => $interesList, "fecha_actual" => $fecha_actual, "usuarioactual" => $usuarioactual]);

    }

    /*
    Nombre: store
    Objetivo: metodo para guardar formulario de refinanciamiento
    Autor: Lexan
    Fecha creación: 18-03-2019, 10:10
    Fecha modificacion: 18-03-2019, 10:10
    Parámetros de entrada: fechas, cuotas, montos, saldos anteriores
    Parámetros de salida: nuevo credito
     */
    public function store(Request $request)
    {
        $usuarioactual = \Auth::user();

        //Extraemos todos los datos del credito
        $fechacredito = $request->get('fechacredito');
        $fechacomienzo = $request->get('fechacomienzo');
        $tipo1 = $request->get('tipo1');                    // Cobro de comision
        $tipo2 = $request->get('tipo2');                    // Tipo de desembolso
        $tipo3 = $request->get('tipo3');                    // Cancelar con Ref.
        $numcheque = $request->get('numcheque');
        $cliente = Cliente::where('idcliente', $request->get('searchItem'))->first();
        $negocio = Negocio::where('idnegocio', $request->get('idnegocio'))->first();
        $idcodeudor = $request->get('idcodeudor');
        $codeudor = Codeudor::where('idcodeudor', $idcodeudor)->first();
        $tipoCredito = TipoCredito::where('idtipocredito',$request->get('idtipocredito'))->first();
        $monto = $request->get('monto');
        $cuota = $request->get('cuota');

        //Estado Prestamo Anterior
        $capitalanterior = $request->get('capitalanterior');
        $cuotaatrasada = $request->get('cuotaatrasada');
        $mora = $request->get('mora');

        //se validan las fechas
        if ($fechacomienzo < $fechacredito) {

            // Se retornan las fechas a espaniol
            $f1 = new DetalleLiquidacion;
            $f1->fechadiaria = Carbon::parse($fechacredito);

            $f2 = new DetalleLiquidacion;
            $f2->fechadiaria = Carbon::parse($fechacomienzo);

            Session::flash('ban',2);
            Session::flash('msj1A', " -- ".$f1->fechadiaria->format('l j  F Y ')." -- ");
            Session::flash('msj1B', " -- ".$f2->fechadiaria->format('l j  F Y ')." -- ");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan el cliente
        if (is_null($cliente)) {
            Session::flash('ban',2);
            Session::flash('msj2', "Hay un problema con el cliente, al parecer no se encuentra en nuesta base de datos");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan el negocio
        if (is_null($negocio)) {
            Session::flash('ban',2);
            Session::flash('msj3', "No ha seleccionado negocio");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan la tasa de interes
        if (is_null($tipoCredito)) {
            Session::flash('ban',2);
            Session::flash('msj4', "Debe seleccionar una tasa de interes de la lista");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //Se valida que el cliente posea una cuenta activa con ese negocio
        $cuenta = Cuenta::where('idnegocio', $negocio->idnegocio)->where('estado','=','ACTIVO')->first();        
        if (is_null($cuenta)) {
            Session::flash('ban',2);
            Session::flash('msj8', "El cliente -- ".$cliente->nombre." ".$cliente->apellido." -- no posee una cuenta -- activa -- en la cual -- refinanciar --");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //Se valida que el cliente no posea abonos pendientes de pago
        $banderaDetalleLiquidacion = DetalleLiquidacion::where('idcuenta', $cuenta->idcuenta)->where('estado', '=', 'ABONO')->first();
        if (!is_null($banderaDetalleLiquidacion)) {
            Session::flash('ban',2);
            Session::flash('msj9', "El cliente ".$cliente->nombre." ".$cliente->apellido." tiene un -- abono -- pendiente.");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual,"cuenta"=>$cuenta->idcuenta]);
        }

        //Se obtiene el verdadero  monto capital
        switch ($tipo1) 
        {
            case 'SI':
              $montoCapital = ((intdiv($monto, 50)) * 2.25) + $monto;
            break;

            case 'NO':
                $montoCapital=$monto;
            break;
        }

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

        // se valida que el saldo capital anterior no exceda el nuevo monto a adquirir
        $liqui = DetalleLiquidacion::where('idcuenta',$cuenta->idcuenta)->where('abonocapital','pivote')->first();
        $saldoCapitalCreditoAnterior = $liqui->monto;

        if($saldoCapitalCreditoAnterior>$monto)
        {
            Session::flash('ban',2);
            Session::flash('msj10', "El monto a refinanciar excede el saldo capital del credito anterior");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual,"cuenta"=>$cuenta->idcuenta]);
        }

        //Se valida que el prestamo anterior no se encuentre cerrado
        $prestamo = Prestamo::where('idprestamo', $cuenta->idprestamo)->where('estadodos','=','CERRADO')->first();        
        if (!is_null($prestamo)) {
            Session::flash('ban',2);
            Session::flash('msj11', "El cliente -- ".$cliente->nombre." ".$cliente->apellido." -- tiene actualmente el prestamo anterior en estado -- cerrado --. No se puede -- refinanciar --");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        // ---------- Se procede a saldar la vieja cuenta ---------- //

        // Se pagan las cuotas con refinanciamiento y se actualizan los pagos de la antigua cuenta
        if ($tipo3 == 'SI') {
            $sms2 = Self::pagoCuotaConRefinanciamiento($cuenta->idcuenta, $cuotaatrasada);
            $updateCuentaAntigua = DetalleLiquidacion::calculoModificadoN($cuenta->idcuenta);

            // Se retorna el componente que fallo
            if ($sms2 != 'exito') {
                Session::flash('ban',2);
                Session::flash('cmp1', ''.$sms2);
                return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
            }

        }

        // Metodo para inactivar la cuenta y  cerrar prestamo, anterior
        Self::finalizarCuentaPrestamo($cuenta->idcuenta, $capitalanterior, $cuotaatrasada, $mora);

        // ---------- Se procede a tratar la nueva cuenta ---------- //

        // Metodo para crear el nuevo prestamo y la cuenta
        $idPrestamo = Self::insertarCuentaPrestamo($fechacredito, $fechacomienzo, $tipo1, $tipo2, $numcheque, $cliente->idcliente, $negocio->idnegocio, $idcodeudor,  $tipoCredito->idtipocredito, $monto, $cuota, $cuenta->idcuenta);

        // creacion de la cartera de pagos
        $idcuenta = DetalleLiquidacion::calculoDetalleLiquidacion($montoCapital, $tipoCredito->idtipocredito, $cuota, $idPrestamo,$fechacomienzo);

        //Se actualizan las liquidacines creadas --pivote--
        $sms = DetalleLiquidacion::calculoModificadoN($idcuenta);
        // Se retorna el componente que fallo
        if ($sms != 'exito') {
            Session::flash('cmp1', ''.$sms);
        }

        Session::flash('ban',2);
        Session::flash('exito1', ''.' Credito de tipo -- '.$tipoCredito->nombre.' -- guardado con exito');

        $cuentaNueva = Cuenta::where('idprestamo',$idPrestamo)->first();
        $prestamo = Prestamo::where('idprestamo',$idPrestamo)->first();

        return view('tipoCredito.exito', ["usuarioactual" => $usuarioactual,"cuenta"=> $cuentaNueva,"persona"=>$cliente,"prestamo"=>$prestamo,"negocio"=>$negocio]);
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
    Nombre: insertarCuentaPrestamodetalleLiquidacion
    Objetivo: crea la correspondiente cuenta a un cliente y la definiciones del prestamo asociado a la cuenta recien creada.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID del cliente.
    parámetros de salida: el ID del prestamo recien creado.
     */
    public function insertarCuentaPrestamo($fechacredito, $fechacomienzo, $tipo1, $tipo2, $numcheque, $idcliente, $idnegocio, $idcodeudor,  $idtipocredito, $monto, $cuota, $idcuenta)
    {
        $tipoCredito = TipoCredito::where('idtipocredito', $idtipocredito)->first();
        $codeudor = Codeudor::where('idcodeudor', $idcodeudor)->first();

        $number = Self::numeroPrestamo($idcliente);
        $fecha= Carbon::parse($fechacredito)->format('Y-m-d');
        $fechacomienzo= Carbon::parse($fechacomienzo)->format('Y-m-d');

        //se crea un nuevo prestamo
        $prestamo = new Prestamo;
        $prestamo->fecha = $fecha;
        $prestamo->fechacomienzo = $fechacomienzo;

        switch ($tipo1) 
        {
            case 'SI':
              $montoCapital = ((intdiv($monto, 50)) * 2.25) + $monto;
            break;

            case 'NO':
                $montoCapital=$monto;
            break;
        }

        switch ($tipo2) 
        {
            case 'SI':
              $prestamo->idtipodesembolso = 1;
            break;

            case 'NO':
                $prestamo->idtipodesembolso = 2;
                $prestamo->numerocheque = $numcheque;
            break;
        }

        if(!is_null($codeudor)){
            $prestamo->idcodeudor = $codeudor->idcodeudor;
        }

        $prestamo->monto = $montoCapital;

        $prestamo->cuotadiaria = $cuota;
        $prestamo->estado = 'REFINANCIAMIENTO';
        $prestamo->estadodos = 'ACTIVO';
        $prestamo->montooriginal = $monto;
        $prestamo->cuentaanterior = $idcuenta;
        $prestamo->save();

        //se crea una nueva cuenta
        $cuenta = new Cuenta;
        $cuenta->idtipocredito = $tipoCredito->idtipocredito;
        $cuenta->idprestamo = $prestamo->idprestamo;
        $cuenta->idnegocio=$idnegocio;
        $cuenta->montocapital = $montoCapital;
        $cuenta->interes = $tipoCredito->interes;
        $cuenta->numeroprestamo = $number+1;
        $cuenta->estado = 'ACTIVO';
        $cuenta->save();
        return $prestamo->idprestamo;
    }


    public function numeroPrestamo($idcliente)
    {
        $consulta = DB::table('cuenta')
        ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
        ->where('negocio.idcliente','=',$idcliente)
        ->count();
        return $consulta;
    }

    /*
    Nombre: autoCompleteSaldos
    Objetivo: Metodo para mostrar los saldos que quedan de la cuenta anterior al refinanciamiento
    Autor: Steven
    Fecha creación: 20-03-2019, 10:10
    Fecha modificacion: 20-03-2019, 10:10
    Parámetros de entrada: idnegocio
    Parámetros de salida: saldos de cuenta anterior (cuotaatrasada, saldocapital, mora)
     */
    public function autoCompleteSaldos(Request $request,$idnegocio)
    {
       if($request->ajax()){
            
            $negocio = Negocio::where('idnegocio', $idnegocio)->first();
            
            //Se valida que el cliente posea un credito abierto con ese negocio
            $cuenta = Cuenta::where('idnegocio', $negocio->idnegocio)->where('estado','=','ACTIVO')->first();
            if (is_null($cuenta)) {
                $var = "noPoseeCreditoAbierto";
                return response()->json($var);
            } 

            //Se valida que el cliente no posea abonos pendientes de pago
            $pago = DetalleLiquidacion::where('idcuenta', $cuenta->idcuenta)->where('estado', '=', 'ABONO')->first();
            if (!is_null($pago)) {
                $var = "abonoPendiente";
                return response()->json($var);
                #"El cliente tiene abono pendiente"
            }

            $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();

            $cuenta->cuotaatrasada = DetalleLiquidacion::estadoCuentaRef($cuenta->idcuenta,1);
            $cuenta->capitalanterior = DetalleLiquidacion::estadoCuentaRef($cuenta->idcuenta,2);
            $cuenta->mora = DetalleLiquidacion::estadoCuentaRef($cuenta->idcuenta,3);
            $cuenta->estadocuenta = $cuenta->estado;    //solamente el cambio de campo
            $cuenta->estado = $prestamo->estadodos;

           return response()->json($cuenta);
       }
    }


    /*
    Nombre: finalizarCuentaPrestamo
    Objetivo: Metodo para inactivar la cuenta y  cerrar prestamo, anterior
    Autor: Steven
    Fecha creación: 18-03-2019, 10:10
    Fecha modificacion: 18-03-2019, 10:10
    Parámetros de entrada: idcuenta, capitalanterior, cuotaatrasada, mora\
    Parámetros de salida: Cuenta Inactiva y Prestamo Cerrado
     */
    public function finalizarCuentaPrestamo($idcuenta, $capitalanterior, $cuotaatrasada, $mora){
        //Recupero la cuenta y el prestamo
        $cuenta = Cuenta::where('idcuenta',$idcuenta)->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();

        $cuenta->capitalanterior = $capitalanterior;
        $cuenta->cuotaatrasada = $cuotaatrasada;
        $cuenta->mora = $mora;
        $cuenta->estado = 'INACTIVO';
        $cuenta->update();

        $prestamo->estadodos = 'CERRADO';
        $prestamo->update();
    }

    /*
    Nombre: pagoCuotaConRefinanciamiento
    Objetivo: Se pagan las cuotas con refinanciamiento y se actualizan los pagos de la antigua cuenta
    Autor: Steven
    Fecha creación: 18-03-2019, 19:24
    Fecha modificacion: 18-03-2019, 19:24
    Parámetros de entrada: idcuenta y cuotaatrasada
    Parámetros de salida: Cuotas -- CANCELADO CON REF. --
     */
    public function pagoCuotaConRefinanciamiento($idcuenta, $cuotaatrasada){

        $usuarioactual=\Auth::user();

        try{
            DB::beginTransaction();

            //Encontramos la cuenta con sus repectivas relaciones
            $cuenta = Cuenta::findOrFail($idcuenta);
            $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
            $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

            $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion', 'asc')
            ->get();

            //Obtenemos la fecha de hoy
            $fechaefectiva = Carbon::now();
            $fechaefectiva = $fechaefectiva->format('Y-m-d');

            $monto_capital = $prestamo->monto;          //  $313.50

            $i = $cuotaatrasada;

            foreach ($liquidaciones as $liq) {

                if($liq->abonocapital == "NO") {

                  $liq->monto = round($monto_capital, 2);
                  $liq->interes = round($monto_capital * $tipo_credito->interes, 2);    // 3.14
                  $liq->totaldiario = round($liq->totaldiario, 2);                      // 10
                  $liq->cuotacapital = round($liq->totaldiario - $liq->interes,2);      // 6.86
                  //$liq->update();

                  $monto_capital = $liq->monto - $liq->cuotacapital;

                }
                elseif($liq->abonocapital == "SI"){

                    $liq->monto = round($monto_capital,2);
                    //$liq->update();

                    $monto_capital = $liq->monto - $liq->totaldiario;

                }elseif($i > 0){                                              // Modificamos la siguiente tupla

                    if ($monto_capital > $prestamo->cuotadiaria) {                                // 10

                        $liq->monto = round($monto_capital, 2);                                  //$276.64
                        $liq->interes = round($monto_capital * $tipo_credito->interes, 2);
                        $liq->cuotacapital = round($prestamo->cuotadiaria - $liq->interes,2);
                        $liq->totaldiario = $prestamo->cuotadiaria;
                        $liq->fechaefectiva = $fechaefectiva;
                        $liq->estado = 'CANCELADO CON REF.';
                        $liq->abonocapital = 'NO';
                        $liq->update();

                        $monto_capital = $liq->monto - $liq->cuotacapital;

                    }elseif($monto_capital <= $prestamo->cuotadiaria && $monto_capital > 0){

                        $liq->monto = round($monto_capital, 2);                                  //$276.64
                        $liq->interes = round($monto_capital * $tipo_credito->interes, 2);
                        $liq->cuotacapital = $liq->monto;
                        $liq->totaldiario = round($liq->interes + $liq->cuotacapital,2);;
                        $liq->fechaefectiva = $fechaefectiva;
                        $liq->estado = 'CANCELADO CON REF.';
                        $liq->abonocapital = 'NO';
                        $liq->update();

                        $monto_capital = $liq->monto - $liq->cuotacapital;                  // $0.00
                    }

                    $i = $i - 1; 
                }
            }

            DB::commit();
            $msj = 'exito';

        } catch(\Exception $e)
        {
            DB::rollback();
            $msj = 'pagoCuotaConRefinanciamiento';
        }

        return $msj;
    }

}
