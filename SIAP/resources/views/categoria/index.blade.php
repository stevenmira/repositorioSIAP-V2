@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ URL::action('CategoriaController@index')}}"><i class="fa fa-dashboard"></i> Categoria</a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE CATEGORIAS</b></h4>

<!-- Criterios de búsquedas -->

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>La Categoria -- {{ Session::get('create')}} -- se ha guardado correctamente</P>
  </div>
  @endif


  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> La Categoria  -- {{ Session::get('update')}} -- se ha actualizado correctamente</P>
  </div>
  @endif

  @if (Session::has('error'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>   <b>{{ Session::get('error')}}</b>  </P>
  </div>
  @endif
 
</div>
 <!-- Fin Notificación -->
  

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CATEGORIAS<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Ejecutivo" href="{{URL::action('CategoriaController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                          </th>
                      </tr>
                        <tr class="info">
                            <th style="width: 75px; text-align: center;">Letra</th>
                            <th>Calificacion</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                   @foreach ($categorias as $ma)
                      <tr>
                          <td>{{ $ma->letra }}</td>
                          <td>{{ $ma->calificacion }}</td>
                          <td>{{ $ma->descripcion }}</td>
                          <td style="width: 230px;">

                              <a class="btn btn-info azul" data-title="Editar Datos de la Categoria" href="{{URL::action('CategoriaController@edit',$ma->idcategoria)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                  @endforeach
                </table>
            </div>
            {{$categorias->render()}}
        </div>
</div>

<div align="center">
  <div style="padding: 0px 25 px 0px 25px" align="left">
    <br>
    <div class="smallfont" align="center">
      <strong></strong>
   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">   
  <a href="{{URL::action('CategoriaController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás </a> 
  </div>
    </div>
    </br>
  </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>



@endsection