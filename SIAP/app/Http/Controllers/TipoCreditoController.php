<?php

namespace siap\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use siap\Cliente;
use siap\Cuenta;
use siap\DetalleLiquidacion;
use siap\Prestamo;
use siap\TipoCredito;
use siap\Negocio;
use siap\Codeudor;
use siap\TipoDesembolso;
use siap\Fecha;

class TipoCreditoController extends Controller
{

    /*
    Nombre: create
    Objetivo: Formulario de financiamiento
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

        return view('tipoCredito.completo.create', ["clientes" => $clientes, "interesList" => $interesList, "fecha_actual" => $fecha_actual, "usuarioactual" => $usuarioactual]);
    }

    /*
    Nombre: store
    Objetivo: metodo para guardar formulario de financiamiento
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

            // Se retornan las fechas a espaniol
            $f1 = new DetalleLiquidacion;
            $f1->fechadiaria = Carbon::parse($fechacredito);

            $f2 = new DetalleLiquidacion;
            $f2->fechadiaria = Carbon::parse($fechacomienzo);

            Session::flash('bandera',1);
            Session::flash('msj1A', " -- ".$f1->fechadiaria->format('l j  F Y ')." -- ");
            Session::flash('msj1B', " -- ".$f2->fechadiaria->format('l j  F Y ')." -- ");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan el cliente
        if (is_null($cliente)) {
            Session::flash('bandera',1);
            Session::flash('msj2', "Hay un problema con el cliente, al parecer no se encuentra en nuesta base de datos");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan el negocio
        if (is_null($negocio)) {
            Session::flash('bandera',1);
            Session::flash('msj3', "No ha seleccionado negocio");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se validan la tasa de interes
        if (is_null($tipoCredito)) {
            Session::flash('bandera',1);
            Session::flash('msj4', "Debe seleccionar una tasa de interes de la lista");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        //se comprueba que el cliente solicitante no posea un credito abierto.
        $cuenta = Cuenta::where('idnegocio','=',$request->get('idnegocio'))->where('estado','=','ACTIVO')->first();
        #$clientes = DB::table('cliente')->where('estado','=','ACTIVO')->orderby('cliente.apellido', 'asc')->get();

        if (!is_null($cuenta)) {
            Session::flash('bandera',1);
            Session::flash('msj5', "El negocio del cliente ".$cliente->nombre." ".$cliente->apellido." ya posee una cuenta activa");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual, "idcliente"=>$cliente->idcliente]);    
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
            Session::flash('bandera',1);
            Session::flash('msj6', "Debe redefinir la cuota, debe ser mayor de $".($interesDiario+0.01)."");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual, "cuota"=>$interesDiario]);
        }

        //se valida que el cliente este apto para adquirir un nuevo credito
        if ($cliente->idcategoria == 5) {
            Session::flash('bandera',1);
            Session::flash('msj7', "El cliente no es apto para adquirir un nuevo credito completo, esta clasificado como categoria -- E --");
            return view('tipoCredito.fracaso', ["usuarioactual" => $usuarioactual]);
        }

        // Metodo para crear el nuevo prestamo y la cuenta
        $idPrestamo = Self::insertarCuentaPrestamo($fechacredito, $fechacomienzo, $tipo1, $tipo2, $numcheque, $cliente->idcliente, $negocio->idnegocio, $idcodeudor,  $tipoCredito->idtipocredito, $monto, $cuota);

        // creacion de la cartera de pagos
        $idcuenta = DetalleLiquidacion::calculoDetalleLiquidacion($montoCapital, $tipoCredito->idtipocredito, $cuota, $idPrestamo,$fechacomienzo);

        //Se actualizan las liquidacines creadas --pivote--
        $sms = DetalleLiquidacion::calculoModificadoN($idcuenta);
        // Se retorna el componente que fallo
        if ($sms != 'exito') {
            Session::flash('cmp1', ''.$sms);
        }

        Session::flash('bandera',1);
        Session::flash('exito1', ''.' Credito de tipo -- '.$tipoCredito->nombre.' -- guardado con exito');

        $cuentaNueva = Cuenta::where('idprestamo',$idPrestamo)->first();
        $prestamo = Prestamo::where('idprestamo',$idPrestamo)->first();
        
        return view('tipoCredito.exito', ["usuarioactual" => $usuarioactual,"cuenta"=> $cuentaNueva,"persona"=>$cliente,"prestamo"=>$prestamo,"negocio"=>$negocio]);
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

    public function destroy(Request $request,$id)
    {

        $cuenta= Cuenta::where('idcuenta',$id)->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
        #$prestamo2 = $prestamo;
        $prestamo->delete();
        Session::flash('borrado', "El Crédito fue Borrado del sistema correctamente");
        return redirect('record');

    }

    /*
    Nombre: autoComplete
    Objetivo: hacer una busqueda de un negocio
    Autor: Lexan
    parámetros de entrada: un request
    parámetros de salida: un array de datos de negocios
     */
    public function autoComplete(Request $request,$id)
    {
       if($request->ajax()){
           $negocios = Negocio::negocios($id);
           return response()->json($negocios);
       }
    }

    /*
    Nombre: autoCompleteCodeudor
    Objetivo: hacer una busqueda de un codeudor
    Autor: Steven
    parámetros de entrada: un request
    parámetros de salida: un array de datos de codeudor
     */
    public function autoCompleteCodeudor(Request $request,$id)
    {
       if($request->ajax()){
           $codeudores = Codeudor::codeudores($id);
           return response()->json($codeudores);
       }
    }


    /*
    Nombre: insertarCuentaPrestamodetalleLiquidacion
    Objetivo: crea la correspondiente cuenta a un cliente y la definiciones del prestamo asociado a la cuenta recien creada.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID del cliente.
    parámetros de salida: el ID del prestamo recien creado.
     */

    public function insertarCuentaPrestamo($fechacredito, $fechacomienzo, $tipo1, $tipo2, $numcheque, $idcliente, $idnegocio, $idcodeudor,  $idtipocredito, $monto, $cuota)
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
        $prestamo->estado = 'COMPLETO';
        $prestamo->estadodos = 'ACTIVO';
        $prestamo->montooriginal = $monto;
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
}
