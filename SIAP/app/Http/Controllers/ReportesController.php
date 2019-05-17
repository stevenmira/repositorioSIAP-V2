<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use siap\Fecha;
use siap\Cartera;
use Carbon\Carbon;

use DB;

class ReportesController extends Controller
{
    
    public function lista(){
    	$usuarioactual=\Auth::user();

    	return view('reportes.listaReportes',["usuarioactual"=>$usuarioactual]);
    }

    public function carteraPagos(){
    	$usuarioactual=\Auth::user();

    	$fecha_actual = Carbon::now()->format('d-m-Y');
        $carteras = DB::table('cartera')->orderby('cartera.nombre','asc')->get();

    	return view('reportes.estrategicos.carteraPagosForm',["fecha_actual"=>$fecha_actual, "carteras"=>$carteras, "usuarioactual"=>$usuarioactual]);
    }

    public function carteraPagosReview(Request $request){

    	$usuarioactual=\Auth::user();

    	$idcartera = $request->get('idcartera');
        $cartera = Cartera::where('idcartera',$idcartera)->first();
    	$fecha = $request->get('fecha');

    	// TABLA: EFECTIVO RECIBIDO DIARIO
        $consulta1 = DB::table('detalle_liquidacion')
         	->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
         	->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         	->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
         	->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
         	->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
         	->where('cartera.idcartera', '=', $idcartera)
         	->select(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre as nombreNegocio',
         		'detalle_liquidacion.fechaefectiva',
                DB::raw('sum(detalle_liquidacion.interes) as total0'),
                DB::raw('sum(detalle_liquidacion.cuotacapital) as total1'),
         		DB::raw('sum(detalle_liquidacion.totaldiario) as total2')
         	)
            ->orderby('cliente.nombre','asc')
         	->groupBy(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre',
         		'detalle_liquidacion.fechaefectiva'
         	)
         	->having('detalle_liquidacion.fechaefectiva','=',$fecha)
         	->get();

         	$t0 = 0;
            $t1 = 0;
            $t2 = 0;
	        foreach ($consulta1 as $con1) {
                $t0 = $t0 + $con1->total0;   
	        	$t1 = $t1 + $con1->total1;
                $t2 = $t2 + $con1->total2;           
	        }


        // TABLA: DETALLE
        $consulta11 = DB::table('detalle_liquidacion')
         	->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
         	->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         	->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
         	->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
         	->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
         	->where('cartera.idcartera', '=', $idcartera)
         	->select(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre as nombreNegocio',
         		'detalle_liquidacion.iddetalleliquidacion',
         		'detalle_liquidacion.monto',
         		'detalle_liquidacion.interes',
         		'detalle_liquidacion.cuotacapital',
         		'detalle_liquidacion.totaldiario',
         		'detalle_liquidacion.fechaefectiva', 
         		'prestamo.cuotadiaria',
         		DB::raw('sum(detalle_liquidacion.totaldiario) as total')
         	)
            ->orderby('cliente.nombre','asc')
         	->groupBy(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre',
         		'detalle_liquidacion.iddetalleliquidacion',
         		'detalle_liquidacion.monto',
         		'detalle_liquidacion.interes',
         		'detalle_liquidacion.cuotacapital',
         		'detalle_liquidacion.totaldiario',
         		'detalle_liquidacion.fechaefectiva',
         		'prestamo.cuotadiaria'
         	)
         	->orderby('detalle_liquidacion.iddetalleliquidacion','asc')
         	->having('detalle_liquidacion.fechaefectiva','=',$fecha)
         	->get();

            $td0 = 0;
            $td1 = 0;
            $td2 = 0;
            foreach ($consulta11 as $con1) {
                $td0 = $td0 + $con1->interes;   
                $td1 = $td1 + $con1->cuotacapital;
                $td2 = $td2 + $con1->totaldiario;           
            }

		// TABLA: CUOTAS ATRASADAS
        $consulta2 = DB::table('detalle_liquidacion')
         	->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
         	->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         	->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
         	->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
         	->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
         	->where('cartera.idcartera', '=', $idcartera)
         	->where('detalle_liquidacion.fechadiaria','<=',$fecha)
         	->where('detalle_liquidacion.estado', '=', 'ATRASO')
         	->select(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre as nombreNegocio',
         		'prestamo.cuotadiaria',
         		DB::raw('count(detalle_liquidacion.estado) as cuotas'),
         		DB::raw('count(detalle_liquidacion.estado) * prestamo.cuotadiaria as total')
         	)
            ->orderby('cliente.nombre','asc')
         	->groupBy(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre',
         		'prestamo.cuotadiaria'
         	)
         	->get();

	        $total2 = 0;
	        foreach ($consulta2 as $con2) {
	        	$total2 = $total2 + $con2->total;        
	        }


        // Saldos de la $fecha 
        $consulta3 = DB::table('detalle_liquidacion')
         	->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
         	->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         	->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
         	->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
         	->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
         	->where('cartera.idcartera', '=', $idcartera)
         	->where('detalle_liquidacion.fechadiaria','=',$fecha)
         	->select(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre as nombreNegocio',
         		'detalle_liquidacion.monto',
         		'detalle_liquidacion.interes',
         		'detalle_liquidacion.cuotacapital',
         		DB::raw('detalle_liquidacion.monto - detalle_liquidacion.cuotacapital as saldo')
         	)
            ->orderby('cliente.nombre','asc')
         	->groupBy(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre',
         		'detalle_liquidacion.monto',
         		'detalle_liquidacion.interes',
         		'detalle_liquidacion.cuotacapital'
         	)
         	->get();

        // TABLA: SALDO CAPITAL
        $consulta4 = DB::table('detalle_liquidacion')
         	->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
         	->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         	->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
         	->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
         	->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
         	->where('cartera.idcartera', '=', $idcartera)
         	->where('detalle_liquidacion.abonocapital','=','pivote')
         	->select(
                'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre as nombreNegocio',
                'detalle_liquidacion.monto'
         	)
            ->orderby('cliente.nombre','asc')
         	->groupBy(
                'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre',
                'detalle_liquidacion.monto'
         	)
         	->get();

            $total4 = 0;
                foreach ($consulta4 as $con4) {
                    $total4 = $total4 + $con4->monto;        
                }

        $fecha = Carbon::parse($fecha)->format('d-m-Y');

        $fecha_actual = Carbon::now()->format('d-m-Y');

		return view('reportes.estrategicos.carteraPagosReview',["consulta1"=>$consulta1,"consulta11"=>$consulta11,"consulta2"=>$consulta2,"consulta3"=>$consulta3,"consulta4"=>$consulta4,"t0"=>$t0,"t1"=>$t1,"t2"=>$t2,"td0"=>$td0,"td1"=>$td1,"td2"=>$td2,"total2"=>$total2, "total4"=>$total4, "fecha"=>$fecha, "fecha_actual"=>$fecha_actual, "cartera"=>$cartera, "usuarioactual"=>$usuarioactual]);

    }

