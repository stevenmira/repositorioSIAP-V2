<?php $__env->startSection('contenido'); ?>
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
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cuenta->idcuenta)); ?>"> Cuenta</a></li>
    <li class="active">Desembolso</li>
  </ol>
</section>
<br>    

<div class="row">
  <!-- <img align="right"  src="<?php echo e(asset('img/log.jpg')); ?>" width="180px" height="70px"> -->
  <h4 align="center"> <b>AFIMID, S.A. DE C.V.</b></h4>
  <h4 colspan="2" align="center">
    ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS<br>SOCIEDAD ANONIMA DE CAPITAL<br>VARIABLE
  </h4>
</div>

<div class="padd">
  <p align="right"><?php echo e($prestamo->fecha->format('d/m/Y')); ?></p>
  <p>Detalle de desembolso aprobado</p>
</div>
<br>
<div class="padd">
  <table  style="width: 100%; border-collapse: collapse;">
    <thead>
      <th style="border: 1px solid #333; text-align: center; width: 5%" rowspan="2">N</th>
      <th style="border: 1px solid #333; text-align: center; width: 45%"  rowspan="2">MONTO</th>
      <th style="border: 0px solid #fff; width: 20%;"  rowspan="2"></th>
      <?php if($prestamo->idtipodesembolso == 1): ?>
        <th style="border: 1px solid #333; width: 30%; text-align: center;"  rowspan="2">EFECTIVO</th>
      <?php else: ?>
        <th style="border: 1px solid #333; width: 30%; text-align: center;"  rowspan="2">CHEQUE</th>
      <?php endif; ?>
    </thead>
    <tbody>
      <tr>
        <td style="border: 1px solid #333" align="right"><?php echo e($cuenta->numeroprestamo); ?></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span> <?php echo e(number_format($prestamo->monto, 2)); ?></td>
        <td style="border: 0px solid #fff;"></td>
        <?php if($prestamo->idtipodesembolso == 2): ?>
          <td style="border: 1px solid #333; text-align: center;"><?php echo e($prestamo->numerocheque); ?> </td>
        <?php endif; ?>
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
      <td style="width: 50%">$ <?php echo e(number_format($prestamo->monto, 2)); ?></td>
    </tr>
    <tr>
      <td>( - Desc. De $4.50 de cada $100.00 por desembolso)</td>
      <td><u>$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e(number_format($costo, 2)); ?>&nbsp;</u></td>
    </tr>
    <tr>
      <td>EFECTIVO A RECIBIR</td>
      <td>$ <?php echo e(number_format($montoreal, 2)); ?></td>
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
        <td><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></td>
      </tr>
      <tr>
        <td>DUI: </td>
        <td><?php echo e($cliente->dui); ?></td>
      </tr>
      <tr>
        <td>NIT: </td>
        <td><?php echo e($cliente->nit); ?></td>
      </tr>
    </table>
    <table style="width: 100%"  cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">DEUDOR/A RECIBI CONFORME</td>
      </tr>
    </table>
  </aside>
  <?php if($codeudor != null): ?>
  <aside class="col-md-6" style=" padding: 0px;">
    <table style="width: 100%" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
      </tr>
    </table>
    <table style="width: 100%" cellpadding="0" cellspacing="0">
      <tr>
        <td style="width: 20%;">NOMBRE:</td>
        <td><?php echo e($codeudor->nombre); ?> <?php echo e($codeudor->apellido); ?></td>
      </tr>
      <tr>
        <td>DUI: </td>
        <td><?php echo e($codeudor->dui); ?></td>
      </tr>
      <tr>
        <td>NIT: </td>
        <td><?php echo e($codeudor->nit); ?></td>
      </tr>
    </table>
    <table style="width: 100%"  cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">CODEUDOR/A RECIBI CONFORME</td>
      </tr>
    </table>
  </aside>
  <?php endif; ?>
</div>
  

<div class="row">
  <a href="<?php echo e(URL::action('CuentaController@desembolsoPDF',$cuenta->idcuenta)); ?>" class="btn btn-danger btn-lg col-md-offset-10" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR</a>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>