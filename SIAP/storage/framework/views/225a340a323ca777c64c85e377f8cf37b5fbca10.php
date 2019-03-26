<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <div class="row text-right">
    <img  src="<?php echo e(asset('img/log.jpg')); ?>" width="150px" height="60px">
  </div>
</section>


<section class="content-header">
  
  
  <h4 align="center"><b>REPORTE DE CARTERA DE CLIENTES</b></h4>
  <p><?php echo e($fecha); ?></p>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed text-centered" style="border: 1px solid #333;">
              <thead>
                <tr style="border: 1px solid #333;text-align: center;">
                  <th style="border: 1px solid #333;text-align: center;">Nº</th>
                  <th style="border: 1px solid #333;text-align: center; width: 220px;">CLIENTE/NOMBRE</th>
                  <th style="border: 1px solid #333;text-align: center;">SALDO CAPITAL</th>
                  <th style="border: 1px solid #333;text-align: center;">INTERES DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">CAPITAL DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">TOTAL RECIBIDO DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">#CUOTAS ATRASADAS</th>
                  <th style="border: 1px solid #333;text-align: center;">PRECIO DE CUOTA</th>
                  <th style="border: 1px solid #333;text-align: center;">TOTAL CUOTAS ATRASADAS</b></th>
                </tr>
              </thead>

              <?php
                $n=0;
              ?>
              <tbody>
                <?php foreach($consulta1 as $con): ?>
                <tr>
                  <?php $n=$n+1?>
                  <td style="border: 1px solid #333;"><?php echo e($n); ?></td>

                  <td style="border: 1px solid #333;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                  
                 
                  <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($con->monto); ?> </td>


                  <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->interes); ?></td>
                  <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->cuotacapital); ?></td>
                  <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->total); ?></td>
                  <td style="border: 1px solid #333; text-align: right;"> YYY </td>
                  <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e($con->cuotadiaria); ?></td>
                  
                  <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> ZZZ </td>
                </tr>
                  
                <?php endforeach; ?>
              </tbody>
          </table>
      </div>
    </div>
  </div>


 

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>