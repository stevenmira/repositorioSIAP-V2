<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests\TasaInteresFormRequest;

use siap\Http\Requests;
use siap\Fecha;
use siap\TipoCredito;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB;

class TasaInteresController extends Controller
{
     public function index(Request $request)
    {

    	if($request)
    	{
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();
            
    		$query = $request->get('searchText');

    		if (!is_numeric($query)) {
                $query = 0;
            }

    		//Para el Select
            $consulta = DB::table('tipo_credito')->where('tipo_credito.estado','=','DISPONIBLE')->orderby('tipo_credito.interes','desc')->get();

            //Para el Search
    		$tasas = DB::table('tipo_credito as tipo')
            ->select('tipo.idtipocredito', 'tipo.nombre', 'tipo.condicion', 'tipo.monto',  'tipo.interes', 'tipo.estado')
            ->where('tipo.idtipocredito','=',$query)
    		->orderBy('tipo.interes','desc')
    		->paginate(20);

    		$cont = count($tasas);

    		//En caso de no encontrar elemento (al inicio)
    		if($cont == 0) {
    			$tasas = DB::table('tipo_credito as tipo')
		            ->select('tipo.idtipocredito', 'tipo.nombre', 'tipo.condicion', 'tipo.monto',  'tipo.interes', 'tipo.estado')
		            ->where('tipo.estado','=','DISPONIBLE')
		    		->orderBy('tipo.interes','desc')
		    		->paginate(25);
    		}

    		return view('tasaInteres.index',["tasas"=>$tasas, "consulta"=>$consulta, "fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    public function create()
    {
        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $usuarioactual=\Auth::user();

    	return view('tasaInteres.create',["fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store( TasaInteresFormRequest $request)		//Para almacenar
    {

        try{
                DB::beginTransaction();

                $tasa = new TipoCredito;

                $tasa->nombre = $request->get('nombre');
                $tasa->condicion = $request->get('condicion');
                $tasa->monto = $request->get('monto');
                $tasa->interes = $request->get('interes');
                $tasa->estado = 'DISPONIBLE';

                $tasa->save();

                Session::flash('create', ' '.$tasa->interes.' ');                

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos de la tasa de interes, notificalo con los desarrolladores');
        }   	

    	return Redirect::to('tasa-interes');
    }
}
