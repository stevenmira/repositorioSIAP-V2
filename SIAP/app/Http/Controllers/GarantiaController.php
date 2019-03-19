<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\GarantiaFormRequest;

use siap\Garantia;
use siap\Cliente;
use siap\Prestamo;
use siap\Cuenta;
use siap\Codeudor;
use siap\Negocio;
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

    public function getGarantias($idprestamo){
    	$usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        $prestamo = Prestamo::where('idprestamo','=',$idprestamo)->first();
        $cuenta = Cuenta::where('idprestamo','=',$idprestamo)->first();
        $negocio = Negocio::where('idnegocio','=',$cuenta->idnegocio)->first();
    	$cliente = Cliente::where('idcliente','=',$negocio->idcliente)->first();
        $codeudor = Codeudor::where('idcodeudor','=',$prestamo->idcodeudor)->first();

    	$garantias = DB::table('garantia as garantia')
    	->where('idprestamo','=', $idprestamo)
    	->orderBy('garantia.tipogarante','des')
    	->paginate(15);

    	return view('garantia.getGarantias',['garantias'=>$garantias, 'negocio'=>$negocio,'prestamo'=>$prestamo,'idprestamo'=>$idprestamo,'cliente'=>$cliente, 'codeudor'=>$codeudor, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function newGarantia($idprestamo){
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        $prestamo = Prestamo::where('idprestamo','=',$idprestamo)->first();
        $cuenta = Cuenta::where('idprestamo','=',$idprestamo)->first();
        $negocio = Negocio::where('idnegocio','=',$cuenta->idnegocio)->first();
        $cliente = Cliente::where('idcliente','=',$negocio->idcliente)->first();
        $codeudor = Codeudor::where('idcodeudor','=',$prestamo->idcodeudor)->first();

        return view('garantia.newGarantia', ['cliente'=>$cliente, 'negocio'=>$negocio, 'idprestamo'=>$idprestamo, 'codeudor'=>$codeudor, 'prestamo'=>$prestamo, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function store(GarantiaFormRequest $request)
    {

        try{
                DB::beginTransaction();

                $garantia = new Garantia;

                $garantia->idprestamo = $request->get('idprestamo');
                $garantia->descripcion = $request->get('descripcion');
                $garantia->marca = $request->get('marca');
                $garantia->serie = $request->get('serie');

                if ($request->get('valor') != null) {
                    $garantia->valor = $request->get('valor');
                }

                $garantia->otros = $request->get('otros');
                $garantia->tipogarante = $request->get('tipogarante');

                $garantia->save();

                Session::flash('create', ' '.$garantia->tipogarante.' ');

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar la garantía, algo salió mal');
        }       

        $idprestamo = $request->get('idprestamo');
        return Redirect::to('cliente/credito/garantias/'.$idprestamo);
    }

    public function edit($idgarantia)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        $garantia = Garantia::where('idgarantia','=',$idgarantia)->first();
        $prestamo = Prestamo::where('idprestamo','=',$garantia->idprestamo)->first();
        $cuenta = Cuenta::where('idprestamo','=',$prestamo->idprestamo)->first();
        $negocio = Negocio::where('idnegocio','=',$cuenta->idnegocio)->first();
        $cliente = Cliente::where('idcliente','=',$negocio->idcliente)->first();
        $codeudor = Codeudor::where('idcodeudor','=',$prestamo->idcodeudor)->first();


        return view('garantia.edit', ['garantia'=>$garantia,'cliente'=>$cliente, 'negocio'=>$negocio, 'codeudor'=>$codeudor, 'prestamo'=>$prestamo, 'fecha_actual'=>$fecha_actual, 'usuarioactual'=>$usuarioactual]);
    }

    public function update(GarantiaFormRequest $request, $idgarantia)
    {
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();
            
                //Encontramos la garantia
                $garantia = Garantia::findOrFail($idgarantia);

                //actualizamos el Codeudor
                $garantia->descripcion = $request->get('descripcion');
                $garantia->marca = $request->get('marca');
                $garantia->serie = $request->get('serie');

                if ($request->get('valor') != null) {
                    $garantia->valor = $request->get('valor');
                }

                $garantia->otros = $request->get('otros');
                $garantia->tipogarante = $request->get('tipogarante');
                
                $garantia->update();

                Session::flash('update', ' '.$garantia->tipogarante.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar la garantia, algo salió mal');

        }       

        return Redirect::to('cliente/credito/garantias/'.$garantia->idprestamo);
    }

    public function destroy($idgarantia)
    {
        $usuarioactual=\Auth::user();

        $garantia = Garantia::findOrFail($idgarantia);
        $garantia->delete();
        Session::flash('delete'," ".$garantia->tipogarante.' ');

         return Redirect::to('cliente/credito/garantias/'.$garantia->idprestamo);
    }

}
