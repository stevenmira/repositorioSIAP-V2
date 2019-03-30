@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Tasas de interés</li>
    <li class="active">Disponibles</li>
  </ol>
</section>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN  DE TASAS DE INTERÉS</b></h4>

<section class="content">

  <!-- Notificación -->
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>La tasa de interés del <b>{{ Session::get('create')}}%</b> ha sido guardada correctamente.</h4>
  </div>
  @endif

  @if (Session::has('unicidad'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> No se pudo actualizar la tasa de interes <b>{{ Session::get('unicidad')}}</b>  ya está en uso.</h4>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La tasa de interés del <b>{{ Session::get('update')}}%</b>  ha sido actualizada correctamente.</h4>
  </div>
  @endif

   @if (Session::has('delete'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>La tasa de interés del <b>{{ Session::get('delete')}}%</b> fué eliminada correctamente.</h4>
  </div>
  @endif

  <!-- Fin Notificación -->

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
                              
                              <h4 style="text-align: center;font-family:  Times New Roman, sans-serif; color: #1C2331;">LISTADO DE TASAS DE INTERÉS DISPONIBLES<a class="btn btn-success pull-right verde" data-title="Agregar Nueva Tasa" href="{{URL::action('TasaInteresController@create')}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                              
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
                              <a class="btn btn-info azul" data-title="Editar Tasa de Interés" href="{{URL::action('TasaInteresController@edit',$ma->idtipocredito)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                          </td>
                      </tr>
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
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>

</section>



@endsection