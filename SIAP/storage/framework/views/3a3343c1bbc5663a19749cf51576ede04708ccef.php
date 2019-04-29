<?php $__env->startSection('contenido'); ?>
<!-- ChartJS -->
<script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>

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
    <p class="pull-left"><b>Usuario:</b>&nbsp;&nbsp;&nbsp; <?php echo e($usuarioactual->nombre); ?> </p>
    <p class="pull-right"><b>Fecha de Emisión:</b>&nbsp;&nbsp;&nbsp; <?php echo e($fecha_actual); ?></p>
  </div>
  

  <h1 align="center">REPORTE  DE EFECTIVO RECIBIDO</h1>
  <br>
  <br>
  <br>

  <div class="row">
    <p class="col-md-3 col-lg-3 col-sm-3"><b>Cartera:</b>&nbsp;&nbsp;&nbsp; <?php echo e($nombreCartera); ?></p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp; <?php echo e($desde); ?></p>
    <p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha fin:</b>&nbsp;&nbsp;&nbsp; <?php echo e($hasta); ?></p>
    <p class="col-md-1 col-lg-1 col-sm-1"><a style="cursor: pointer;"> Imprimir&nbsp;&nbsp;&nbsp;<i class="fa fa-print"></i></a></p>
  </div>

<div class="row">
    <div class="table-responsive">
        <table style="">
            <thead>
              <tr style="background:rgba(3, 169, 244, 0.1);">
                <th style="width: 3%;">Nº</th>
                <th style="width: 21%;">CARTERA</th>
                <th style="width: 7%;">TOTAL INTERÉS DIARIO</th>
                <th>%</th>
                <th style="width: 7%;">TOTAL CUOTA DIARIA</th>
                <th>%</th>
                <th style="width: 7%;">TOTAL EFECTIVO DIARIO</th>
                <th>%</th>
              </tr>
            </thead>

            <?php
              $n=0;
            ?>
            <tbody>
              <?php foreach($consulta as $con): ?>
              <tr>
                <?php $n=$n+1?>
                <td style="text-align: center; width: 5%;"><?php echo e($n); ?></td>
                <td style="text-align: left; width: 20%;"><?php echo e($con->nombre); ?></td>

                <td style="text-align: right; width: 18%;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total0,2)); ?></td>
                <?php $pt0 = $con->total0/$con->total2*100;?> 
                <td style="text-align: center; width: 7%"><?php echo e(round($pt0,2)); ?> %</td>

                <td style="text-align: right; width: 18%;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total1,2)); ?></td>
                <?php $pt1 = $con->total1/$con->total2*100;?>
                <td style="text-align: center; width: 7%;"><?php echo e(round($pt1,2)); ?> %</td>

                <td style="text-align: right; width: 18%;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->total2,2)); ?></td>
                <?php $pt2 = $con->total2/$con->total2*100;?>
                <td style="text-align: center; width: 7%;"><?php echo e(round($pt2,2)); ?> %</td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tr style="background:rgba(244, 67, 54, 0.1); font-size: 15px;">
                <td></td>
                <td style="text-align: left;">TOTAL</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($suminteres,2)); ?></td>
                <?php $pt0 = $suminteres/$sumtotaldiario*100;?>
                <td style="text-align: center; width: 5%;"><?php echo e(round($pt0,2)); ?> %</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($sumcuotadiaria,2)); ?></td>
                <?php $pt1 = $sumcuotadiaria/$sumtotaldiario*100;?>
                <td style="text-align: center; width: 5%;"><?php echo e(round($pt1,2)); ?> %</td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($sumtotaldiario,2)); ?></td>
                <?php $pt2 = $sumtotaldiario/$sumtotaldiario*100;?>
                <td style="text-align: center; width: 5%;"><?php echo e(round($pt2,2)); ?> %</td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
  <h3 style="text-align: center; padding: 30px 30px 30px 30px;">GRÁFICO DEL EFECTIVO RECIBIDO POR CARTERA EN PORCENTAJE (%)</h3>
  
    <?php foreach($consulta as $con): ?>
    <?php $pt0 = round($con->total0/$con->total2*100,2);?> 
    <?php $pt1 = round($con->total1/$con->total2*100,2);?> 
    <?php $pt2 = round($con->total2/$con->total2*100,2);?> 
    <div class="col-md-4">  
      <canvas id="<?php echo e($con->idcartera); ?>" width="800" height="450"></canvas>
      <script type="text/javascript">
        new Chart(document.getElementById("<?php echo e($con->idcartera); ?>"), 
        {
            type: 'pie',
            data: {
              labels: ["Interes Diario", "Cuota Capital Diario"],
              datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#e8c3b9","#c45850"],
                data: [<?php echo e($pt0); ?>,<?php echo e($pt1); ?>]
              }]
            },
            options: {
              title: {
                display: true,
                text: '<?php echo e($con->nombre); ?>'
              }
            }
        });
      </script>
      <br>
      <table style="border: 0px solid #fff;">
          <tr style="border: 0px solid #fff; border-color:#e8c3b9; border-style:dashed; border-width:2px;">
            <td style="border: 0px solid #fff; width: 40%;">Total interés diario:</td>
            <td style="border: 0px solid #fff; width: 35%; text-align: right; padding: 0px 30px;"><span class="pull-left">$</span> <?php echo e(number_format($con->total0,2)); ?></td>
            <td style="border: 0px solid #fff; width: 25%;"><?php echo e($pt0); ?> %</td>
          </tr>
          <tr style="border: 0px solid #fff; border-color:#c45850; border-style:dashed; border-width:2px;">
            <td style="border: 0px solid #fff; width: 40%;">Total cuota diaria:</td>
            <td style="border: 0px solid #fff; width: 35%; text-align: right; padding: 0px 30px;"><span class="pull-left">$</span> <?php echo e(number_format($con->total1,2)); ?></td>
            <td style="border: 0px solid #fff; width: 25%;"><?php echo e($pt1); ?> %</td>
          </tr>
          <tr style="border: 0px solid #fff; border-color:#fff; border-style:dashed; border-width:2px; font-weight: bold;">
            <td style="border: 0px solid #fff; width: 40%;">Total efectivo recibido</td>
            <td style="border: 0px solid #fff; width: 35%; text-align: right; padding: 0px 30px;"><span class="pull-left">$</span> <?php echo e(number_format($con->total2,2)); ?></td>
            <td style="border: 0px solid #fff; width: 25%;"><?php echo e($pt2); ?> %</td>
          </tr>
        </table>
    </div>
    <?php endforeach; ?>
