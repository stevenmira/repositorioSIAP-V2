@extends ('layouts.inicio')
@section('contenido')
<style type="text/css">
  .padd{
    padding: 0px 170px 0px 170px;
  }
</style>
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Desembolso Completo
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::action('ClienteController@index')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li><a href="{{URL::action('CuentaController@show',$cuenta->idcuenta)}}"> Cuenta</a></li>
    <li class="active">Desembolso</li>
  </ol>
</section>
<br>    

<div class="row">
  <!-- <img align="right"  src="{{asset('img/log.jpg')}}" width="180px" height="70px"> -->
  <h4 align="center"> <b>AFIMID, S.A. DE C.V.</b></h4>
  <h4 colspan="2" align="center">
    ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS<br>SOCIEDAD ANONIMA DE CAPITAL<br>VARIABLE
  </h4>
</div>

<div class="padd">
  <p align="right">{{ $prestamo->fecha->format('d/m/Y') }}</p>
  <p>Detalle de desembolso aprobado</p>
</div>
<br>
<div class="padd">
  <table  style="width: 100%; border-collapse: collapse;">
    <thead>
      <th style="border: 1px solid #333; text-align: center; width: 5%" rowspan="2">N</th>
      <th style="border: 1px solid #333; text-align: center; width: 45%"  rowspan="2">MONTO</th>
      <th style="border: 0px solid #fff; width: 20%;"  rowspan="2"></th>
      @if($prestamo->idtipodesembolso == 1)
        <th style="border: 1px solid #333; width: 30%; text-align: center;"  rowspan="2">EFECTIVO</th>
      @else
        <th style="border: 1px solid #333; width: 30%; text-align: center;"  rowspan="2">CHEQUE</th>
      @endif
    </thead>
    <tbody>
      <tr>
        <td style="border: 1px solid #333" align="right">{{$cuenta->numeroprestamo}}</td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span> {{ number_format($prestamo->monto, 2) }}</td>
        <td style="border: 0px solid #fff;"></td>
        @if($prestamo->idtipodesembolso == 2)
          <td style="border: 1px solid #333; text-align: center;">{{$prestamo->numerocheque}} </td>
        @endif
      </tr>
    </tbody>
  </table>
</div>

<br>
<br>
<div class="padd">
  <table style="width: 100%; border-collapse: collapse;">
    <tr>
      <td >Desembolso</td>
      <td style="width: 50%">$ {{ number_format($prestamo->monto, 2) }}</td>
    </tr>
    <tr>
      <td>( - Desc. De $4.50 de cada $100.00 por desembolso)</td>
      <td><u>$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($costo, 2) }}&nbsp;</u></td>
    </tr>
    <tr>
      <td>EFECTIVO A RECIBIR</td>
      <td>$ {{ number_format($montoreal, 2) }}</td>
    </tr>
  </table>
</div>
<br>
<div class="padd">
  <aside class="col-md-6" style="padding: 0px;">
    <table style="width: 100%" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
      </tr>
    </table>
    <table style="width: 100%" cellpadding="0" cellspacing="0">
      <tr>
        <td style="width: 20%;">NOMBRE:</td>
        <td>{{ $cliente->nombre}} {{ $cliente->apellido }}</td>
      </tr>
      <tr>
        <td>DUI: </td>
        <td>{{ $cliente->dui }}</td>
      </tr>
      <tr>
        <td>NIT: </td>
        <td>{{ $cliente->nit }}</td>
      </tr>
    </table>
    <table style="width: 100%"  cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">DEUDOR/A RECIBI CONFORME</td>
      </tr>
    </table>
  </aside>
  @if($codeudor != null)
  <aside class="col-md-6" style=" padding: 0px;">
    <table style="width: 100%" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
      </tr>
    </table>
    <table style="width: 100%" cellpadding="0" cellspacing="0">
      <tr>
        <td style="width: 20%;">NOMBRE:</td>
        <td>{{ $codeudor->nombre }} {{ $codeudor->apellido }}</td>
      </tr>
      <tr>
        <td>DUI: </td>
        <td>{{ $codeudor->dui }}</td>
      </tr>
      <tr>
        <td>NIT: </td>
        <td>{{ $codeudor->nit }}</td>
      </tr>
    </table>
    <table style="width: 100%"  cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">CODEUDOR/A RECIBI CONFORME</td>
      </tr>
    </table>
  </aside>
  @endif
</div>
  

<div class="row">
  <a href="{{URL::action('CuentaController@desembolsoPDF',$cuenta->idcuenta)}}" class="btn btn-danger btn-lg col-md-offset-10" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR</a>
</div>

@endsection