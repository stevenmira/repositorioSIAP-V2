@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Activos </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE CLIENTES</b></h4>

<!-- Criterios de búsquedas -->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      @include('cliente.search')
    </div>
  </div>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>El cliente -- {{ Session::get('create')}} -- se ha guardado correctamente</P>
  </div>
  @endif

  @if (Session::has('unicidad'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> No se pudo actualizar, el cliente con el número de DUI -- {{ Session::get('unicidad')}} --  ya está en uso.</P>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El cliente  -- {{ Session::get('update')}} -- se ha actualizado correctamente</P>
  </div>
  @endif

  @if (Session::has('activo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El cliente  -- {{ Session::get('activo')}} --  se ha dado de baja correctamente</P>
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
                              
                              <h3 style="text-align: center;font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE CLIENTES ACTIVOS</b><a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Cliente" href="{{URL::action('ClienteController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Cartera</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DUI</th>
                            <th style="width: 75px; text-align: center;">Negocios</th>
                            <th style="width: 75px; text-align: center;">Comentarios</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($clientes as $ma)
                      <tr>
                          <td>{{ $ma->nombreCartera }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->apellido }}</td>
                          <td>{{ $ma->dui }}</td>
                          <td>
                            <a class=" verde" data-title="Ver lista de negocios" href="{{ url('negocios/list', ['id' => $ma->idcliente ]) }}"><button style="background: #b2ff59;" class=" btn btn-default center-block"><i class="fa fa-list"></i></button>
                            </a> 
                          </td>
                          <td>
                            <a class=" verde" data-title="Ver lista de comentarios" href="{{ url('comentarios/list', ['id' => $ma->idcliente ]) }}"><button style="background: #b2ff59;" class=" btn btn-default center-block"><i class="fa fa-list"></i></button>
                            </a> 
                          </td>
                          <td style="width: 230px;">
                              <a class="btn btn-warning amarillo"  data-title="Ver Datos del Cliente" href="{{URL::action('ClienteController@show',$ma->idcliente)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                              <a class="btn btn-info azul" data-title="Editar Datos del Cliente" href="{{URL::action('ClienteController@edit',$ma->idcliente)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Inhabilitar Cliente" href="" data-target="#modal-delete-{{$ma->idcliente}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      @include('cliente.modal')
                  @endforeach
                </table>
            </div>
            {{$clientes->render()}}
        </div>
</div>

<div class="row">
  <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>



@endsection