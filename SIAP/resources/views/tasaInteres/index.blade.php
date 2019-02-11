@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
     TASAS DE INTERÉS DISPONIBLES
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Tasas de interés</li>
    <li class="active">Disponibles</li>
  </ol>
</section>

<section class="content">

  <!-- Notificación -->
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>Los datos del cliente <b>{{ Session::get('create')}}</b> han sido guardados correctamente.</h4>
  </div>
  @endif

  @if (Session::has('unicidad'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> No se pudo actualizar, el cliente con el número de DUI  <b>{{ Session::get('unicidad')}}</b>  ya está en uso.</h4>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> Los datos del cliente  <b>{{ Session::get('update')}}</b>  han sido actualizados correctamente.</h4>
  </div>
  @endif

  @if (Session::has('activo'))
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El cliente  <b>{{ Session::get('activo')}}</b>  fué dado de baja exitosamente.</h4>
  </div>
  @endif

  @if (Session::has('error'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>   <b>{{ Session::get('error')}}</b>  </h4>
  </div>
  @endif
  <!-- Fin Notificación -->

  <!-- Criterios de búsquedas -->
  
  <!-- /.row -->

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="alert  fade in" style="background:  rgba(255, 235, 59, 0.7);">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <font face="Comic Sans MS,arial,verdana">Puedes realizar tus búsquedas por la <b>tasa de interés</b> de tu elección</font>
      </div>
      @include('tasaInteres.search')
    </div>
  </div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center;font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE TASAS DE INTERÉS DISPONIBLES</b><a class="btn btn-success pull-right verde" data-title="Agregar Nueva Tasa" href="{{URL::action('TasaInteresController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Tipo Crédito</th>
                            <th>Condición</th>
                            <th>Monto</th>
                            <th>Interés</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($tasas as $ma)
                      <tr>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->condicion }}</td>
                          @if($ma->monto!=0)
                            <td>{{ $ma->monto }}</td>
                          @else
                            <td>No Aplica</td>
                          @endif
                          <td>{{ $ma->interes*100 }}%</td>
                          <td style="width: 230px;">
                              <a class="btn btn-info azul" data-title="Editar Tasa de Intrerés" href="{{URL::action('TasaInteresController@edit',$ma->idtipocredito)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Inhabilitar Tasa" href="" data-target="#modal-delete-{{$ma->idtipocredito}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      @include('tasaInteres.modal')
                  @endforeach
                </table>
            </div>
            
        </div>
</div>

<div class="row">
  <a href="{{ url('home')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>

</section>



@endsection