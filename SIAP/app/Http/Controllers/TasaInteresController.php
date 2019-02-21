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

        #try{
              #  DB::beginTransaction();

                $tasa = new TipoCredito;

                $tasa->nombre = $request->get('nombre');
                $tasa->condicion = $request->get('condicion');
                #$tasa->monto = $request->get('monto');
                if (is_numeric($request->get('monto'))){
                    $tasa->monto = $request->get('monto');
                }else{
                    $tasa->monto = 0;
                }

                #$tasa->interes = $request->get('interes');
                $interes = $request->get('interes');
                if ($interes < 0) {
                    Session::flash('msj1', ' El << Interés >> debe ser ingresado en porcentaje y debe ser mayor o igual a 0. ');
                    return Redirect::to('tasa-interes/create');
                }
                if ($interes > 100) {
                    Session::flash('msj1', ' El << Interés >> debe ser ingresado en porcentaje y debe ser menor o igual a 100. ');
                    return Redirect::to('tasa-interes/create');
                }

                $tasa->interes = $interes/100;

                $tasa->estado = 'DISPONIBLE';

                $tasa->save();

                $porc = $tasa->interes*100;

                Session::flash('create', ' '.$porc.' ');                

           #DB::commit();

        #} catch(\Exception $e)
        #{
         # DB::rollback();
          #Session::flash('error', ''.' No se pudo guardar los datos de la tasa de interes, notificalo con los desarrolladores');
        #}   	

    	return Redirect::to('tasa-interes');
    }
    public function edit($idtipocredito)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos la tasa
        $interes = TipoCredito::findOrFail($idtipocredito);

         return view('tasaInteres.edit',["fecha_actual"=>$fecha_actual, "interes"=>$interes,"usuarioactual"=>$usuarioactual]);   
    }

    public function update(TasaInteresFormRequest $request, $id)
    {   
        $usuarioactual=\Auth::user();

        #try{
         #       DB::beginTransaction();
                
                //Actualizamos datos de la tasa
                $tasa = TipoCredito::findOrFail($id);

                $tasa->nombre = $request->get('nombre');
                $tasa->condicion = $request->get('condicion');
                #$tasa->monto = $request->get('monto');
                if (is_numeric($request->get('monto'))){
                    $tasa->monto = $request->get('monto');
                }else{
                    $tasa->monto = 0;
                }

                $tasa->interes = $request->get('interes');

                $interes = $request->get('interes');

                if ($interes < 0) {
                    Session::flash('msj1', ' El << Interés >> debe ser ingresado en porcentaje y debe ser mayor o igual a 0. ');
                    return Redirect::to('tasa-interes/'.$id.'/edit');
                }

                if ($interes > 100) {
                    Session::flash('msj1', ' El << Interés >> debe ser ingresado en porcentaje y debe ser menor o igual a 100. ');
                    return Redirect::to('tasa-interes/'.$id.'/edit');
                }
                $tasa->interes = $interes/100;

                $tasa->estado = 'DISPONIBLE';

                $tasa->update();

                $porc = $tasa->interes*100;


                Session::flash('update', ' '.$porc.' ');
                
          # DB::commit();

#        } catch(\Exception $e)
        #{
         # DB::rollback();
          #Session::flash('error', ''.' No se pudo actualizar la Tasa , algo salió mal');

          
           return Redirect::to('tasa-interes');
    
    }

}