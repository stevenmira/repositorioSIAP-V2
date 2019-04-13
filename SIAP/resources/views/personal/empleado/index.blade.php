@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ URL::action('EmpleadoController@indexPersonal')}}"><i class="fa fa-dashboard"></i> Personal</a></li>
    <li><a href="{{ URL::action('EmpleadoController@index')}}"> Empleado </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE EMPLEADOS</b></h4>

<!-- Criterios de búsquedas -->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      @include('personal.empleado.search')
    </div>
  </div>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>El empleado -- {{ Session::get('create')}} -- se ha guardado correctamente</P>
  </div>
  @endif


  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El empleado  -- {{ Session::get('update')}} -- se ha actualizado correctamente</P>
  </div>
  @endif

  @if (Session::has('delete'))
    <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> El empleado de -- {{ Session::get('delete')}} --  se ha eliminado correctamente</p>
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
                              
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE EMPLEADOS<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Empleado" href="{{URL::action('EmpleadoController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                          </th>
                      </tr>
                        <tr class="info">
                            <th style="width: 30px;">No.</th>
                            <th>Cargo</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>DUI</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                  <?php $cont = 1; ?> 
                   @foreach ($empleados as $ma)
                      <tr>
                          <td>{{ $cont }}</td>
                          <td>{{ $ma->cargo }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->apellido }}</td>
                          <td>{{ $ma->telefono }}</td>
                          <td>{{ $ma->dui }}</td>
                          <td style="width: 230px;">
                              <a class="btn btn-warning amarillo"  data-title="Ver Datos del Empleado" href="{{URL::action('EmpleadoController@show',$ma->idempleado)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                              <a class="btn btn-info azul" data-title="Editar Datos del Empleado" href="{{URL::action('EmpleadoController@edit',$ma->idempleado)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Eliminar Empleado" href="" data-target="#modal-delete-{{$ma->idempleado}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>

                          </td>
                      </tr>
                      @include('personal.empleado.modal')
                      <?php $cont = $cont + 1; ?>
                  @endforeach
                </table>
            </div>
            {{$empleados->render()}}
        </div>
</div>

<div class="row">
  <a href="{{URL::action('EmpleadoController@indexPersonal')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>



@endsection