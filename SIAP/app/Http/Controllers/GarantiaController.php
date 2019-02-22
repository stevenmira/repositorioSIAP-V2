<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\GarantiaFormRequest;

use siap\Garantia;
use siap\Cliente;
use siap\Fecha;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon; 
use DB;

class GarantiaController extends Controller
{
	public function getCreditos($idcliente)
    {
        

    	/*if($request)
    	{*/
            $usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();

    		$cliente = Cliente::where('idcliente','=',$idcliente)->first();

    		/*$query = 0;
    		$query = $request->get('idcliente');
    		if ($query=="") {
    			$query = 0;
    		}*/

    		$cuentas = DB::table('cuenta as cuenta')
            ->select('prestamo.idprestamo', 'cliente.nombre', 'cliente.apellido', 'prestamo.estado', 'prestamo.fecha', 'prestamo.monto', 'prestamo.cuotadiaria', 'prestamo.estado as estadoPrestamo', 'negocio.nombre as nombreNegocio', 'negocio.actividadeconomica', 'tipo_credito.interes')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('tipo_credito as tipo_credito','cuenta.idtipocredito','=','tipo_credito.idtipocredito')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->where('negocio.idcliente','=',$idcliente)
            ->orderBy('cuenta.idcuenta','desc')
    		->get();

    		return view('garantia.getCreditos',["cliente"=>$cliente, "cuentas"=>$cuentas,"fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    	/*}*/

    }

    public function getCreditos2($idcliente){
    	$usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	$cliente = Cliente::where('idcliente','=',$idcliente)->first();

    	$garantiasDeudor = DB::table('garantia as garantia')
    	->select('garantia.descripcion')
    	->join('prestamo as prestamo','garantia.idprestamo','=','prestamo.idprestamo')
    	->join('cuenta as cuenta','prestamo.idprestamo','=','cuenta.idprestamo')
    	->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
    	->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
    	->where('idcliente','=', $idcliente)
    	->where('tipogarante','=', 'DEUDOR')
    	->orderBy('idgarantia','des')
    	->paginate(15);

    	return view('garantia.getCreditos',['garantiasDeudor'=>$garantiasDeudor, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }


}
