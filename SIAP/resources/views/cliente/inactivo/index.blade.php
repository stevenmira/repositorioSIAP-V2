@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Clientes</a></li>
    <li class="active">Inactivos </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE CLIENTES</b></h4>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      @include('cliente.inactivo.search')
    </div>
  </div>

  <!-- Notificación -->

  <div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
    @if (Session::has('inactivo'))
    <div class="alert  fade in" style="background:  #f0f4c3;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p> El cliente -- {{ Session::get('inactivo')}} -- se ha dado de alta correctamente</p>
    </div>
    @endif
  </div>

  <!-- Fin Notificación -->

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CLIENTES INACTIVOS</h4>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Cartera</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DUI</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($clientes as $ma)
                      <tr>
                          <td>{{ $ma->nombreCartera }}</td>
                          <td>{{ $ma->nombre }}</td>
                          <td>{{ $ma->apellido }}</td>
                          <td>{{ $ma->dui }}</td>
                          <td style="width: 200px;">

                              <a class="btn btn-primary azul" data-title="Activar Cliente" href="" data-target="#modal-delete-{{$ma->idcliente}}" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>


                          </td>
                      </tr>
                      @include('cliente.inactivo.modal')
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