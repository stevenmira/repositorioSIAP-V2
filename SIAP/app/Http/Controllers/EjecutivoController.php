<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use siap\Http\Requests;
use siap\Http\Requests\EjecutivoFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use siap\Ejecutivo;
use siap\Fecha;
use DB;

class EjecutivoController extends Controller
{
    
    public function index(Request $request)
    {
    	if($request)
    	{
            $usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();
            
    		#$query = trim($request->get('searchText'));
            $query = $request->get('searchText');

            $consulta = DB::table('ejecutivo')->where('ejecutivo.estado','=','ACTIVO')->orderby('ejecutivo.apellido','asc')->get();

    		$ejecutivos = DB::table('ejecutivo')->orderBy('idejecutivo','asc')->paginate(25);

    		return view('personal.ejecutivo.index',["ejecutivos"=>$ejecutivos, "searchText"=>$query,"consulta"=>$consulta, "fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    public function create()
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	return view('personal.ejecutivo.create',["fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store(EjecutivoFormRequest $request)		//Para almacenar
    {

        try{
                DB::beginTransaction();

                $ejecutivo = new Ejecutivo;

                $ejecutivo->nombre = $request->get('nombre');
                $ejecutivo->apellido = $request->get('apellido');

                if(Input::hasFile('fotografia')){
        		$file = Input::file('fotografia');
        		$file -> move(public_path().'/imagenes/ejecutivo/', $file->getClientOriginalName());
        		$ejecutivo->fotografia = $file->getClientOriginalName();
        	    }

                $ejecutivo->dui = $request->get('dui');

                $fechanacimiento = $request->get('fechanacimiento');
                if ($fechanacimiento !="") {
                    $ejecutivo->fechanacimiento=$request->get('fechanacimiento');
                }

                $sexo = $request->get('sexo');
                if ($sexo=="") {
                    $ejecutivo->sexo = null;
                }
                if ($sexo==0) {
                    $ejecutivo->sexo = 'Femenino';
                }
                if ($sexo==1){
                    $ejecutivo->sexo = 'Masculino';
                }

                $ejecutivo->direccion = $request->get('direccion');
                $ejecutivo->telefono = $request->get('telefono');
                $ejecutivo->correo = $request->get('correo');
                $ejecutivo->comentario = $request->get('comentario');
                $ejecutivo->estado = 'ACTIVO';

                $ejecutivo->save();

                Session::flash('create', ' '.$ejecutivo->nombre.' '.$ejecutivo->apellido.' ');


           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos del ejecutivo, algo salió mal');
        }   	

    	return Redirect::to('ejecutivo');
    }

    public function show($id)       //Para mostrar
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $ejecutivo = Ejecutivo::findOrFail($id);

        //Calculo de la edad
        $edad = Fecha::calcularEdad($ejecutivo->fechanacimiento);

        //Parceo de fecha
        $ejecutivo->fechanacimiento = \Carbon\Carbon::parse($ejecutivo->fechanacimiento)->format('d-m-Y');       


        return view('personal.ejecutivo.show',["ejecutivo"=>$ejecutivo, "edad"=>$edad, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

	public function edit($idejecutivo)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos el ejecutivo
        $ejecutivo = Ejecutivo::findOrFail($idejecutivo);

         return view('personal.ejecutivo.edit',["ejecutivo"=>$ejecutivo, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function update(EjecutivoFormRequest $request, $idejecutivo)
    {	
        $usuarioactual=\Auth::user();

        #try{
         #       DB::beginTransaction();
                
                //Actualizamos datos del ejecutivo
                $ejecutivo = Ejecutivo::findOrFail($idejecutivo);

                $ejecutivo->nombre = $request->get('nombre');
                $ejecutivo->apellido = $request->get('apellido');

                if(Input::hasFile('fotografia')){
        		$file = Input::file('fotografia');
        		$file -> move(public_path().'/imagenes/ejecutivo/', $file->getClientOriginalName());
        		$ejecutivo->fotografia = $file->getClientOriginalName();
        	    }

                $ejecutivo->dui = $request->get('dui');
                
                 $fechanacimiento = $request->get('fechanacimiento');
                if ($fechanacimiento !="") {
                    $ejecutivo->fechanacimiento=$request->get('fechanacimiento');
                }

                $sexo = $request->get('sexo');
                if ($sexo=="") {
                    $ejecutivo->sexo = null;
                }
                if ($sexo==0) {
                    $ejecutivo->sexo = 'Femenino';
                }
                if ($sexo==1){
                    $ejecutivo->sexo = 'Masculino';
                }

                $ejecutivo->direccion = $request->get('direccion');
                $ejecutivo->telefono = $request->get('telefono');
                $ejecutivo->correo = $request->get('correo');
                $ejecutivo->comentario = $request->get('comentario');
                $ejecutivo->estado = 'ACTIVO';

                $ejecutivo->update();

                Session::flash('update', ' '.$ejecutivo->nombre.' '.$ejecutivo->apellido.' ');
                
           #DB::commit();

        #} catch(\Exception $e)
        #{
         # DB::rollback();
         # Session::flash('error', ''.' No se pudo actualizar al ejecutivo, algo salió mal');

        #}       

        return Redirect::to('ejecutivo');
    
    }
    //Éste metodo funciona para ambos casos de estado ACTIVO o INACTIVO
    public function destroy($idejecutivo)
    {
        $usuarioactual=\Auth::user();

        $ejecutivo = Ejecutivo::findOrFail($idejecutivo);
        $estado  = $ejecutivo->estado;

        if ($estado == 'ACTIVO') {

             $ejecutivo->estado = 'INACTIVO';
             $ejecutivo->update();
             Session::flash('activo'," ".$ejecutivo->nombre.' '.$ejecutivo->apellido. " ");
             

         }else{

            $ejecutivo->estado = 'ACTIVO';
            $ejecutivo->update();
            Session::flash('inactivo'," ".$ejecutivo->nombre.' '.$ejecutivo->apellido. " ");
            return Redirect::to('ejecutivos/inactivos');
         }

        return Redirect::to('ejecutivo');

    }


    //Gestión de Ejecutivos Inactivos

    public function inactivos(Request $request)
    {
        if($request)
        {
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();

            $query = trim($request->get('searchText'));

            $consulta = DB::table('ejecutivo')->where('ejecutivo.estado','=','INACTIVO')->orderby('ejecutivo.apellido','asc')->get();

            $ejecutivos = DB::table('ejecutivo as ejecutivo')
            ->select('ejecutivo.idejecutivo', 'ejecutivo.nombre', 'ejecutivo.apellido',  'ejecutivo.dui','ejecutivo.telefono','ejecutivo.estado')
            ->orwhere('ejecutivo.dui','LIKE','%'.$query.'%')
            ->where('ejecutivo.estado','=','INACTIVO')
            ->orderBy('ejecutivo.apellido','asc')
            ->paginate(25);

            return view('personal.ejecutivo.inactivo.index',["ejecutivos"=>$ejecutivos, "consulta"=>$consulta, "searchText"=>$query, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }
    }

}
