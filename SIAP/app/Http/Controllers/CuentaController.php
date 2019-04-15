<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Cuenta;
use siap\Prestamo;
use siap\TipoCredito;
use siap\DetalleLiquidacion;
use siap\Codeudor;
use siap\Fecha;
use siap\TipoDesembolso;

use Carbon\Carbon;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use DB;

class CuentaController extends Controller
{
	public function index(Request $request)
    {
        


    }

    public function show($idcuenta)
    {
    	$usuarioactual=\Auth::user();
        
    	//Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $cartera = Cartera::findOrFail($cliente->idcartera);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);
        $tipo_desembolso = TipoDesembolso::findOrFail($prestamo->idtipodesembolso);
        $codeudor = Codeudor::where('idcodeudor',$prestamo->idcodeudor)->first();

        // Metodo para calcular edad
        $edad = Fecha::calcularEdad($cliente->fechanacimiento);

        $cliente->fechanacimiento = \Carbon\Carbon::parse($cliente->fechanacimiento)->format('d-m-Y');

    	return view('cuenta.show',["cuenta"=>$cuenta, "negocio"=>$negocio, "cliente"=>$cliente, "prestamo"=>$prestamo, "tipo_credito"=>$tipo_credito, "cartera"=>$cartera, "edad"=>$edad, "tipo_desembolso"=>$tipo_desembolso, "codeudor"=>$codeudor, "usuarioactual"=>$usuarioactual]);
    }


    public function updateCredito(Request $request){
        $usuarioactual=\Auth::user();

        $prestamo = Prestamo::where('idprestamo',$request->get('idprestamo'))->first();
        $prestamo->numerocheque = $request->get('numerocheque');
        $prestamo->update();

        $cuenta = Cuenta::where('idprestamo',$prestamo->idprestamo)->first();
        $cuenta->capitalanterior = $request->get('saldo');
        $cuenta->cuotaatrasada = $request->get('cuotas');
        $cuenta->mora = $request->get('mora');
        $cuenta->update();

        Session::flash('exito','Los datos del credito se han actualizado correctamente');

        return Redirect::to('cuenta/'.$cuenta->idcuenta);

    }


    //Éste metodo funciona para ambos casos de estado ACTIVO o INACTIVO
    public function destroy($idcuenta)
    {
        $usuarioactual=\Auth::user();

        $cuenta = Cuenta::findOrFail($idcuenta);
        $estado  = $cuenta->estado;

        if ($estado == 'ACTIVO') {

             $cuenta->estado = 'INACTIVO';
             $cuenta->update();
             Session::flash('inactivo'," ".$cuenta->estado.' ');
             

         }else{

            $cuenta->estado = 'ACTIVO';
            $cuenta->update();
            Session::flash('activo'," ".$cuenta->estado.' ');
         }

         return Redirect::to('cuenta/'.$idcuenta);

    }

    public function desembolso($idcuenta)
    {
        $usuarioactual=\Auth::user();

        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);
        $codeudor = Codeudor::where('idcodeudor',$prestamo->idcodeudor)->first();

        if ($prestamo->estado == 'COMPLETO') 
        {
            if ($prestamo->monto == $prestamo->montooriginal) {
                $costo = 0;
            }else{
                $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
            }

            $montoreal = $prestamo->montooriginal;

            return view('cuenta.desembolso',["cuenta"=>$cuenta, "cliente"=>$cliente, "prestamo"=>$prestamo, "montoreal"=>$montoreal, "costo"=>$costo, "codeudor"=>$codeudor, "usuarioactual"=>$usuarioactual]);

        }else{

            
            $cuentaAnterior = Cuenta::where('idcuenta',$prestamo->cuentaanterior)->first();

            if ($cuentaAnterior == null) {
                Session::flash('msj', "Hay un problema con la cuenta anterior, al parecer no se encuentra en nuesta base de datos");
                $cuentaAnterior = new Cuenta; 
            }


            $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuentaAnterior->idcuenta)
            ->orderby('iddetalleliquidacion', 'asc')
            ->get();

            // se recuperan los datos del desembolso

            $desembolso = round($prestamo->monto,2);

            if ($prestamo->monto == $prestamo->montooriginal) {
                $comision = 0;
            }else{
                $comision = intdiv($prestamo->montooriginal, 50) * 2.25;
                $comision = round($comision,2);
            }

