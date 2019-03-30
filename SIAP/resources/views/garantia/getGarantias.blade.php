@extends('layouts.inicio')
@section('contenido')
<style type="text/css">
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
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
    <li><a href="{{ url('cliente/creditos', ['id' => $cliente->idcliente ]) }}"> Créditos </a></li>
    <li class="active"> Garantías </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>GESTIÓN DE GARANTÍAS</b></h4>

<div class="row" align="center" style="font-size: 14px; ">
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>{{$prestamo->estado}}</p>
      <p>  {{$prestamo->fecha->format('d-m-Y')}}, Monto: $ {{$prestamo->monto}}, Cuota: $ {{$prestamo->cuotadiaria}} </p>
    </div>
  </aside>
  @if($negocio != null)
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Negocio</p>
      <p>  {{$negocio->nombre}}</p>
    </div>
  </aside>
  @endif
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Deudor</p>
      <p>  {{$cliente->nombre}} {{$cliente->apellido}}</p>
    </div>
  </aside>
  
  @if($codeudor != null)
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Codeudor</p>
      <p>  {{$codeudor->nombre}} {{$codeudor->apellido}}</p>
    </div>
  </aside>
  @else
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Codeudor</p>
      <p>El crédito no tiene codeudor asociado</p>
    </div>
  </aside>
  @endif
</div>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>Garantía del -- {{ Session::get('create')}} -- se ha guardado correctamente</P>
  </div>
  @endif

  @if (Session::has('error'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>   <b>{{ Session::get('error')}}</b>  </P>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> Garantía del  -- {{ Session::get('update')}} -- se ha actualizado correctamente</P>
  </div>
  @endif

  @if (Session::has('delete'))
    <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> La garantía del -- {{ Session::get('delete')}} --  se ha eliminado correctamente</p>
    </div>
  @endif

</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive" style="padding: 5px 5px;">
      <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
              <tr class="">
                <th colspan="12">
                    <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE GARANTÍAS
                      <a class="btn btn-success pull-right verde" data-title="Agregar Garantía" href="{{ url('cliente/credito/garantias/nuevo', ['idprestamo' => $idprestamo]) }}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a> 
                    </h4>
                </th>
            </tr> 
              <tr class="">
                <th style="width: 30px;">No.</th>
                <th style="width: 75px;">Garante</th>
                <th style="width: 110px;">Marca</th>
                <th style="width: 110px;">Serie</th>
                <th style="width: 80px;">Valor</th>
                <th>Descripción</th>
                <th>Otras Especificaciones</th>
                <th style="width: 100px;">Acciones</th>
              </tr>
          </thead>
          <?php $cont = 1; ?> 
           @foreach ($garantias as $ma)
              <tr>
                  <td>{{ $cont }}</td>
                  <td>{{ $ma->tipogarante }}</td>
                  <td>{{ $ma->marca }}</td>
                  <td>{{ $ma->serie }}</td>
                  <td>{{ $ma->valor }}</td>
                  <td>{{ $ma->descripcion }}</td>
                  <td>{{ $ma->otros }}</td>
                  <td>
                    <a class="btn btn-info azul" data-title="Editar Garantía" href="{{URL::action('GarantiaController@edit',$ma->idgarantia)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                    <a class="btn btn-danger rojo" data-title="Eliminar Garantía" href="" data-target="#modal-delete-{{$ma->idgarantia}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
              </tr>
              @include('garantia.modal')
          <?php $cont = $cont + 1; ?>
          @endforeach
      </table>
    </div>
    {{$garantias->render()}}
  </div>
</div>


<div class="row">
  <a href="{{ url('cliente/creditos', ['id' => $cliente->idcliente ]) }}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>

@endsection