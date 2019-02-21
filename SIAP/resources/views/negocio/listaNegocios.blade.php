@extends('layouts.inicio')
@section('contenido')
<style type="text/css">
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li class="active"> Negocio </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>GESTIÓN DE NEGOCIOS</b></h4>

<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
  @if (Session::has('create'))
  	<div class="alert  fade in" style="background:  #ccff90;">
  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  	<p>El negocio -- {{ Session::get('create')}} -- se ha guardado correctamente</p>
  	</div>
  @endif


  @if (Session::has('update'))
  	<div class="alert  fade in" style="background:  #bbdefb;">
  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  	<p> El negocio  -- {{ Session::get('update')}} --  se ha actualizado correctamente</p>
  	</div>
  @endif

  @if (Session::has('activo'))
    <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> El negocio  -- {{ Session::get('activo')}} --  se ha dado de baja correctamente</p>
    </div>
  @endif

  @if (Session::has('inactivo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> El Negocio  -- {{ Session::get('inactivo')}} --  se ha dado de alta correctamente </p>
  </div>
  @endif

  @if (Session::has('error'))
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p>   {{ Session::get('error')}} </p>
    </div>
  @endif
</div>

<div class="row">
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 0px 0px 25px;"> {{$cliente->nombre}} {{$cliente->apellido}}</i></span> </p>
</div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE NEGOCIOS<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Negocio" href="{{ url('negocios/nuevo', ['id' => $cliente->idcliente ]) }}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                          </th>
                      </tr>
                        <tr class="info">
                        	<th style="width: 30px;">No.</th>
                            <th style="width: 310px;">Nombre</th>
                            <th style="width: 310px;">Actividad Economica</th>
                            <th>Dirección</th>
                            <th style="width: 180px;">Acciones</th>
                        </tr>
                    </thead>
                   <?php $cont = 1; ?> 
                   @foreach ($negocios as $ma)
                      <tr>
                      	  <td>{{ $cont }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->actividadeconomica }}</td>
                          <td>{{ $ma->direccionnegocio }}</td>
                          <td style="width: 150px;">
                              <a class="btn btn-info azul" data-title="Editar Datos del Negocio" href="{{URL::action('NegocioController@edit',$ma->idnegocio)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              @if($ma->estado == 'ACTIVO')
                              <a class="btn btn-danger rojo" data-title="Inabilitar Negocio" href="" data-target="#modal-delete-{{$ma->idnegocio}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              @else
                              <a class="btn btn-primary azul" data-title="Habilitar Negocio" href="" data-target="#modal-delete-{{$ma->idnegocio}}" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>
                              @endif
                          </td>
                      </tr>
                      @include('negocio.modal')
                  <?php $cont = $cont + 1; ?>
                  @endforeach
                </table>
            </div>
            {{$negocios->render()}}
        </div>
</div>

<div class="row">
  <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>


@endsection