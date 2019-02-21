<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;
use siap\Http\Requests\CategoriaFormRequest;
use siap\Fecha;
use siap\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon; //Para la zona fecha horaria

use DB;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
    	if($request)
    	{
            $usuarioactual=\Auth::user();
            $fecha_actual = Fecha::spanish();
            
    		$query = trim($request->get('searchText'));


    		$categorias = DB::table('categoria')->orderBy('categoria.letra','asc')->paginate(25);

    		return view('categoria.index',["categorias"=>$categorias,"fecha_actual"=>$fecha_actual, "searchText"=>$query,"usuarioactual"=>$usuarioactual]);
    	}

    }

    public function create()
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

    	return view('categoria.create',["fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    public function store(CategoriaFormRequest $request)		//Para almacenar
    {

        try{
                DB::beginTransaction();

                $categoria = new Categoria;

                $categoria->letra = $request->get('letra');
                $categoria->calificacion = $request->get('calificacion');
                $categoria->descripcion = $request->get('descripcion');

                $categoria->save();

                Session::flash('create', ' '.$categoria->letra.' ');


                

           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo guardar los datos de la nueva categoria, algo salió mal');
        }   	

    	return Redirect::to('categoria');
    }
    public function show($id)
    {
        $usuarioactual=\Auth::user();
        return view("categorias.show",["categorias"=>Categoria::findOrFail($id),"usuarioactual"=>$usuarioactual]);
    }
    public function edit($idcategoria)
    {
        $usuarioactual=\Auth::user();
        $fecha_actual = Fecha::spanish();

        //Búscamos el ejecutivo
        $categoria = Categoria::findOrFail($idcategoria);

         return view('categoria.edit',["categoria"=>$categoria, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);   
    }

    public function update(CategoriaFormRequest $request, $idcategoria)
    {   
        $usuarioactual=\Auth::user();

        try{
                DB::beginTransaction();
                
                //Actualizamos datos del ejecutivo
                $categoria = Categoria::findOrFail($idcategoria);

                $categoria->letra = $request->get('letra');
                $categoria->calificacion = $request->get('calificacion');
                $categoria->descripcion = $request->get('descripcion');

                $categoria->update();

                Session::flash('update', ' '.$categoria->letra.' ');
                
           DB::commit();

        } catch(\Exception $e)
        {
          DB::rollback();
          Session::flash('error', ''.' No se pudo actualizar la Categoria , algo salió mal');

        }       

        return Redirect::to('categoria');
    
    }
}
