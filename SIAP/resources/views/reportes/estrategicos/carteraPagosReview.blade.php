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
    padding: 3px 15px;
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
  <br>

  <h1 align="center">REPORTE  DE CARTERA DE PAGOS</h1>
  <br>
  <br>
  <br>
  <div class="row">
    <p class="col-md-3 col-lg-3 col-sm-3"><b>Cartera:</b>&nbsp;&nbsp;&nbsp; {{$cartera->nombre}}</p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp; {{$fecha}}</p>
    <p class="col-md-1 col-lg-1 col-sm-1"><a style="cursor: pointer;"> Imprimir&nbsp;&nbsp;&nbsp;<i class="fa fa-print"></i></a></p>
  </div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background: #ccff90">
                <th colspan="12">
                  <h4 style="text-align: center;"><b>EFECTIVO RECIBIDO DIARIO</b></h4>               
                </th>
              </tr>
              <tr style="background: #ccff90"ffccbc>
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;">FECHA</th>
                <th style="width: 15%;">HORA</th>
                <th style="width: 15%;">TOTAL RECIBIDO</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              @foreach ($consulta1 as $con)
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;">{{ $n }}</td>
                <td style="text-align: left;">{{$con->nombre}} {{$con->apellido}}</td>
                <td style="text-align: left;">{{$con->nombreNegocio}}</td>
                <td style="text-align: center;">{{$fecha}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->total}}</td>
              </tr>
              @endforeach
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> {{  $total1 }} </td>
            </tr>
        </table>
    </div>
  </div>
</div>

<br>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background: #ccff90">
                <th colspan="12">
                  <h4 style="text-align: center;"><b>CUOTAS ATRASADAS</b></h4>               
                </th>
              </tr>
              <tr style="background: #ccff90"ffccbc>
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;"># CUOTAS ATRASADAS</th>
                <th style="width: 15%;">PRECIO DE CUOTA</th>
                <th style="width: 15%;">TOTAL</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              @foreach ($consulta2 as $con)
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;">{{ $n }}</td>
                <td style="text-align: left;">{{$con->nombre}} {{$con->apellido}}</td>
                <td style="text-align: left;">{{$con->nombreNegocio}}</td>
                <td style="text-align: center;">{{$con->cuotas}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->cuotadiaria}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->total}}</td>
              </tr>
              @endforeach
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> {{  $total2 }} </td>
            </tr>
        </table>
    </div>
  </div>
</div>

<br>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background: #ccff90">
                <th colspan="12">
                  <h4 style="text-align: center;"><b>SALDOS DE LA FECHA: {{$fecha}}</b></h4>               
                </th>
              </tr>
              <tr style="background: #ccff90"ffccbc>
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;">SALDO CAPITAL</th>
                <th style="width: 15%;">INTERES DIARIO</th>
                <th style="width: 15%;">CAPITAL DIARIO</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              @foreach ($consulta3 as $con)
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;">{{ $n }}</td>
                <td style="text-align: left;">{{$con->nombre}} {{$con->apellido}}</td>
                <td style="text-align: left;">{{$con->nombreNegocio}}</td>
                <td style="text-align: center;">{{$con->saldo}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->interes}}</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->cuotacapital}}</td>
              </tr>
              @endforeach
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> ??? </td>
            </tr>
        </table>
    </div>
  </div>
</div>

<br>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background: #ccff90">
                <th colspan="12">
                  <h4 style="text-align: center;"><b>SALDOS HASTA LA FECHA</b></h4>               
                </th>
              </tr>
              <tr style="background: #ccff90"ffccbc>
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;">SALDO CAPITAL</th>
                <th style="width: 15%;">INTERES DIARIO</th>
                <th style="width: 15%;">CAPITAL DIARIO</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              @foreach ($consulta4 as $con)
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;">{{ $n }}</td>
                <td style="text-align: left;">{{$con->nombre}} {{$con->apellido}}</td>
                <td style="text-align: left;">{{$con->nombreNegocio}}</td>
                <td style="text-align: center;">{{$con->saldo}}</td>
              </tr>
              @endforeach
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> ??? </td>
            </tr>
        </table>
    </div>
  </div>
</div>

<br>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed text-centered" style="border: 1px solid #333;">
            <thead>
              <tr style="border: 1px solid #333;text-align: center; width: 100%">
                <th style="border: 1px solid #333;text-align: center; width: 2%;">Nº</th>
                <th style="border: 1px solid #333;text-align: center; width: 20%;">CLIENTE/NOMBRE</th>
                <th style="border: 1px solid #333;text-align: center; width: 18%;">NEGOCIO/NOMBRE</th>
                <th style="border: 1px solid #333;text-align: center; width: 8%;">SALDO CAPITAL</th>
                <th style="border: 1px solid #333;text-align: center; width: 8%;">INTERES DIARIO</th>
                <th style="border: 1px solid #333;text-align: center; width: 8%;">CAPITAL DIARIO</th>
                <th style="border: 1px solid #333;text-align: center; width: 8%;">TOTAL RECIBIDO DIARIO</th>
                <th style="border: 1px solid #333;text-align: center; width: 8%;">#CUOTAS ATRASADAS</th>
                <th style="border: 1px solid #333;text-align: center; width: 10%;">PRECIO DE CUOTA</th>
                <th style="border: 1px solid #333;text-align: center; width: 10%;">TOTAL CUOTAS ATRASADAS</b></th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              @foreach ($consulta11 as $con)
              <tr>
                <?php $n=$n+1?>
                <td style="border: 1px solid #333; text-align: center;">{{ $n }}</td>
                <td style="border: 1px solid #333;">{{$con->nombre}} {{$con->apellido}}</td>
                <td style="border: 1px solid #333;">{{$con->nombreNegocio}}</td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> {{$con->monto}} </td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->interes}}</td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->cuotacapital}}</td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span>{{ $con->total }}</td>
                <td style="border: 1px solid #333; text-align: right;"> YYY </td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span>{{$con->cuotadiaria}}</td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> ZZZ </td>
              </tr>
                
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>


  <div>
    <a href="{{URL::action('ReportesController@carteraPagos')}}" class="btn btn-primary btn-md col-md-offset-1"> REGRESAR</a>
  </div>


 

</section>
@endsection