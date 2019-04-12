@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
        <i>CRÉDITO </i><i class="fa fa-chevron-right" aria-hidden="true"></i>
        @if($prestamo->estadodos == "ACTIVO")
          <b style="color: green;">{{ $prestamo->estadodos }}</b>
        @elseif($prestamo->estadodos == "CERRADO")
          <b style="color:#3F729B;">{{ $prestamo->estadodos }}</b>
        @else
          <b style="color: #ff8a80;">{{ $prestamo->estadodos }}</b>
        @endif

         <i class="col-md-offset-2 col-lg-offset-2 col-sm-offset-2">CUENTA </i><i class="fa fa-chevron-right" aria-hidden="true"></i>  
        @if($cuenta->estado == "ACTIVO")
          <b style="color: green;">{{ $cuenta->estado }}</b>
        @else
          <b style="color:#ff8a80;">{{ $cuenta->estado }}</b>
        @endif
  </h1>
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
        
  </h1> 
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li class="active">Cuenta</li>
  </ol>
</section>
<br>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  @if (Session::has('inactivo'))
    <div class="alert  fade in" style="background:  #ffff8d;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> La cuenta ha sido modificada al estado <b>{{ Session::get('inactivo')}}</b>.</h4>
    </div>
  @endif

  @if (Session::has('activo'))
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> La cuenta ha sido modificada al estado <b>{{ Session::get('activo')}}</b>.</h4>
    </div>
  @endif

  @if (Session::has('inactivoP'))
    <div class="alert  fade in" style="background:  #ffff8d;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> El Prestamo ha sido modificado al estado <b>{{ Session::get('inactivoP')}}</b>.</h4>
    </div>
  @endif

  @if (Session::has('activoP'))
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> El prestamo ha sido modificado al estado <b>{{ Session::get('activoP')}}</b>.</h4>
    </div>
  @endif

  @if (Session::has('exito'))
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> {{ Session::get('exito')}} </P>
  </div>
  @endif
</div>
    
<section class="posts col-md-9">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            CLIENTE
            @if($usuarioactual->idtipousuario==1)
            <a href="{{URL::action('ClienteController@show',$cliente->idcliente)}}">
              <span class="pull-right"> ver perfil <i class="fa fa-user"></i></span> 
            </a>
            @endif
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">

            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>CARTERA CLIENTE:</td>
                    <td>{{ $cartera->nombre}}</td>
                  </tr>

                  <tr>
                    <td>NOMBRE CLIENTE:</td>
                    <td>{{ $cliente->nombre}} {{ $cliente->apellido }} ({{$edad}} años)</td>
                  </tr>

                  <tr>
                    <td>DUI CLIENTE:</td>
                    <td>{{ $cliente->dui }}</td>
                  </tr>
                </tbody>
              </table>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            NEGOCIO 
            @if($usuarioactual->idtipousuario==1)
            <a href="{{URL::action('NegocioController@edit',$negocio->idnegocio)}}">
              <span class="pull-right">editar <i class="fa fa-info-circle"></i></span> 
            </a>
            @endif
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>NOMBRE NEGOCIO:</td>
                    <td>{{ $negocio->nombre}}</td>
                  </tr>

                  <tr>
                    <td>ACTIVIDAD ECON.:</td>
                    <td>{{ $negocio->actividadeconomica}}</td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN NEGOCIO:</td>
                    <td>{{ $negocio->direccionnegocio }}</td>
                  </tr>
                </tbody>
              </table>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            CRÉDITO
            @if($usuarioactual->idtipousuario==1)
            <a data-target="#modalCredito-delete-{{$prestamo->idprestamo}}" data-toggle="modal" style="cursor: pointer;">
              <span class="pull-right"> editar <i class="fa fa-info-circle"></i></span> 
            </a>
            @include('cuenta.modalCredito')
            @endif
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>CRÉDITO:</td>
                    <td>{{ $prestamo->estado}}</td>
                    <td>FECHA:</td>
                    <td>{{ $prestamo->fecha->format('l j  F Y ') }}</td>
                    <td>DESEMBOLSO:</td>
                    @if($prestamo->idtipodesembolso == 1)
                      <td> {{ $tipo_desembolso->nombre }}</td>
                    @else
                      <td>{{ $prestamo->numerocheque }}</td>
                    @endif
                  </tr>

                  <tr>
                    <td>MONTO:</td>
                    <td>$ {{ $prestamo->monto }}</td>
                    <?php $interes = $tipo_credito->interes * 100;  ?>
                    <td>INTERÉS:</td>
                    <td>{{ $interes }} %</td>
                    <td>CUOTA DIARIA:</td>
                    <td>$ {{ $prestamo->cuotadiaria }}</td>
                  </tr>
                  
                  @if($prestamo->estadodos == 'CERRADO')
                  <tr style="background:rgba(244, 67, 54, 0.1);">
                    <td>SALDO CAPITAL:</td>
                    <td>{{$cuenta->capitalanterior}}</td>
                    <td>CUOTAS ATRASADAS:</td>
                    <td>{{$cuenta->cuotaatrasada}}</td>
                    <td>MORA:</td>
                    <td>{{$cuenta->mora}}</td>
                  </tr>
                  @endif

                </tbody>
              </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
    <div class="box-body">
    @if($usuarioactual->idtipousuario!=1)
    <a href="{{URL::action('ComprobanteController@show',$cuenta->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="{{URL::action('RecordClienteController@recibo',$cuenta->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
    @endif
    @if($usuarioactual->idtipousuario==1)
      <a href="{{URL::action('RecordClienteController@pagare',$cuenta->idcuenta)}}" target="_blank" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Imprimir pagaré">
        <i class="fa fa-print"></i> Pagaré
      </a>
      <a href="{{ url('cuenta/desembolso', ['id' => $cuenta->idcuenta]) }}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver desembolso">
        <i class="fa fa-print"></i> Desembolso
      </a>
      <a href="{{ url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta]) }}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver cartera de pagos">
        <i class="fa fa-money"></i> Cartera Pagos
      </a>
      <a href="{{URL::action('ComprobanteController@show',$cuenta->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="{{URL::action('RecordClienteController@recibo',$cuenta->idcuenta)}}" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
      <a data-target="#modal-deleteP-{{$cuenta->idcuenta}}" data-toggle="modal" style="background: #ff8a80; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Cambiar estado del prestamo">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <b>Préstamo </b>
       </a>
       <a data-target="#modal-delete-{{$cuenta->idcuenta}}" data-toggle="modal" style="background: #ff8a80; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Cambiar estado de la cuenta">
       <i class="fa fa-info-circle" aria-hidden="true"></i> <b>Cuenta </b>
      </a>
     
      @endif
    </div>
</aside>

@include('cuenta.modal')

<div>@include('cuenta.modalPrestamo')</div>
<div>@include('cuenta.modalDelete')</div>

<div class="row">
  <a href="{{URL::action('RecordClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

@if($usuarioactual->idtipousuario==1)
<div class="footer text-right">
  <div class="container-fluid">
      <a href="#" data-target="#modal-deleteD-{{$cuenta->idcuenta}}" data-toggle="modal" style="color: red;"  title="Elimina el Crédito Actual">
      <i class="fa fa-times" aria-hidden="true"></i> <b>Eliminar Crédito</b>
     </a>
  </div>
</div>
@endif

@endsection