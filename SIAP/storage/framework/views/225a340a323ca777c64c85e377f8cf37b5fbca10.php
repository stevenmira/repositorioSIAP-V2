<?php $__env->startSection('contenido'); ?>
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
    <p class="pull-left"><b>Usuario:</b>&nbsp;&nbsp;&nbsp; <?php echo e($usuarioactual->nombre); ?> </p>
    <p class="pull-right"><b>Fecha de Emisión:</b>&nbsp;&nbsp;&nbsp; <?php echo e($fecha_actual); ?></p>
  </div>
  <br>

  <h1 align="center">REPORTE  DE CARTERA DE PAGOS</h1>
  <br>
  <br>
  <br>
  <div class="row">
    <p class="col-md-3 col-lg-3 col-sm-3"><b>Cartera:</b>&nbsp;&nbsp;&nbsp; <?php echo e($cartera->nombre); ?></p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp; <?php echo e($fecha); ?></p>
    <p class="col-md-1 col-lg-1 col-sm-1"><a style="cursor: pointer;"> Imprimir&nbsp;&nbsp;&nbsp;<i class="fa fa-print"></i></a></p>
  </div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background: #ccff90">
                <th colspan="12">
                  <h4 style="text-align: center;"><b>EFECTIVO RECIBIDO DIARIO EN LA FECHA</b></h4> 
                  <h4 style="text-align: center;"><b><?php echo e($fecha); ?></b></h4>               
                </th>
              </tr>
              <tr style="background: #ccff90">
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;">INTERES</th>
                <th style="width: 15%;">CUOTA CAPITAL</th>
                <th style="width: 15%;">TOTAL DIARIO</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              <?php foreach($consulta1 as $con): ?>
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;"><?php echo e($n); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombreNegocio); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total0,2)); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total1,2)); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total2,2)); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($t0,2)); ?> </td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($t1,2)); ?> </td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($t2,2)); ?> </td>
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
                  <h4 style="text-align: center;"><b>CUOTAS ATRASADAS HASTA LA FECHA</b></h4>
                  <h4 style="text-align: center;"><b><?php echo e($fecha); ?></b></h4>               
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
              <?php foreach($consulta2 as $con): ?>
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;"><?php echo e($n); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombreNegocio); ?></td>
                <td style="text-align: center;"><?php echo e($con->cuotas); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->cuotadiaria); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->total); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e($total2); ?> </td>
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
                  <h4 style="text-align: center;"><b>SALDO CAPITAL HASTA LA FECHA</b></h4>
                  <h4 style="text-align: center;"><b><?php echo e($fecha_actual); ?></b></h4>

                </th>
              </tr>
              <tr style="background: #ccff90"ffccbc>
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;">SALDO CAPITAL</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              <?php foreach($consulta4 as $con): ?>
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;"><?php echo e($n); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombreNegocio); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->monto,2)); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($total4,2)); ?> </td>
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
                  <h4 style="text-align: center;"><b>SALDOS DE LA FECHA: <?php echo e($fecha); ?></b></h4>               
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
              <?php foreach($consulta3 as $con): ?>
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;"><?php echo e($n); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombreNegocio); ?></td>
                <td style="text-align: center;"><?php echo e($con->saldo); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->interes); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->cuotacapital); ?></td>
              </tr>
              <?php endforeach; ?>
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
                  <h4 style="text-align: center;"><b>DETALLE DEL EFECTIVO RECIBIDO DIARIO</b></h4> 
                  <h4 style="text-align: center;"><b><?php echo e($fecha); ?></b></h4>               
                </th>
              </tr>
              <tr style="background: #ccff90">
                <th style="width: 5%;">Nº</th>
                <th style="width: 25%;">CLIENTE</th>
                <th style="width: 25%;">NEGOCIO</th>
                <th style="width: 15%;">INTERES</th>
                <th style="width: 15%;">CUOTA CAPITAL</th>
                <th style="width: 15%;">TOTAL DIARIO</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              <?php foreach($consulta11 as $con): ?>
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center;"><?php echo e($n); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                <td style="text-align: left;"><?php echo e($con->nombreNegocio); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->interes,2)); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->cuotacapital,2)); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total,2)); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tr style="background: #ffccbc; font-size: 15px;">
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($td0,2)); ?> </td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($td1,2)); ?> </td>
                <td style="text-align: right; font-weight: bold;"><span class="pull-left">&nbsp;$</span> <?php echo e(number_format($td2,2)); ?> </td>
            </tr>
        </table>
    </div>
  </div>
</div>

  <div>
    <a href="<?php echo e(URL::action('ReportesController@carteraPagos')); ?>" class="btn btn-primary btn-md col-md-offset-1"> REGRESAR</a>
  </div>


 

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>