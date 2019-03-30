@extends('layouts.inicio')
@section('contenido')
<style type="text/css">
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
</style>
<style type="text/css">
  .circuloCSS{
  width: 31px;
  height: 31px;
  text-align: center;
  padding: 6px 0;
  font-size: 13px;
  line-height: 1.43;
  border-radius: 16px;
}
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li class="active"> Créditos </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>SELECCIONE UN CRÉDITO</b></h4>


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
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CRÉDITOS</h4>
                          </th>
                      </tr>
                        <tr class="info">
                        	<th style="width: 30px;">No.</th>
                            <th>Fecha</th>
                            <th>Tipo Crédito</th>
                            <th>Negocio</th>
                            <th>Monto</th>
                            <th>Tasa de Interés</th>
                            <th>Cuota</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                   <?php $cont = 1; ?> 
                   @foreach ($cuentas as $ma)
                      <tr>
                      	  <td>{{ $cont }}</td>
                          <td>{{ $ma->fecha }}</td>
                          <td>{{ $ma->estadoPrestamo }}</td>
                          <td>{{ $ma->nombreNegocio }}</td>
                          <td>$ {{ $ma->monto }}</td>
                          <?php $tasa = $ma->interes * 100; ?> 
                          <td>{{ $tasa }} %</td>
                          <td>$ {{ $ma->cuotadiaria }}</td>
                          <td style="width: 150px;">
                            <a class="btn btn-warning amarillo"  data-title="Ver Garantias" href="{{ url('cliente/credito/garantias', ['id' => $ma->idprestamo]) }}" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                  <?php $cont = $cont + 1; ?>
                  @endforeach
                </table>
            </div>
        </div>
    @if($cuentas == null)
      <p style="text-align: center;">No hay créditos para este cliente</p>
    @endif
</div>

<div class="row">
  <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>

@endsection