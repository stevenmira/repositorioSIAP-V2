<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\ClienteFormRequest;
use siap\Http\Requests\ClienteEditFormRequest;

use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Fecha;
use siap\Categoria;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon; //Para la zona fecha horaria

use DB;

class ClienteController extends Controller
{
   
    public function index(Request $request)
    {

    	if($request)
    	{
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();
            
    		$query = trim($request->get('searchText'));

            $consulta = DB::table('cliente')->where('cliente.estado','=','ACTIVO')->orderby('cliente.apellido','asc')->get();

    		$clientes = DB::table('cliente as cliente')
            ->select('cliente.idcliente', 'cliente.nombre', 'cliente.apellido',  'cliente.dui', 'cliente.estado', 'ca.nombre as nombreCartera', 'categoria.letra')
            ->join('cartera as ca','cliente.idcartera','=','ca.idcartera')
            ->join('categoria as categoria','cliente.idcategoria','=','categoria.idcategoria')
            ->orwhere('cliente.dui','LIKE','%'.$query.'%')
            ->where('cliente.estado','=','ACTIVO')
    		->orderBy('cliente.apellido','asc')
    		->paginate(25);

    		return view('cliente.index',["clientes"=>$clientes, "consulta"=>$consulta, "fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    
    public function create()
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        $carteras = Cartera::where('estado','=','ACTIVO')->orderBy('cartera.nombre','asc');
        $categorias = Categoria::orderBy('letra','asc')->get();

    	return view('cliente.create',["carteras"=>$carteras, "categorias"=>$categorias, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store( ClienteFormRequest $request)		//Para almacenar
    {
        /*$usuarioactual=\Auth::user();*/

        try{
                DB::beginTransaction();

                $cliente = new Cliente;

                $cliente->idcartera = $request->get('idcartera');
                $cliente->idcategoria = $request->get('idcategoria');
                $cliente->codigo = '0';                                     //quemado
                $cliente->nombre = $request->get('nombre');
                $cliente->apellido = $request->get('apellido');
                $cliente->nit = $request->get('nit');
                $cliente->dui = $request->get('dui');
                $cliente->lugarexpedicion = $request->get('lugarexpedicion');
                $cliente->fechaexpedicion = $request->get('fechaexpedicion');
                $cliente->fechanacimiento = $request->get('fechanacimiento');
                $cliente->telefonocel = $request->get('telefonocel');
                $cliente->telefonofijo = $request->get('telefonofijo');
                $cliente->direccion = $request->get('direccionCliente');
                $cliente->profesion = $request->get('profesion');
                $cliente->domicilio = $request->get('domicilio');
                $cliente->estado = 'ACTIVO';

                $cliente->save();

                Session::flash('create', ' '.$cliente->nombre.' '.$cliente->apellido.' ');


                

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos del cliente, algo salió mal');
        }   	

    	return Redirect::to('cliente');
    }

    public function show($id)		//Para mostrar
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        $cliente = Cliente::findOrFail($id);

        //Calculo de la edad
        $edad = Fecha::calcularEdad($cliente->fechanacimiento);

        //Parceo de fecha
        $cliente->fechanacimiento = \Carbon\Carbon::parse($cliente->fechanacimiento)->format('d-m-Y');
        $cliente->fechaexpedicion = \Carbon\Carbon::parse($cliente->fechaexpedicion)->format('d-m-Y');       

        $cartera = Cartera::findOrFail($cliente->idcartera);
        $categoria = Categoria::findOrFail($cliente->idcategoria);

        $negocios = DB::table('negocio')
        ->where('idcliente','=', $id)
        ->orderBy('idnegocio','asc')
        ->get();

        $codeudores = DB::table('codeudor')
        ->where('idcliente','=', $cliente->idcliente)
        ->orderBy('idcodeudor','des')
        ->get();

        $observaciones = DB::table('observacion')
        ->where('idcliente','=', $cliente->idcliente)
        ->orderBy('idobservacion','des')
        ->get();

        $creditos = DB::table('cuenta as cuenta')
            ->select('prestamo.idprestamo', 'cliente.nombre', 'cliente.apellido', 'prestamo.estado', 'prestamo.fecha', 'prestamo.monto', 'prestamo.cuotadiaria', 'prestamo.estado as estadoPrestamo', 'negocio.nombre as nombreNegocio', 'negocio.actividadeconomica', 'tipo_credito.interes','cuenta.idcuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('tipo_credito as tipo_credito','cuenta.idtipocredito','=','tipo_credito.idtipocredito')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->where('negocio.idcliente','=',$cliente->idcliente)
            ->orderBy('cuenta.idcuenta','desc')
            ->get();

        return view('cliente.show',["cliente"=>$cliente, "edad"=>$edad, "negocios"=>$negocios, "codeudores"=>$codeudores,"observaciones"=>$observaciones, "creditos"=>$creditos, "cartera"=>$cartera,"categoria"=>$categoria, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function edit($id)
    {
        $usuarioactual=\Auth::user();

        //Obtenemos la fecha de hoy en español usando carbon y array
        $fecha_actual = Fecha::spanish();

        //Búscamos el cliente junto con sus relaciones
        $cliente = Cliente::findOrFail($id);
        $cartera = Cartera::findOrFail($cliente->idcartera);
        $categoria = Categoria::findOrFail($cliente->idcategoria);

        //Consultamos todas las carteras y categorias
        $carteras = Cartera::where('estado','=','ACTIVO')->orderBy('cartera.nombre','asc')->get();
        $categorias = Categoria::orderBy('letra','asc')->get();

         return view('cliente.edit',["cliente"=>$cliente, "cartera"=>$cartera, "categoria"=>$categoria, "carteras"=>$carteras, "categorias"=>$categorias, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
        
    }

    public function update(ClienteEditFormRequest $request, $id)
    {	
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();

                //Se valida que el dui ingresado no exista en la tabla cliente

                //Se resetea el dui del cliente
                $cliente = Cliente::findOrFail($id);
                $dui_original = $cliente->dui;      // Guardamos el dui que tenía anteriomente
                $cliente->dui = 'reset';           // Asignamos reset para que no se repita en la base
                $cliente->update();

                //Se valida que el dui no este en uso                             
                $dui = $request->get('dui');
                $dui_unique = Cliente::where('dui','=',$dui)->first();  // Busca un cliente con el dui ingresado


                if(!is_null($dui_unique))                         // Es decir, encontró ya en uso el DUI
                {

                    Session::flash('unicidad', ' '.$dui.' ');     // Existe dui, se crea el mensaje
                    $cliente->dui = $dui_original;               // Se vuelve a guardar el cliente con el dui original
                    $cliente->update();                         // Falló la actualización se retorna a index
                    return Redirect::to('cliente');
                }

                
                //Actualizamos datos de la cartera seleccionada

                $cliente->idcartera = $request->get('idcartera');

                $cliente->idcategoria = $request->get('idcategoria');
                
                //Actualizamos datos del cliente
                $cliente->codigo = '0';                                     //quemado
                $cliente->nombre = $request->get('nombre');
                $cliente->apellido = $request->get('apellido');
                $cliente->dui = $dui;
                $cliente->lugarexpedicion = $request->get('lugarexpedicion');
                $cliente->fechaexpedicion = $request->get('fechaexpedicion');
                $cliente->nit = $request->get('nit');
                $cliente->fechanacimiento = $request->get('fechanacimiento');
                $cliente->direccion = $request->get('direccionCliente');
                $cliente->telefonocel = $request->get('telefonocel');
                $cliente->telefonofijo = $request->get('telefonofijo');
                $cliente->profesion = $request->get('profesion');
                $cliente->domicilio = $request->get('domicilio');
                $cliente->estado = 'ACTIVO';

                $cliente->update();

                Session::flash('update', ' '.$cliente->nombre.' '.$cliente->apellido.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar al cliente, algo salió mal');

        }       

        return Redirect::to('cliente');
    
    }

    //Éste metodo funciona para ambos casos de estado ACTIVO o INACTIVO
    public function destroy($id)
    {
        $usuarioactual=\Auth::user();

        $cliente = Cliente::findOrFail($id);
        $estado  = $cliente->estado;

        if ($estado == 'ACTIVO') {

             $cliente->estado = 'INACTIVO';
             $cliente->update();
             Session::flash('activo'," ".$cliente->nombre.' '.$cliente->apellido. " ");
             

         }else{

            $cliente->estado = 'ACTIVO';
            $cliente->update();
            Session::flash('inactivo'," ".$cliente->nombre.' '.$cliente->apellido. " ");
            return Redirect::to('clientes/inactivos');
         }

         return Redirect::to('cliente');

    }


    //Gestión de Clientes Inactivos

    public function inactivos(Request $request)
    {
        if($request)
        {
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();

            $query = trim($request->get('searchText'));

            $consulta = DB::table('cliente')->where('cliente.estado','=','INACTIVO')->orderby('cliente.apellido','asc')->get();

            $clientes = DB::table('cliente as cliente')
            ->select('cliente.idcliente', 'cliente.nombre', 'cliente.apellido',  'cliente.dui', 'cliente.estado', 'ca.nombre as nombreCartera')
            ->join('cartera as ca','cliente.idcartera','=','ca.idcartera')
            ->orwhere('cliente.dui','LIKE','%'.$query.'%')
            ->where('cliente.estado','=','INACTIVO')
            ->orderBy('cliente.apellido','asc')
            ->paginate(25);

            return view('cliente.inactivo.index',["clientes"=>$clientes, "consulta"=>$consulta, "searchText"=>$query, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }
    }

    public function perfilClientePDF($id){


            $usuarioactual=\Auth::user();


            //Obtenemos la fecha actual
            $hoy= Carbon::now();
            $hoy= $hoy->format('Y-m-d');

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Carbon::now()->format('d-m-Y');


            $cliente = Cliente::findOrFail($id);
            $cartera = Cartera::findOrFail($cliente->idcartera);
            $categoria = Categoria::findOrFail($cliente->idcategoria);

            $observaciones = DB::table('observacion')
            ->where('idcliente','=', $cliente->idcliente)
            ->orderBy('idobservacion','des')
            ->get();

            //Calculo de la edad
            $edad = Fecha::calcularEdad($cliente->fechanacimiento);

            //Parceo de fecha
            $cliente->fechanacimiento = \Carbon\Carbon::parse($cliente->fechanacimiento)->format('d-m-Y');
            $cliente->fechaexpedicion = \Carbon\Carbon::parse($cliente->fechaexpedicion)->format('d-m-Y');       


            $vistaurl = "cliente/perfil/perfilCliente";
            $name = "perfilCliente".$cliente->nombre.$cliente->apellido.".pdf";

            return $this -> crearPDF($vistaurl,$fecha_actual,$edad,$id,$cliente,$cartera,$categoria,$name,$observaciones, $usuarioactual);
    }

    public function crearPDF($vistaurl,$fecha_actual,$edad,$id,$cliente,$cartera,$categoria,$name,$observaciones,$usuarioactual)
    {
        $view=\View::make($vistaurl,compact('cliente','edad','fecha_actual','cartera','categoria','observaciones','usuarioactual'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name.".pdf");
    }


}