            $cuotas = $cuentaAnterior->cuotaatrasada;

            $totalCuota = 0;

            foreach ($liquidaciones as $liq) {
                if ($liq->estado == 'CANCELADO CON REF.') {
                    $totalCuota = $totalCuota + $liq->totaldiario;
                }
            }

            $mora = round($cuentaAnterior->mora,2);

            $liquiPivote = DetalleLiquidacion::where('idcuenta',$cuentaAnterior->idcuenta)->where('abonocapital','pivote')->first();

            if ($liquiPivote != null) {
                $saldoCapitalAnterior = $liquiPivote->monto;
            }else{
                $saldoCapitalAnterior = 0;
            }

            $total = $desembolso - $comision - $totalCuota - $mora - $saldoCapitalAnterior;
            $total = round($total,2);

            return view('cuenta.desembolsoRef',["cuenta"=>$cuenta, "cliente"=>$cliente, "codeudor"=>$codeudor, "prestamo"=>$prestamo, "desembolso"=>$desembolso, "comision"=>$comision, "cuotas"=>$cuotas, "totalCuota"=>$totalCuota, "mora"=>$mora,  "saldoCapitalAnterior"=>$saldoCapitalAnterior, "total"=>$total,"usuarioactual"=>$usuarioactual]);
        }
        
    }

    ///Generacion de Reportes de Desesmbolso con o sin Refinanciamiento, con o sin mora.

    public function desembolsoPDF($idcuenta){
        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::findOrFail($cuenta->idnegocio);
        $cliente = Cliente::findOrFail($negocio->idcliente);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);
        $codeudor = Codeudor::where('idcodeudor',$prestamo->idcodeudor)->first();

        if ($prestamo->monto == $prestamo->montooriginal) {
            $costo = 0;
        }else{
            $costo = intdiv($prestamo->montooriginal, 50) * 2.25;
        }

        $montoreal = $prestamo->montooriginal;

        $vistaurl = 'reportes/desembolso';

        $name='Desembolso'.$cuenta->idcuenta.$prestamo->idprestamo.$negocio->nombre.$cliente->nombre.".pdf";

        return $this -> desemPDF($vistaurl,$cuenta,$cliente,$prestamo,$codeudor,$montoreal,$costo,$name);      
    }

    public function desemPDF($vistaurl,$cuenta,$cliente,$prestamo,$codeudor,$montoreal,$costo,$name){
        $view=\View::make($vistaurl,compact('cuenta','cliente','prestamo','codeudor','montoreal','costo'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function desembolsoRefinanciamientoPDF(Request $request){
        $usuarioactual=\Auth::user();

        $cuenta = Cuenta::findOrFail($request->get('idcuenta'));
        $prestamo = Prestamo::findOrFail($request->get('idprestamo'));
        $cliente = Cliente::findOrFail($request->get('idcliente'));
        $codeudor = Codeudor::where('idcodeudor',$prestamo->idcodeudor)->first();

        //Se recuperan los datos
        $desembolso = $request->get('desembolso');
        $comision = $request->get('comision');
        $totalCuota = $request->get('totalCuota');
        $mora = $request->get('mora');
        $saldoCapitalAnterior = $request->get('saldoCapitalAnterior');
        $cuotas = $request->get('cuotas');


        $total = $desembolso - $comision - $totalCuota - $mora - $saldoCapitalAnterior;
        $total = round($total,2);

        $vistaurl = 'reportes/desembolsoRefinanciamiento';

        $name="Desembolso-Refinanciamiento.pdf";

        return $this -> desemRefPDF($cuenta,$prestamo,$cliente,$codeudor,$desembolso,$comision,$totalCuota,$mora,$saldoCapitalAnterior,$cuotas,$total,$vistaurl,$name);

    }

    
    public function desemRefPDF($cuenta,$prestamo,$cliente,$codeudor,$desembolso,$comision,$totalCuota,$mora,$saldoCapitalAnterior,$cuotas,$total,$vistaurl,$name){
        $view=\View::make($vistaurl,compact('cuenta','prestamo','cliente','codeudor','desembolso','comision','totalCuota','mora','saldoCapitalAnterior','cuotas','total'))->render();

        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

}
