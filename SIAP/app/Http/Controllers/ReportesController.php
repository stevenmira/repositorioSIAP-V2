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
    	$fecha = $request->get('fecha');

    	// Sumatoria del totaldiario recibido. Se toma como base la fechaefectiva de pago
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
         		DB::raw('sum(detalle_liquidacion.totaldiario) as total')
         	)
         	->groupBy(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre',
         		'detalle_liquidacion.fechaefectiva'
         	)
         	->having('detalle_liquidacion.fechaefectiva','=',$fecha)
         	->get();

         	$total1 = 0;
	        foreach ($consulta1 as $con1) {
	        	$total1 = $total1 + $con1->total;        
	        }


        // Se consultan los creditos completos
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

		// Se consultan las cuotas atrasadas
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

        // Saldos hasta la $fecha_actual
         	$date = Carbon::now();
        $consulta4 = DB::table('detalle_liquidacion')
         	->join('cuenta as cuenta','cuenta.idcuenta','=','detalle_liquidacion.idcuenta')
         	->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
         	->join('negocio as negocio','negocio.idnegocio','=','cuenta.idnegocio')
         	->join('cliente as cliente','cliente.idcliente','=','negocio.idcliente')
         	->join('cartera as cartera','cartera.idcartera','=','cliente.idcartera')
         	->where('cartera.idcartera', '=', $idcartera)
         	#->where('detalle_liquidacion.fechadiaria','=',$date)
         	->where('detalle_liquidacion.abonocapital','!=','pivote')
         	#->where('')
         	->select(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre as nombreNegocio',
         		DB::raw('min(detalle_liquidacion.monto) as saldo')
         	)
         	->groupBy(
         		'cartera.idcartera',
         		'cliente.nombre',
         		'cliente.apellido',
         		'negocio.nombre'
         	)
         	->get();

        $fecha = Carbon::parse($fecha)->format('d-m-Y');

        $fecha_actual = Carbon::now()->format('d-m-Y');

		return view('reportes.estrategicos.carteraPagosReview',["consulta1"=>$consulta1,"consulta11"=>$consulta11,"consulta2"=>$consulta2,"consulta3"=>$consulta3,"consulta4"=>$consulta4,"total1"=>$total1,"total2"=>$total2,"fecha"=>$fecha, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);

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
        


        $desde = Carbon::parse($desde)->format('d-m-Y');
    	$hasta = Carbon::parse($hasta)->format('d-m-Y');

        return view('reportes.estrategicos.controlCreditos.controlCreditosReview',["consulta"=>$consulta,"nombreCartera"=>$nombreCartera,"desde"=>$desde,"hasta"=>$hasta,"fecha_actual"=>$fecha_actual,"sumMonto"=>$sumMonto,"sumComision"=>$sumComision,"sumMontooriginal"=>$sumMontooriginal,"sumMontoCompleto"=>$sumMontoCompleto,"sumMontoRefinanciamiento"=>$sumMontoRefinanciamiento,"c1"=>$c1,"c2"=>$c2, "p1"=>$p1,"p2"=>$p2,"usuarioactual"=>$usuarioactual]);
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
}
