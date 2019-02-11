<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Cartera;
use siap\Ejecutivo;
use siap\Supervisor;
use siap\Fecha;
use Illuminate\Support\Facades\Redirect;
use siap\Http\Requests\CarterasFormRequest;

use Illuminate\Support\Facades\Session;

use DB;



class CarteraController extends Controller
{
   
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();

            $query=trim($request->get('searchText'));
            $consulta = Cartera::where('estado','=','ACTIVO')->get();

    		$carteras=DB::table('cartera as car')
            ->select('car.idcartera','car.nombre', 'car.estado', 'eje.nombre as nombreEjecutivo', 'sup.nombre as nombreSupervisor')
            ->join('ejecutivo as eje','eje.idejecutivo','=','car.idejecutivo')
            ->join('supervisor as sup','sup.idsupervisor','=','car.idsupervisor')
            ->orwhere('car.nombre','LIKE','%'.$query.'%')
            ->where('car.estado','ACTIVO')
            ->orderBy('car.nombre','asc')
            ->paginate(25);


    		return view('carteras.index',["carteras"=>$carteras, "consulta"=>$consulta,"searchText"=>$query, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    	}

    }

    public function create()
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //En casos que no haya listado, devuelve vacia la lista
        $ejecutivos = Ejecutivo::orderBy('nombre','asc');
        $supervisores = Supervisor::orderBy('nombre','asc');
        
    	return view("carteras.create",["ejecutivos"=>$ejecutivos, "supervisores"=>$supervisores, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }
    public function store(CarterasFormRequest $request)
    {

        $carteras = Cartera::all();

        foreach ($carteras as $cartera) {
            if($cartera->nombre== $request->get('nombre'))
            {
                Session::flash('error', 'Ya existe una cartera con el nombre: -- '.$cartera->nombre.' --');
                return Redirect::to('carteras');
            }
        }

    	$usuarioactual=\Auth::user();
        $cartera=new Cartera;
    	$cartera->nombre= $request->get('nombre');
        $cartera->idejecutivo = $request->get('idejecutivo');
        $cartera->idsupervisor = $request->get('idsupervisor');
        $cartera->estado = 'ACTIVO';
    	$cartera->save();
        Session::flash('create', ' '.$cartera->nombre.' ');
    	return Redirect::to('carteras');
 
    }
    public function show($id)
    {
    	$usuarioactual=\Auth::user();
        return view("carteras.show",["carteras"=>Cartera::findOrFail($id),"usuarioactual"=>$usuarioactual]);
    }
    public function edit($id)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Se busca la cartera que se desea editar
        $cartera= Cartera::findOrFail($id);

        //En casos que no haya listado, devuelve vacia la lista
        $ejecutivos = Ejecutivo::orderBy('nombre','asc')->get();
        $supervisores = Supervisor::orderBy('nombre','asc')->get();

    	return view("carteras.edit",["supervisores"=>$supervisores, "ejecutivos"=>$ejecutivos, "cartera"=>$cartera, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function update(CarterasFormRequest $request, $id)
    {
    	$usuarioactual=\Auth::user();
        $cartera=Cartera::findOrFail($id);
        $cartera->nombre=$request->get('nombre');
        $cartera->idejecutivo= $request->get('idejecutivo');
        $cartera->idsupervisor= $request->get('idsupervisor');
        $cartera->update();
        
        Session::flash('update', ' '.$cartera->nombre.' ');
    	return Redirect::to('carteras');
    }

    public function destroy($id)
    {

        $usuarioactual=\Auth::user();

        $cartera = Cartera::findOrFail($id);
        $estado  = $cartera->estado;

        if ($estado == 'ACTIVO') {

             $cartera->estado = 'INACTIVO';
             $cartera->update();
             Session::flash('activo'," ".$cartera->nombre.' ');
             

         }else{

            $cartera->estado = 'ACTIVO';
            $cartera->update();
            Session::flash('inactivo'," ".$cartera->nombre.' ');
            return Redirect::to('cartera/inactiva');
         }

         return Redirect::to('carteras');

    }

     //Gestión de Carteras Inactivas

    public function inactivos(Request $request)
    {


        if ($request)
        {
            $usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();

            $query=trim($request->get('searchText'));

            $consulta = Cartera::where('estado','=','INACTIVO')->get();

            $carteras=DB::table('cartera as car')
            ->select('car.idcartera','car.nombre', 'car.estado', 'eje.nombre as nombreEjecutivo', 'sup.nombre as nombreSupervisor')
            ->join('ejecutivo as eje','eje.idejecutivo','=','car.idejecutivo')
            ->join('supervisor as sup','sup.idsupervisor','=','car.idsupervisor')
            ->orwhere('car.nombre','LIKE','%'.$query.'%')
            ->where('car.estado','=','INACTIVO')
            ->orderBy('car.idcartera')
            ->paginate(25);

            return view('carteras.inactiva.index',["carteras"=>$carteras,"consulta"=>$consulta,"searchText"=>$query, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);

        }
     }  

}


