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
    	->orderBy('idobservacion','des')
    	->paginate(15);

    	return view('observacion.listaObservacion', ['observaciones'=>$observaciones, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function newObservacion($idcliente){
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $cliente = Cliente::where('idcliente','=',$idcliente)->first();

        return view('observacion.newObservacion', ['cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function store(ObservacionFormRequest $request)      //Para almacenar
    {
        try{
                DB::beginTransaction();

                $observacion = new Observacion;

                $idcliente = $request->get('idcliente');

                $observacion->idcliente = $idcliente;
                $observacion->fecha = $request->get('fecha');
                $observacion->responsable = $request->get('responsable');
                $observacion->comentario = $request->get('comentario');
                $observacion->save();

                Session::flash('create', ' '.$observacion->responsable.' ');

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar el comentario, algo salió mal');
        }       

        $idcliente = $request->get('idcliente');
        return Redirect::to('comentarios/list/'.$idcliente);
    }

    public function edit($idobservacion)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos el comentario
        $observacion = Observacion::findOrFail($idobservacion);
        $cliente = Cliente::findOrFail($observacion->idcliente);

        return view('observacion.edit', ['observacion'=>$observacion, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function update(ObservacionFormRequest $request, $idobservacion)
    {
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();
            
                //Encontramos la observacion del cliente
                $observacion = Observacion::findOrFail($idobservacion);

                //actualizamos la observacion
                $observacion->fecha = $request->get('fecha');
                $observacion->responsable = $request->get('responsable');
                $observacion->comentario = $request->get('comentario');
                $observacion->update();

                Session::flash('update', ' '.$observacion->responsable.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar el comentario, algo salió mal');

        }       

        $observacion = Observacion::findOrFail($idobservacion);
        return Redirect::to('comentarios/list/'.$observacion->idcliente);
    }

    public function destroy($idobservacion)
    {
        $usuarioactual=\Auth::user();

        $observacion = Observacion::findOrFail($idobservacion);
        $observacion->delete();
        Session::flash('delete'," ".$observacion->responsable.' ');

         return Redirect::to('comentarios/list/'.$observacion->idcliente);
    }
}
