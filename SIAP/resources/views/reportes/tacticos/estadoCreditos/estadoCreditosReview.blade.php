@extends ('layouts.inicio')
@section('contenido')
<style type="text/css">
  table{
    width: 100%;
  }
  th{
    border: 1px solid #333;
    text-align: center;
    padding: 3px 15px; 
  }
  td{
    border: 1px solid #333; 
    padding: 3px 6px;
  }
</style>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<section class="content-header">
  <div class="row" style="padding: 20px 20px 20px 20px;">
    <p class="pull-left"><b>Usuario:</b>&nbsp;&nbsp;&nbsp; {{$usuarioactual->nombre}} </p>
    <p class="pull-right"><b>Fecha de Emisión:</b>&nbsp;&nbsp;&nbsp; {{$fecha_actual}}</p>
  </div>
  

  <h1 align="center">REPORTE  DE ESTADO DE CRÉDITOS</h1>
  <br>
  <br>
  <br>

  <div class="row">
    <p class="col-md-3 col-lg-3 col-sm-3"><b>Cartera:</b>&nbsp;&nbsp;&nbsp; {{$nombreCartera}}</p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp; {{$desde}}</p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha fin:</b>&nbsp;&nbsp;&nbsp; {{$hasta}}</p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Estado préstamo:</b>&nbsp;&nbsp;&nbsp; {{$estado}}</p>
    <p class="col-md-2 col-lg-2 col-sm-2"><a style="cursor: pointer;" data-target="#modal-delete-2" data-toggle="modal"> Gráfico de distribución del desembolso <i class="fa fa-question"></i></a></p>
    @include('reportes.tacticos.estadoCreditos.modalGrafico')
    <p class="col-md-1 col-lg-1 col-sm-1"><a style="cursor: pointer;"> Imprimir&nbsp;&nbsp;&nbsp;<i class="fa fa-print"></i></a></p>
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background:rgba(3, 169, 244, 0.1);">
                <th style="width: 3%;">Nº</th>
                <th style="width: 21%;">CLIENTE</th>
                <th style="width: 7%;">NEGOCIO</th>
                <th style="width: 7%;">FECHA DE OTORGAMIENTO</th>
                <th style="width: 8%;">MONTO</th>
                <th style="width: 10%;">CARTERA</th>
                <th style="width: 10%;">TIPO CRÉDITO</th>
                <th style="width: 10%;">ACCIONES</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              @foreach ($consulta as $con)
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;">{{ $n }}</td>
                <td style="text-align: left;">{{$con->nombre}} {{$con->apellido}}</td>
                <td style="text-align: left;">{{$con->nombreNegocio}}</td>
                <td style="text-align: center;">{{$con->fecha}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($con->monto,2) }}</td>
                <td style="text-align: left;">{{$con->nombreCartera}}</td>
                <td style="text-align: left;">{{$con->estado}}</td>
                <td style="text-align: left;"><a target="_blank" href="{{URL::action('CuentaController@show',$con->idcuenta)}}">Ver Credito</a></td>
              </tr>
              @endforeach
            </tbody>
            <tr style="background:rgba(244, 67, 54, 0.1); font-size: 15px;">
                <td></td>
                <td style="text-align: left;">TOTALES</td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($sumMonto,2) }}</td>
                <td></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;</span></td>
            </tr>
        </table>
    </div>
  </div>
</div>

<br>

  @if ($consulta==null)
    <div class="row form-group">
      <p class="col-md-12 col-lg-12 col-sm-12" style="color: red" align="center"><b>NO HAY REGISTRO DE CRÉDITOS</b></p>
    </div>
  @endif

  <div>
    <a href="{{URL::action('ReportesController@estadoCreditos')}}" class="btn btn-primary btn-md col-md-offset-1"> REGRESAR</a>
  </div>

</section>
@endsection