    public function controlCreditos(){
    	$usuarioactual=\Auth::user();

    	$fecha_actual = Carbon::now()->format('d-m-Y');
        $carteras = DB::table('cartera')->orderby('cartera.nombre','asc')->get();

    	return view('reportes.estrategicos.controlCreditos.controlCreditosForm',["fecha_actual"=>$fecha_actual,"carteras"=>$carteras, "usuarioactual"=>$usuarioactual]);
    }


    public function controlCreditosReview(Request $request){
    	
    	$usuarioactual=\Auth::user();
    	$fecha_actual = Carbon::now()->format('d-m-Y');
    	
    	$idcartera = $request->get('idcartera');
    	$desde = $request->get('desde');
        $hasta = $request->get('hasta');


        if ($desde > $hasta) {

        	$carteras = DB::table('cartera')->orderby('cartera.nombre','asc')->get();

            Session::flash('msj',"El valor del campo -- FECHA INICIO -- debe ser menor o igual que el valor del campo -- FECHA FIN --");

            return view('reportes.estrategicos.controlCreditos.controlCreditosForm',["fecha_actual"=>$fecha_actual,"carteras"=>$carteras, "usuarioactual"=>$usuarioactual]);
        }

        if ($idcartera == 'TODAS') 
        {
        	$nombreCartera = 'TODAS LAS CARTERAS';

	        $consulta = DB::table('cartera as cartera')
	        	->join('ejecutivo as ejecutivo','cartera.idejecutivo','=','ejecutivo.idejecutivo')
	        	->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
	            ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
	            ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
	            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
	            ->join('tipo_desembolso as tipo_desembolso','prestamo.idtipodesembolso','=','tipo_desembolso.idtipodesembolso')
	            ->select(
	            	'cliente.nombre',
	            	'cliente.apellido',
	            	'cliente.dui',
	            	'prestamo.fecha',
	            	'prestamo.monto',
	            	DB::raw('cuenta.interes * 100 as interes'),
	            	DB::raw('prestamo.monto - prestamo.montooriginal as comision'),
	            	'prestamo.montooriginal',
	            	'cartera.nombre as nombreCartera',
	            	'ejecutivo.nombre as nombreEjecutivo',
	            	'tipo_desembolso.nombre as nombreDesembolso',
	            	'prestamo.numerocheque',
                    'prestamo.estado'
	            )
	            ->where('prestamo.fecha','>=', $desde)
	            ->where('prestamo.fecha','<=', $hasta)
	            ->orderby('prestamo.fecha','asc')
	            ->get();
	    }
	    else
	    {
	    	$carteraX = Cartera::where('idcartera',$idcartera)->first();
	    	$nombreCartera = $carteraX->nombre;

	    	$consulta = DB::table('cartera as cartera')
	        	->join('ejecutivo as ejecutivo','cartera.idejecutivo','=','ejecutivo.idejecutivo')
	        	->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
	            ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
	            ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
	            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
	            ->join('tipo_desembolso as tipo_desembolso','prestamo.idtipodesembolso','=','tipo_desembolso.idtipodesembolso')
	            ->select(
	            	'cliente.nombre',
	            	'cliente.apellido',
	            	'cliente.dui',
	            	'prestamo.fecha',
	            	'prestamo.monto',
	            	DB::raw('cuenta.interes * 100 as interes'),
	            	DB::raw('prestamo.monto - prestamo.montooriginal as comision'),
	            	'prestamo.montooriginal',
	            	'cartera.nombre as nombreCartera',
	            	'ejecutivo.nombre as nombreEjecutivo',
	            	'tipo_desembolso.nombre as nombreDesembolso',
	            	'prestamo.numerocheque',
                    'prestamo.estado'
	            )
	            ->where('cartera.idcartera','=', $idcartera)
	            ->where('prestamo.fecha','>=', $desde)
	            ->where('prestamo.fecha','<=', $hasta)
	            ->orderby('prestamo.fecha','asc')
	            ->get();
	    }

	    // Se procede a realizar la sumatoria

        $sumMonto = 0;
        $sumComision = 0;
        $sumMontooriginal = 0;
        $sumMontoCompleto = 0;
        $sumMontoRefinanciamiento = 0;
        $c1 = 0;
        $c2 = 0;
        foreach ($consulta as $con) {
        	$sumMonto = $sumMonto + $con->monto;
        	$sumComision = $sumComision + $con->comision;
        	$sumMontooriginal = $sumMontooriginal + $con->montooriginal;

            if ($con->estado == 'COMPLETO') {
                $c1 = $c1 + 1;
                $sumMontoCompleto = $sumMontoCompleto + $con->monto;
            }else {
                $sumMontoRefinanciamiento = $sumMontoRefinanciamiento + $con->monto;
                $c2 = $c2 + 1;
            }
        }

        // Se previene la division por cero
        try{
            $p1 = round($sumMontoCompleto / ($sumMontoCompleto + $sumMontoRefinanciamiento) * 100,0);
            $p2 = round($sumMontoRefinanciamiento / ($sumMontoCompleto + $sumMontoRefinanciamiento) * 100,0);
        } catch(\Exception $e)
        {
            $p1 = 0;
            $p2 = 0;
        }

        return view('reportes.estrategicos.controlCreditos.controlCreditosReview',["consulta"=>$consulta,"nombreCartera"=>$nombreCartera,"desde"=>$desde,"hasta"=>$hasta,"idcartera"=>$idcartera,"fecha_actual"=>$fecha_actual,"sumMonto"=>$sumMonto,"sumComision"=>$sumComision,"sumMontooriginal"=>$sumMontooriginal,"sumMontoCompleto"=>$sumMontoCompleto,"sumMontoRefinanciamiento"=>$sumMontoRefinanciamiento,"c1"=>$c1,"c2"=>$c2, "p1"=>$p1,"p2"=>$p2,"usuarioactual"=>$usuarioactual]);
    }

