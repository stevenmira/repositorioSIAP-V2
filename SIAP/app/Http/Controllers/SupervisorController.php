<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use siap\Http\Requests;
use siap\Http\Requests\SupervisorFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use siap\Supervisor;
use siap\Fecha;
use DB;

class SupervisorController extends Controller
{
    
    public function index(Request $request)
    {
    	if($request)
    	{
            $usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();
            
    		$query = trim($request->get('searchText'));

            $consulta = DB::table('supervisor')->where('supervisor.estado','=','ACTIVO')->orderby('supervisor.apellido','asc')->get();

            $supervisores = DB::table('supervisor')
            ->where('supervisor.apellido','LIKE','%'.$query.'%')
            ->where('supervisor.estado','=','ACTIVO')
            ->orderBy('idsupervisor','asc')
            ->paginate(25);

    		return view('personal.supervisor.index',["supervisores"=>$supervisores,"consulta"=>$consulta,"fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    public function create()
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	return view('personal.supervisor.create',["fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store(SupervisorFormRequest $request)		//Para almacenar
    {

        try{
                DB::beginTransaction();

                $supervisor = new Supervisor;

                $supervisor->nombre = $request->get('nombre');
                $supervisor->apellido = $request->get('apellido');

                if(Input::hasFile('fotografia')){
        		$file = Input::file('fotografia');
        		$file -> move(public_path().'/imagenes/supervisor/', $file->getClientOriginalName());
        		$supervisor->fotografia = $file->getClientOriginalName();
        	    }

                $supervisor->dui = $request->get('dui');

                $fechanacimiento = $request->get('fechanacimiento');
                if ($fechanacimiento !="") {
                    $supervisor->fechanacimiento=$request->get('fechanacimiento');
                }

                $sexo = $request->get('sexo');
                if ($sexo=="") {
                    $supervisor->sexo = null;
                }
                if ($sexo==0) {
                    $supervisor->sexo = 'Femenino';
                }
                if ($sexo==1){
                    $supervisor->sexo = 'Masculino';
                }

                $supervisor->direccion = $request->get('direccion');
                $supervisor->telefono = $request->get('telefono');
                $supervisor->correo = $request->get('correo');
                $supervisor->comentario = $request->get('comentario');
                $supervisor->estado = 'ACTIVO';

                $supervisor->save();

                Session::flash('create', ' '.$supervisor->nombre.' '.$supervisor->apellido.' ');


                

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos del supervisor, algo salió mal');
        }   	

    	return Redirect::to('supervisor');
    }
public function show($id)       //Para mostrar
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $supervisor = Supervisor::findOrFail($id);

        //Calculo de la edad
        if (!is_null($supervisor->fechanacimiento)) {
        $edad = Fecha::calcularEdad($supervisor->fechanacimiento);

        $supervisor->fechanacimiento = \Carbon\Carbon::parse($supervisor->fechanacimiento)->format('d-m-Y');
        }
        else{
            $edad="";
        }      


        return view('personal.supervisor.show',["supervisor"=>$supervisor, "edad"=>$edad, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function edit($idsupervisor)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos el ejecutivo
        $supervisor = Supervisor::findOrFail($idsupervisor);

         return view('personal.supervisor.edit',["supervisor"=>$supervisor, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function update(SupervisorFormRequest $request, $idsupervisor)
    {   
        $usuarioactual=\Auth::user();

        #try{
         #       DB::beginTransaction();
                
                //Actualizamos datos del ejecutivo
                $supervisor = Supervisor::findOrFail($idsupervisor);

                $supervisor->nombre = $request->get('nombre');
                $supervisor->apellido = $request->get('apellido');

                if(Input::hasFile('fotografia')){
                $file = Input::file('fotografia');
                $file -> move(public_path().'/imagenes/supervisor/', $file->getClientOriginalName());
                $supervisor->fotografia = $file->getClientOriginalName();
                }

                $supervisor->dui = $request->get('dui');
                
                 $fechanacimiento = $request->get('fechanacimiento');
                if ($fechanacimiento !="") {
                    $supervisor->fechanacimiento=$request->get('fechanacimiento');
                }

                $sexo = $request->get('sexo');
                if ($sexo=="") {
                    $supervisor->sexo = null;
                }
                if ($sexo==0) {
                    $supervisor->sexo = 'Femenino';
                }
                if ($sexo==1){
                    $supervisor->sexo = 'Masculino';
                }

                $supervisor->direccion = $request->get('direccion');
                $supervisor->telefono = $request->get('telefono');
                $supervisor->correo = $request->get('correo');
                $supervisor->comentario = $request->get('comentario');
                $supervisor->estado = 'ACTIVO';

                $supervisor->update();

                Session::flash('update', ' '.$supervisor->nombre.' '.$supervisor->apellido.' ');
                
           #DB::commit();

        #} catch(\Exception $e)
        #{
         # DB::rollback();
         # Session::flash('error', ''.' No se pudo actualizar al ejecutivo, algo salió mal');

        #}       

        return Redirect::to('supervisor');
    
    }
     //Éste metodo funciona para ambos casos de estado ACTIVO o INACTIVO
    public function destroy($idsupervisor)
    {
        $usuarioactual=\Auth::user();

        $supervisor = Supervisor::findOrFail($idsupervisor);
        $estado  = $supervisor->estado;

        if ($estado == 'ACTIVO') {

             $supervisor->estado = 'INACTIVO';
             $supervisor->update();
             Session::flash('activo'," ".$supervisor->nombre.' '.$supervisor->apellido. " ");
             

         }else{

            $supervisor->estado = 'ACTIVO';
            $supervisor->update();
            Session::flash('inactivo'," ".$supervisor->nombre.' '.$supervisor->apellido. " ");
            return Redirect::to('supervisores/inactivos');
         }

        return Redirect::to('supervisor');

    }


    //Gestión de Supervisores Inactivos

    public function inactivos(Request $request)
    {
        if($request)
        {
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();

            $query = trim($request->get('searchText'));

            $consulta = DB::table('supervisor')->where('supervisor.estado','=','INACTIVO')->orderby('supervisor.apellido','asc')->get();

            $supervisores = DB::table('supervisor as supervisor')
            ->select('supervisor.idsupervisor', 'supervisor.nombre', 'supervisor.apellido',  'supervisor.dui','supervisor.telefono','supervisor.estado')
            ->orwhere('supervisor.dui','LIKE','%'.$query.'%')
            ->where('supervisor.estado','=','INACTIVO')
            ->orderBy('supervisor.apellido','asc')
            ->paginate(25);

            return view('personal.supervisor.inactivo.index',["supervisores"=>$supervisores, "consulta"=>$consulta, "searchText"=>$query, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }
    }

}
