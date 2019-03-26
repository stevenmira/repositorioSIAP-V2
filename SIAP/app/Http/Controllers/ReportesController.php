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

    	// Se consultan los creditos completos
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


            return view('reportes.estrategicos.carteraPagosReview',["consulta1"=>$consulta1,"fecha"=>$fecha, "usuarioactual"=>$usuarioactual]);

    }
}
