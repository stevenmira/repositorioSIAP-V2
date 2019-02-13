<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Http\Requests\ObservacionFormRequest;

use siap\Observacion;
use siap\Cliente;
use siap\Fecha;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon; 
use DB;

class ObservacionController extends Controller
{
    public function getObservaciones($idcliente)
    {
    	$usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	$cliente = Cliente::where('idcliente','=',$idcliente)->first();

    	$observaciones = DB::table('observacion')
    	->where('idcliente','=', $idcliente)
    	->orderBy('idobservacion','asc')
    	->paginate(15);

    	return view('observacion.listaObservacion', ['observaciones'=>$observaciones, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }









}
