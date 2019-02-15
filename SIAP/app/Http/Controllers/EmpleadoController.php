<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use siap\Fecha;
use siap\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use siap\Http\Requests\EmpleadoFormRequest;
use Illuminate\Support\Facades\Session;

use DB;

class EmpleadoController extends Controller
{
   
    public function indexPersonal()
	{
	   $usuarioactual=\Auth::user();
	   $fecha_actual = Fecha::spanish();

	   return view('personal.index',['fecha_actual'=>$fecha_actual,"usuarioactual"=>$usuarioactual]);

	}
}