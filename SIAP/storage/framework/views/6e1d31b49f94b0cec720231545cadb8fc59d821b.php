<?php $__env->startSection('contenido'); ?>

<style type="text/css">
  th{
    text-align: center;
  }


  a.total{
    color: black;
  }
  a.total:visited {text-decoration:none; color:#000} /*Link visitado*/
  a.total:active {text-decoration:none; color:#000;} /*Link activo*/
  a.total:hover {text-decoration:none; color:#000; } /*Mause sobre el link*/
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cuenta->idcuenta)); ?>"> Cuenta</a></li>
    <li><a href="<?php echo e(url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta])); ?>"> Cartera de Pagos</a></li>
    <li class="active">Proyección de Cartera de Pagos</li>
  </ol>
</section>
<br><br>

<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
<br>
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 0px 0px 10px 0px;"><b>PROYECCIÓN DE LA CARTERA DE PAGOS</b></h4>




<section class="content">

<div class="table-responsive">
  <table class="table table-striped table-bordered  table-condensed table-hover">
    <thead>
      <tr class="info">
        <th style="border: 1px solid #333; width: 75px; background: #fff; border-left: 0px; border-top: 0px;" rowspan="3"> </th>
        <th style="border: 1px solid #333; width: 200px" rowspan="2" align="center"><span>N</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>MONTO</span></th>
        <th style="border: 1px solid #333; width: 130px" align="center"><span>Interés diario</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>PAGOS DIARIOS</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>CUOTA DIARIA</span></th>
        <th style="border: 1px solid #333; width: 200px" rowspan="2" align="center"><span>CARTERA</span></th>
      </tr>
      <tr class="info">
        <?php $interes = $tipo_credito->interes * 100; ?>
        <td style="border: 1px solid #333; height: 10px; text-align:center;"><?php echo e($interes); ?> %</td>
      </tr>
      <tr class="info">
      <td style="border: 1px solid #333; text-align: right;"><?php echo e($cuenta->numeroprestamo); ?></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span><?php echo e($prestamo->monto); ?></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
       <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span> <?php echo e($prestamo->cuotadiaria); ?></td>
       <td style="border: 1px solid #333; text-align:center;"> <?php echo e($cartera->nombre); ?></td>
      </tr>
    </thead>
    <tbody>
      <tr class="warning">
        <td style="border: 1px solid #333" align="center"><span>DIA</span></td>
        <td style="border: 1px solid #333" align="center"><span>FECHA</span></td>
        <td style="border: 1px solid #333" align="center"><span>MONTO</span></td>
        <td style="border: 1px solid #333" align="center"><span>INTERES DIARIO</span></td>
        <td style="border: 1px solid #333" align="center"><span>CUOTA CAPITAL</span></td>
        <td style="border: 1px solid #333" align="center"><span>TOTAL DIARIO</span></td>
        <td style="border: 1px solid #333" align="center"><span>FECHA EFECTIVA DE PAGO</span></td>
        <td style="border: 1px solid #333" align="center"><span>ESTADO</span></td>
      </tr>
      
      <?php foreach($liquidaciones as $ma): ?>
      
       
        <?php if($ma->estado == 'CANCELADO'): ?>
          <tr style="background: #ccff90;">
        <?php elseif($ma->estado == 'ATRASO'): ?>
          <tr style="background: #ffcdd2;">
        <?php elseif($ma->estado == 'ABONO'): ?>
          <tr style="background: #fff59d;">
        <?php elseif($ma->estado == 'NO VALIDO'): ?>
          <tr style="background: #eeeeee;">
        <?php else: ?>
          <tr>
        <?php endif; ?>
            <?php if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d')): ?>  
            <td style="border: 1px solid #333; background: #ffd740;" align="center"> <?php echo e($ma->contador); ?></td>
            <?php else: ?>
              <td style="border: 1px solid #333;" align="center"><?php echo e($ma->contador); ?></td>
            <?php endif; ?>

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            <?php if( $ma->fechadiaria != null): ?>
            <td style="border: 1px solid #333;" align="center"><span> <?php echo e($ma->fechadiaria->format('l j  F Y ')); ?></span></td>
            <?php else: ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechadiaria); ?></span></td>
            <?php endif; ?>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->monto); ?></td>

            <?php if( $ma->abonocapital == "NO"): ?>
              <td style="border: 1px solid #333; text-align: right; background:#b2ff59;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->interes); ?></td>
            <?php else: ?>
              <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->interes); ?></td>
            <?php endif; ?>

            <?php if( $ma->abonocapital == "SI"): ?>
              <td style="border: 1px solid #333; text-align: right; background: #b2ff59;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->cuotacapital); ?></td>
            <?php else: ?>
              <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->cuotacapital); ?></td>
            <?php endif; ?>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->totaldiario); ?></td>

            <?php if( $ma->fechaefectiva != null): ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechaefectiva->format('l j  F Y ')); ?></span></td>
            <?php else: ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechaefectiva); ?></span></td>
            <?php endif; ?>

            <td style="border: 1px solid #333" align="center"><span> <?php echo e($ma->estado); ?></span></td>

          </tr>
      <?php endforeach; ?>
      <tr class="danger">
        <td style="border: 1px solid #333"><span>TOTALES</span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de Intereses" class="rojo total"> <b><?php echo e($sum_interes_diario); ?></b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de cuota capital" class="rojo total"> <b><?php echo e($sum_cuota_capital); ?></b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total diario" class="rojo total"> <b><?php echo e($sum_total_diario); ?></b> </a></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="row">
  <a href="<?php echo e(url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta])); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>