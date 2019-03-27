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
  

  <h1 align="center">REPORTE  DE CONTROL DE CRÉDITOS</h1>
  <br>
  <br>
  <br>

  <div class="row">
    <p class="col-md-3 col-lg-3 col-sm-3  "><b>Cartera:</b>&nbsp;&nbsp;&nbsp; {{$nombreCartera}}</p>
    <p class="col-md-3 col-lg-3 col-sm-3"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp; {{$desde}}</p>
    <p class="col-md-3 col-lg-3 col-sm-3"><b>Fecha Fin:</b>&nbsp;&nbsp;&nbsp; {{$hasta}}</p>
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background:rgba(3, 169, 244, 0.1);">
                <th style="width: 3%;">Nº</th>
                <th style="width: 21%;">CLIENTE</th>
                <th style="width: 7%;">DUI</th>
                <th style="width: 7%;">FECHA DE OTORGAMIENTO</th>
                <th style="width: 8%;">MONTO</th>
                <th style="width: 8%;">INTERÉS</th>
                <th style="width: 8%;">COMISIÓN</th>
                <th style="width: 8%;">EFECTIVO NETO</th>
                <th style="width: 10%;">CARTERA</th>
                <th style="width: 10%;">EJECUTIVO</th>
                <th style="width: 10%;">TIPO DESEMBOLSO</th>
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
                <td style="text-align: left;">{{$con->dui}}</td>
                <td style="text-align: center;">{{$con->fecha}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($con->monto,2) }}</td>
                <td style="text-align: center;">{{ number_format($con->interes,2) }}%</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($con->comision,2) }}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($con->montooriginal,2) }}</td>
                <td style="text-align: left;">{{$con->nombreCartera}}</td>
                <td style="text-align: left;">{{$con->nombreEjecutivo}}</td>
                @if($con->nombreDesembolso == 'EFECTIVO')
                <td style="text-align: left;">{{$con->nombreDesembolso}}</td>
                @else
                <td style="text-align: left;">{{$con->numerocheque}}</td>
                @endif
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
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($sumComision,2) }}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{ number_format($sumMontooriginal,2) }}</td>
                <td></td>
                <td></td>
                <td></td>
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


 

</section>
@endsection