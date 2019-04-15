@extends('layouts.inicio')
@section('contenido')
<style type="text/css">
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li class="active"> Codeudor </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>GESTIÓN DE CODEUDORES</b></h4>

<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
  @if (Session::has('create'))
  	<div class="alert  fade in" style="background:  #ccff90;">
  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  	<p>El codeudor -- {{ Session::get('create')}} -- se ha guardado correctamente</p>
  	</div>
  @endif


  @if (Session::has('update'))
  	<div class="alert  fade in" style="background:  #bbdefb;">
  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  	<p> El codeudor  -- {{ Session::get('update')}} --  se ha actualizado correctamente</p>
  	</div>
  @endif

  @if (Session::has('delete'))
    <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> El codeudor -- {{ Session::get('delete')}} --  se ha eliminado correctamente</p>
    </div>
  @endif

  @if (Session::has('advertencia'))
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p> No es posible eliminar al codeudor, al parecer tiene asociado un crédito. Acción fallida
        <?php $idcuenta = (integer)Session::get('advertencia');?>
        <a href="{{URL::action('CuentaController@show',$idcuenta)}}"> ver crédito</a>
      </p>
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
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 0px 0px 25px;">  {{$cliente->nombre}} {{$cliente->apellido}}</i></span> </p>
</div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CODEUDORES<a class="btn btn-success pull-right verde" data-title=" Nuevo Codeudor" href="{{ url('codeudores/nuevo', ['id' => $cliente->idcliente ]) }}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                          </th>
                      </tr>
                        <tr class="info">
                        	<th style="width: 30px;">No.</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DUI</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   <?php $cont = 1; ?> 
                   @foreach ($codeudores as $ma)
                      <tr>
                      	  <td>{{ $cont }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->apellido }}</td>
                          <td>{{ $ma->dui }}</td>
                          <td style="width: 150px;">
                            <a class="btn btn-warning amarillo"  data-title="Ver Datos del Codeudor" href="{{URL::action('CodeudorController@show',$ma->idcodeudor)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a class="btn btn-info azul" data-title="Editar Codeudor" href="{{URL::action('CodeudorController@edit',$ma->idcodeudor)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a class="btn btn-danger rojo" data-title="Eliminar Codeudor" href="" data-target="#modal-delete-{{$ma->idcodeudor}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      @include('codeudor.modal')
                  <?php $cont = $cont + 1; ?>
                  @endforeach
                </table>
            </div>
            {{$codeudores->render()}}
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