</div>
<div class="row">
    <h3 style="text-align: center; padding: 30px 30px 30px 30px;">GRÁFICO DEL EFECTIVO TOTAL RECIBIDO EN PORCENTAJE (%)</h3>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4"> 
    <?php $ptt1 = round($suminteres/$sumtotaldiario*100,2);?>
    <?php $ptt2 = round($sumcuotadiaria/$sumtotaldiario*100,2);?>
    <?php $ptt3 = round($sumtotaldiario/$sumtotaldiario*100,2);?>
      <canvas id="total" width="800" height="450"></canvas>
      <script type="text/javascript">
        new Chart(document.getElementById("total"), 
        {
            type: 'pie',
            data: {
              labels: ["Interes Total", "Cuota Capital Total"],
              datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#3e95cd","#8e5ea2"],
                data: [<?php echo e($ptt1); ?>,<?php echo e($ptt2); ?>]
              }]
            },
            options: {
              title: {
                display: true,
                text: 'Distribución del efectivo total recibido'
              }
            }
        });
      </script>
      <br>
      <table style="border: 0px solid #fff;">
          <tr style="border: 0px solid #fff; border-color:#3e95cd; border-style:dashed; border-width:2px;">
            <td style="border: 0px solid #fff; width: 40%;">Total interés recibido:</td>
            <td style="border: 0px solid #fff; width: 35%; text-align: right; padding: 0px 30px;"><span class="pull-left">$</span> <?php echo e(number_format($suminteres,2)); ?></td>
            <td style="border: 0px solid #fff; width: 25%;"><?php echo e($ptt1); ?> %</td>
          </tr>
          <tr style="border: 0px solid #fff; border-color:#8e5ea2; border-style:dashed; border-width:2px;">
            <td style="border: 0px solid #fff; width: 40%;">Total capital recibido:</td>
            <td style="border: 0px solid #fff; width: 35%; text-align: right; padding: 0px 30px;"><span class="pull-left">$</span> <?php echo e(number_format($sumcuotadiaria,2)); ?></td>
            <td style="border: 0px solid #fff; width: 25%;"><?php echo e($ptt2); ?> %</td>
          </tr>
          <tr style="border: 0px solid #fff; border-color:#fff; border-style:dashed; border-width:2px; font-weight: bold;">
            <td style="border: 0px solid #fff; width: 40%;">Total efectivo recibido</td>
            <td style="border: 0px solid #fff; width: 35%; text-align: right; padding: 0px 30px;"><span class="pull-left">$</span> <?php echo e(number_format($sumtotaldiario,2)); ?></td>
            <td style="border: 0px solid #fff; width: 25%;"><?php echo e($ptt3); ?> %</td>
          </tr>
        </table>
    </div>
</div>


<br>

  <?php if($consulta==null): ?>
    <div class="row form-group">
      <p class="col-md-12 col-lg-12 col-sm-12" style="color: red" align="center"><b>NO HAY REGISTRO DE CRÉDITOS</b></p>
    </div>
  <?php endif; ?>

  <div>
    <a href="<?php echo e(URL::action('ReportesController@grafico')); ?>" class="btn btn-primary btn-md col-md-offset-1"> REGRESAR</a>
  </div>


 

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>