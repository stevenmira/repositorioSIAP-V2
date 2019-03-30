@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Estado de Cuenta</li>
  </ol>
</section>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>ESTADO DE CUENTA</b></h4>

<br><br>
<div class="row">
  <p class="col-md-3 col-lg-3 col-sm-3"><b>Cliente:</b>&nbsp;&nbsp;&nbsp; {{$cliente->nombre}} {{$cliente->apellido}}</p>
  <p class="col-md-3 col-lg-3 col-sm-3"><b>Cartera:</b>&nbsp;&nbsp;&nbsp; {{$cliente->nombeCartera}}</p>
</div>
  <!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
  @if (Session::has('create'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('create')}}</b>.</h4>
  </div>
  @endif

  @if (Session::has('unicidad'))
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> No se pudo actualizar,<b>{{ Session::get('unicidad')}}</b>  ya está en uso.</h4>
  </div>
  @endif

  @if (Session::has('update'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>  <b>{{ Session::get('update')}}</b></h4>
  </div>
  @endif
  @if (Session::has('delete'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El estado de cuenta se elimino correctamente</h4>
  </div>
  @endif

  @if (Session::has('activo'))
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b>{{ Session::get('activo')}}</b></h4>
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
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ESTADOS DE CUENTA<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Estado" href="{{URL::action('ComprobanteController@nuevoestado',$cliente->idcuenta)}}"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                          </th>
                      </tr>
                        <tr class="info">
                            
                            <th>Fecha Realizado</th>
                            <th>Dias Atrasados</th>
                            <th>Total</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   @foreach ($estados as $es)
                     
                      <tr>
                      
                         
                          <td>{{ $es->fechacomprobante}}</td>
                          <td>{{ $es->diasatrasados}}</td>
                          <td>{{ $es->total}}</td>
                          <td>{{ $es->estado }}</td>
                          <td>{{ $es->estadodos }}</td>
                          <td style="width: 200px;">

                              <a class="btn btn-warning amarillo" data-title="Consultar datos" href="{{URL::action('ComprobanteController@mostrar',$es->idcomprobante)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a class="btn btn-info azul" data-title="Editar datos" href="{{URL::action('ComprobanteController@edit',$es->idcomprobante)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              <a class="btn btn-danger rojo" data-title="Imprimir" href="{{URL::action('ComprobanteController@estadoPDF',$es->idcomprobante)}}" data-toggle="modal" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                              <a class="btn btn-danger rojo" data-title="Eliminar" href="" data-target="#modal-delete-{{$es->idcomprobante}}" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>

                          </td>
                      </tr>
                      @include('estadoCuenta.modal')
                  @endforeach
                </table>
            </div>
            {{$estados->render()}}
        </div>
    </div>

<div class="row">
 

 
</div>

</section>



@endsection