    public function controlCreditosPDF(Request $request){
        $usuarioactual = \Auth::user();
        $name = "controlCreditosPDF";
        $vistaurl= "reportes/estrategicos/controlCreditos/controlCreditosPDF";

        // request
        $idcartera = $request->get('idcartera');
        $desde = $request->get('desde');
        $hasta = $request->get('hasta');

        if ($idcartera == 'TODAS') 
        {
            $nombreCartera = 'TODAS LAS CARTERAS';

            $consulta = DB::table('cartera as cartera')
                ->join('ejecutivo as ejecutivo','cartera.idejecutivo','=','ejecutivo.idejecutivo')
                ->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
                ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
                ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
                ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
                ->join('tipo_desembolso as tipo_desembolso','prestamo.idtipodesembolso','=','tipo_desembolso.idtipodesembolso')
                ->select(
                    'cliente.nombre',
                    'cliente.apellido',
                    'cliente.dui',
                    'prestamo.fecha',
                    'prestamo.monto',
                    DB::raw('cuenta.interes * 100 as interes'),
                    DB::raw('prestamo.monto - prestamo.montooriginal as comision'),
                    'prestamo.montooriginal',
                    'cartera.nombre as nombreCartera',
                    'ejecutivo.nombre as nombreEjecutivo',
                    'tipo_desembolso.nombre as nombreDesembolso',
                    'prestamo.numerocheque',
                    'prestamo.estado'
                )
                ->where('prestamo.fecha','>=', $desde)
                ->where('prestamo.fecha','<=', $hasta)
                ->orderby('prestamo.fecha','asc')
                ->get();
        }
        else
        {
            $carteraX = Cartera::where('idcartera',$idcartera)->first();
            $nombreCartera = $carteraX->nombre;

            $consulta = DB::table('cartera as cartera')
                ->join('ejecutivo as ejecutivo','cartera.idejecutivo','=','ejecutivo.idejecutivo')
                ->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
                ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
                ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
                ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
                ->join('tipo_desembolso as tipo_desembolso','prestamo.idtipodesembolso','=','tipo_desembolso.idtipodesembolso')
                ->select(
                    'cliente.nombre',
                    'cliente.apellido',
                    'cliente.dui',
                    'prestamo.fecha',
                    'prestamo.monto',
                    DB::raw('cuenta.interes * 100 as interes'),
                    DB::raw('prestamo.monto - prestamo.montooriginal as comision'),
                    'prestamo.montooriginal',
                    'cartera.nombre as nombreCartera',
                    'ejecutivo.nombre as nombreEjecutivo',
                    'tipo_desembolso.nombre as nombreDesembolso',
                    'prestamo.numerocheque',
                    'prestamo.estado'
                )
                ->where('cartera.idcartera','=', $idcartera)
                ->where('prestamo.fecha','>=', $desde)
                ->where('prestamo.fecha','<=', $hasta)
                ->orderby('prestamo.fecha','asc')
                ->get();
        }

        // Se procede a realizar la sumatoria

        $sumMonto = 0;
        $sumComision = 0;
        $sumMontooriginal = 0;
        foreach ($consulta as $con) {
            $sumMonto = $sumMonto + $con->monto;
            $sumComision = $sumComision + $con->comision;
            $sumMontooriginal = $sumMontooriginal + $con->montooriginal;
        }


        return $this->controlCreditosPDFCrear($vistaurl, $name, $idcartera, $desde, $hasta, $consulta, $sumMonto, $sumComision, $sumMontooriginal,$usuarioactual);

    }

