<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use siap\Fecha;
use siap\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use siap\Http\Requests\EmpleadoFormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use siap\Empleado;

use DB;

class EmpleadoController extends Controller
{
   
    public function indexPersonal()
	{
	   $usuarioactual=\Auth::user();
	   $fecha_actual = Fecha::spanish();

	   return view('personal.index',['fecha_actual'=>$fecha_actual,"usuarioactual"=>$usuarioactual]);

	}
	public function index(Request $request)
    {
    	if($request)
    	{
            $usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();
            
    		$query = trim($request->get('searchText'));

            $consulta = DB::table('empleado')->orderby('empleado.apellido','asc')->get();

            $empleados = DB::table('empleado')
            ->where('empleado.apellido','LIKE','%'.$query.'%')
            ->orderBy('idempleado','asc')
            ->paginate(25);

    		return view('personal.empleado.index',["empleados"=>$empleados, "consulta"=>$consulta,"fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    public function create()
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	return view('personal.empleado.create',["fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store(EmpleadoFormRequest $request)		//Para almacenar
    {

        try{
                DB::beginTransaction();

                $empleado = new Empleado;

                $empleado->nombre = $request->get('nombre');
                $empleado->apellido = $request->get('apellido');

                if(Input::hasFile('fotografia')){
        		$file = Input::file('fotografia');
        		$file -> move(public_path().'/imagenes/empleado/', $file->getClientOriginalName());
        		$empleado->fotografia = $file->getClientOriginalName();
        	    }

                $empleado->dui = $request->get('dui');

                $fechanacimiento = $request->get('fechanacimiento');
                if ($fechanacimiento !="") {
                    $empleado->fechanacimiento=$request->get('fechanacimiento');
                }

                $sexo = $request->get('sexo');
                if ($sexo=="") {
                    $empleado->sexo = null;
                }
                if ($sexo==0) {
                    $empleado->sexo = 'Femenino';
                }
                if ($sexo==1){
                    $empleado->sexo = 'Masculino';
                }

                $empleado->direccion = $request->get('direccion');
                $empleado->telefono = $request->get('telefono');
                $empleado->cargo = $request->get('cargo');
                $empleado->correo = $request->get('correo');
                $empleado->comentario = $request->get('comentario');

                $empleado->save();

                Session::flash('create', ' '.$empleado->nombre.' '.$empleado->apellido.' ');


                

          DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos del empleado, algo salió mal');
    }   	

    	return Redirect::to('empleado');
    }

 public function show($id)       //Para mostrar
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $empleado = Empleado::findOrFail($id);

       //Calculo de la edad
        if (!is_null($empleado->fechanacimiento)) {
        $edad = Fecha::calcularEdad($empleado->fechanacimiento);

        $empleado->fechanacimiento = \Carbon\Carbon::parse($empleado->fechanacimiento)->format('d-m-Y');
        }
        else{
            $edad="";
        }      


        return view('personal.empleado.show',["empleado"=>$empleado, "edad"=>$edad, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function edit($idempleado)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos el ejecutivo
        $empleado = Empleado::findOrFail($idempleado);

         return view('personal.empleado.edit',["empleado"=>$empleado, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function update(EmpleadoFormRequest $request, $idempleado)
    {   
        $usuarioactual=\Auth::user();

        try{
               DB::beginTransaction();
                
                //Actualizamos datos del empleado
                $empleado = Empleado::findOrFail($idempleado);

                $empleado->nombre = $request->get('nombre');
                $empleado->apellido = $request->get('apellido');

                if(Input::hasFile('fotografia')){
                $file = Input::file('fotografia');
                $file -> move(public_path().'/imagenes/empleado/', $file->getClientOriginalName());
                $empleado->fotografia = $file->getClientOriginalName();
                }

                $empleado->dui = $request->get('dui');
                
                 $fechanacimiento = $request->get('fechanacimiento');
                if ($fechanacimiento !="") {
                    $empleado->fechanacimiento=$request->get('fechanacimiento');
                }

                $sexo = $request->get('sexo');
                if ($sexo=="") {
                    $empleado->sexo = null;
                }
                if ($sexo==0) {
                    $empleado->sexo = 'Femenino';
                }
                if ($sexo==1){
                    $empleado->sexo = 'Masculino';
                }

                $empleado->direccion = $request->get('direccion');
                $empleado->telefono = $request->get('telefono');
                $empleado->cargo = $request->get('cargo');
                $empleado->correo = $request->get('correo');
                $empleado->comentario = $request->get('comentario');
                
                $empleado->update();

                Session::flash('update', ' '.$empleado->nombre.' '.$empleado->apellido.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar al ejecutivo, algo salió mal');

        }       

        return Redirect::to('empleado');
    
    }

  
    
}
