<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\CodeudorFormRequest;

use siap\Codeudor;
use siap\Cliente;
use siap\Fecha;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon; 
use DB;

class CodeudorController extends Controller
{
    public function getCodeudores($idcliente){
    	$usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	$cliente = Cliente::where('idcliente','=',$idcliente)->first();

    	$codeudores = DB::table('codeudor')
    	->where('idcliente','=', $idcliente)
    	->orderBy('idcodeudor','des')
    	->paginate(15);

    	return view('codeudor.listaCodeudor', ['codeudores'=>$codeudores, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function newCodeudor($idcliente){
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        $cliente = Cliente::where('idcliente','=',$idcliente)->first();

        return view('codeudor.newCodeudor', ['cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function store(CodeudorFormRequest $request)
    {
        /*$usuarioactual=\Auth::user();*/

        try{
                DB::beginTransaction();

                $codeudor = new Codeudor;

                $codeudor->idcliente = $request->get('idcliente');
                $codeudor->nombre = $request->get('nombre');
                $codeudor->apellido = $request->get('apellido');
                $codeudor->nit = $request->get('nit');
                $codeudor->dui = $request->get('dui');
                $codeudor->lugarexpedicion = $request->get('lugarexpedicion');
                $codeudor->fechaexpedicion = $request->get('fechaexpedicion');
                $codeudor->fechanacimiento = $request->get('fechanacimiento');
                $codeudor->telefonocel = $request->get('telefonocel');
                $codeudor->telefonofijo = $request->get('telefonofijo');
                $codeudor->direccion = $request->get('direccion');
                $codeudor->profesion = $request->get('profesion');
                $codeudor->domicilio = $request->get('domicilio');
                $codeudor->estado = 'ACTIVO';

                $codeudor->save();

                Session::flash('create', ' '.$codeudor->nombre.' '.$codeudor->apellido.' ');

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos del codeudor, algo salió mal');
        }   	

        $idcliente = $request->get('idcliente');
    	return Redirect::to('codeudores/list/'.$idcliente);
    }

    public function show($idcodeudor)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        $codeudor = Codeudor::findOrFail($idcodeudor);
        $cliente = Cliente::findOrFail($codeudor->idcliente);

        //Calculo de la edad
        $edad = Fecha::calcularEdad($codeudor->fechanacimiento);

        //Parceo de fecha
        $codeudor->fechanacimiento = \Carbon\Carbon::parse($codeudor->fechanacimiento)->format('d-m-Y');
        $codeudor->fechaexpedicion = \Carbon\Carbon::parse($codeudor->fechaexpedicion)->format('d-m-Y');

        return view('codeudor.show',["cliente"=>$cliente, "codeudor"=>$codeudor, "edad"=>$edad, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function edit($idcodeudor)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos el codeudor
        $codeudor = Codeudor::findOrFail($idcodeudor);
        $cliente = Cliente::findOrFail($codeudor->idcliente);

        return view('codeudor.edit', ['codeudor'=>$codeudor, 'cliente'=>$cliente, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function update(CodeudorFormRequest $request, $idcodeudor)
    {
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();
            
                //Encontramos la observacion del cliente
                $codeudor = Codeudor::findOrFail($idcodeudor);

                //actualizamos el Codeudor
                $codeudor->nombre = $request->get('nombre');
                $codeudor->apellido = $request->get('apellido');
                $codeudor->nit = $request->get('nit');
                $codeudor->dui = $request->get('dui');
                $codeudor->lugarexpedicion = $request->get('lugarexpedicion');
                $codeudor->fechaexpedicion = $request->get('fechaexpedicion');
                $codeudor->fechanacimiento = $request->get('fechanacimiento');
                $codeudor->telefonocel = $request->get('telefonocel');
                $codeudor->telefonofijo = $request->get('telefonofijo');
                $codeudor->direccion = $request->get('direccion');
                $codeudor->profesion = $request->get('profesion');
                $codeudor->domicilio = $request->get('domicilio');
                $codeudor->estado = 'ACTIVO';
                $codeudor->update();

                Session::flash('update', ' '.$codeudor->nombre.' '.$codeudor->apellido.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar el codeudor, algo salió mal');

        }       

        $codeudor = Codeudor::findOrFail($idcodeudor);
        return Redirect::to('codeudores/list/'.$codeudor->idcliente);
    }

    public function destroy($idcuodedor){

        $usuarioactual=\Auth::user();
        $codeudor = Codeudor::where('idcodeudor',$idcuodedor)->first();

        $prestamo = DB::table('prestamo')->where('idcodeudor','=',$idcuodedor)->first();

        if (is_null($prestamo)) {

            $codeudor->delete();
            Session::flash('delete', ' '.$codeudor->nombre.' '.$codeudor->apellido.' ');
            return back();

        }else{
            $cuenta = DB::table('cuenta')->where('idprestamo','=',$prestamo->idprestamo)->first();

            Session::flash('advertencia', ''.$cuenta->idcuenta.'');
            return back();
        }
    }

}