    public function controlCreditosPDFCrear($vistaurl, $name, $idcartera, $desde, $hasta, $consulta, $sumMonto,$sumComision,$sumMontooriginal,$usuarioactual){
        
        $view=\View::make($vistaurl,compact('vistaurl', 'name', 'idcartera', 'desde', 'hasta','consulta','sumMonto','sumComision','sumMontooriginal','usuarioactual'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function estadoCreditos(){
        $usuarioactual=\Auth::user();

        $fecha_actual = Carbon::now()->format('d-m-Y');
        $carteras = DB::table('cartera')->orderby('cartera.nombre','asc')->get();

        return view('reportes.tacticos.estadoCreditos.estadoCreditosForm',["fecha_actual"=>$fecha_actual,"carteras"=>$carteras, "usuarioactual"=>$usuarioactual]);
    }

    public function estadoCreditosReview(Request $request){
        $usuarioactual=\Auth::user();
        $fecha_actual = Carbon::now()->format('d-m-Y');
        
        $idcartera = $request->get('idcartera');
        $desde = $request->get('desde');
        $hasta = $request->get('hasta');
        $estado = $request->get('estado');


        if ($desde > $hasta) {

            $carteras = DB::table('cartera')->orderby('cartera.nombre','asc')->get();

            Session::flash('msj',"El valor del campo -- FECHA INICIO -- debe ser menor o igual que el valor del campo -- FECHA FIN --");

            return view('reportes.tacticos.estadoCreditos.estadoCreditosForm',["fecha_actual"=>$fecha_actual,"carteras"=>$carteras, "usuarioactual"=>$usuarioactual]);
        }

        if ($idcartera == 'TODAS') 
        {
            $nombreCartera = 'TODAS LAS CARTERAS';

            $consulta = DB::table('cartera as cartera')
                ->join('ejecutivo as ejecutivo','cartera.idejecutivo','=','ejecutivo.idejecutivo')
                ->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
                ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
                ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
                ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
                ->join('tipo_desembolso as tipo_desembolso','prestamo.idtipodesembolso','=','tipo_desembolso.idtipodesembolso')
                ->select(
                    'cuenta.idcuenta',
                    'cliente.nombre',
                    'cliente.apellido',
                    'negocio.nombre as nombreNegocio',
                    'prestamo.fecha',
                    'prestamo.monto',
                    'cartera.nombre as nombreCartera',
                    'ejecutivo.nombre as nombreEjecutivo',
                    'tipo_desembolso.nombre as nombreDesembolso',
                    'prestamo.numerocheque',
                    'prestamo.estado',
                    'prestamo.estadodos'
                )
                ->where('prestamo.fecha','>=', $desde)
                ->where('prestamo.fecha','<=', $hasta)
                ->where('prestamo.estadodos', $estado)
                ->orderby('prestamo.fecha','asc')
                ->get();
        }
        else
        {
            $carteraX = Cartera::where('idcartera',$idcartera)->first();
            $nombreCartera = $carteraX->nombre;

            $consulta = DB::table('cartera as cartera')
                ->join('ejecutivo as ejecutivo','cartera.idejecutivo','=','ejecutivo.idejecutivo')
                ->join('cliente as cliente','cartera.idcartera','=','cliente.idcartera')
                ->join('negocio as negocio','cliente.idcliente','=','negocio.idcliente')
                ->join('cuenta as cuenta','negocio.idnegocio','=','cuenta.idnegocio')
                ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
                ->join('tipo_desembolso as tipo_desembolso','prestamo.idtipodesembolso','=','tipo_desembolso.idtipodesembolso')
                ->select(
                    'cuenta.idcuenta',
                    'cliente.nombre',
                    'cliente.apellido',
                    'negocio.nombre as nombreNegocio',
                    'prestamo.fecha',
                    'prestamo.monto',
                    'cartera.nombre as nombreCartera',
                    'ejecutivo.nombre as nombreEjecutivo',
                    'tipo_desembolso.nombre as nombreDesembolso',
                    'prestamo.numerocheque',
                    'prestamo.estado',
                    'prestamo.estadodos'
                )
                ->where('cartera.idcartera','=', $idcartera)
                ->where('prestamo.fecha','>=', $desde)
                ->where('prestamo.fecha','<=', $hasta)
                ->where('prestamo.estadodos', $estado)
                ->orderby('prestamo.fecha','asc')
                ->get();
        }

        // Se procede a realizar la sumatoria

        $sumMonto = 0;
        $sumMontoCompleto = 0;
        $sumMontoRefinanciamiento = 0;
        $c1 = 0;
        $c2 = 0;
        foreach ($consulta as $con) {
            $sumMonto = $sumMonto + $con->monto;

            if ($con->estado == 'COMPLETO') {
                $c1 = $c1 + 1;
                $sumMontoCompleto = $sumMontoCompleto + $con->monto;
            }else {
                $sumMontoRefinanciamiento = $sumMontoRefinanciamiento + $con->monto;
                $c2 = $c2 + 1;
            }
        }

        // Se previene la division por cero
        try{
            $p1 = round($sumMontoCompleto / ($sumMontoCompleto + $sumMontoRefinanciamiento) * 100,0);
            $p2 = round($sumMontoRefinanciamiento / ($sumMontoCompleto + $sumMontoRefinanciamiento) * 100,0);
        } catch(\Exception $e)
        {
            $p1 = 0;
            $p2 = 0;
        }

        $desde = Carbon::parse($desde)->format('d-m-Y');
        $hasta = Carbon::parse($hasta)->format('d-m-Y');

        return view('reportes.tacticos.estadoCreditos.estadoCreditosReview',["consulta"=>$consulta,"nombreCartera"=>$nombreCartera,"desde"=>$desde,"hasta"=>$hasta,"estado"=>$estado,"fecha_actual"=>$fecha_actual,"sumMonto"=>$sumMonto,"sumMontoCompleto"=>$sumMontoCompleto,"sumMontoRefinanciamiento"=>$sumMontoRefinanciamiento,"c1"=>$c1,"c2"=>$c2, "p1"=>$p1,"p2"=>$p2,"usuarioactual"=>$usuarioactual]);
    }

    public function grafico(){
        $usuarioactual=\Auth::user();

        $fecha_actual = Carbon::now()->format('d-m-Y');
        $carteras = DB::table('cartera')->orderby('cartera.nombre','asc')->get();

        return view('reportes.tacticos.grafico.graficoForm',["fecha_actual"=>$fecha_actual,"carteras"=>$carteras, "usuarioactual"=>$usuarioactual]);
    }

    public function graficoReview(Request $request){
        $usuarioactual=\Auth::user();
        $fecha_actual = Carbon::now()->format('d-m-Y');
        
        $tipo = $request->get('tipo');
        $desde = $request->get('desde');
        $hasta = $request->get('hasta');

        if ($tipo == "null") {
            Session::flash('msj',"seleccione el tipo de reporte que desea generar");
            return back();
        }

        if ($desde > $hasta) {

            Session::flash('msj',"El valor del campo -- FECHA INICIO -- debe ser menor o igual que el valor del campo -- FECHA FIN --");

            return view('reportes.tacticos.grafico.graficoForm',["fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }

        if ($tipo == 'EFECTIVO')
        {
            $nombreCartera = 'TODAS LAS CARTERAS';

            // Sumatoria del totaldiario recibido. Se toma como base la fechaefectiva de pago
            $consulta = DB::table('detalle_liquidacion')
                ->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
                ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
                ->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
                ->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
                ->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
                ->where('detalle_liquidacion.fechaefectiva','>=',$desde)
                ->where('detalle_liquidacion.fechaefectiva','<=',$hasta)
                ->select(
                    'cartera.idcartera',
                    'cartera.nombre',
                    DB::raw('sum(detalle_liquidacion.interes) as total0'),
                    DB::raw('sum(detalle_liquidacion.cuotacapital) as total1'),
                    DB::raw('sum(detalle_liquidacion.totaldiario) as total2')
                )
                ->groupBy(
                    'cartera.idcartera',
                    'cartera.nombre'
                )
                ->get();

            $suminteres = 0;
            $sumcuotadiaria = 0;
            $sumtotaldiario = 0;
            foreach ($consulta as $con1) {
                $suminteres = $suminteres + $con1->total0;
                $sumcuotadiaria = $sumcuotadiaria + $con1->total1;
                $sumtotaldiario = $sumtotaldiario + $con1->total2;        
            }

            $desde = Carbon::parse($desde)->format('d-m-Y');
            $hasta = Carbon::parse($hasta)->format('d-m-Y');

            return view('reportes.tacticos.grafico.graficoReview',["consulta"=>$consulta, "suminteres"=>$suminteres, "sumcuotadiaria"=>$sumcuotadiaria, "sumtotaldiario"=>$sumtotaldiario, "fecha_actual"=>$fecha_actual, "nombreCartera"=>$nombreCartera, "desde"=>$desde, "hasta"=>$hasta, "usuarioactual"=>$usuarioactual]);

        }
        elseif ($tipo == 'OTORGAMIENTO') {
            return back();
        }



    }
}
