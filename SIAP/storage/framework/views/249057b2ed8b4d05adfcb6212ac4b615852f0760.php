<?php $__env->startSection('contenido'); ?>

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cliente->idcuenta)); ?>"> Cuenta</a></li>
    <li><a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>"> Estados de Cuentas</a></li>
    <li class="active">Ver</li>
  </ol>
</section>
<br>

<div style="padding: 10px 100px;">
  <div>
    <table>
      <tr>
        <td style="width: 500px;">
          <img src="<?php echo e(asset('img/log.jpg')); ?>" width="180px" height="70px">
        </td>
        <td valign="bottom">
          <span><?php echo e($diahoy); ?> DE <?php echo e(strtoupper($meshoy)); ?> DE <?php echo e($aniohoy); ?></span>
        </td>
      </tr>
    </table>
  </div>
  <br>
  <div><span>CLIENTE: &nbsp;&nbsp;<?php echo e(strtoupper($cliente->nombre)); ?> <?php echo e(strtoupper($cliente->apellido)); ?></span></div>
  <div><span>NEGOCIO: &nbsp;&nbsp;<?php echo e(strtoupper($cliente->nombreNegocio)); ?> </span></div>
  <div><span>DUI: &nbsp;&nbsp;<?php echo e($cliente->dui); ?></span></div>
  <div><span>NIT: &nbsp;&nbsp;<?php echo e($cliente->nit); ?></span></div>
  <div><span>DIRECCION: &nbsp;&nbsp;<?php echo e(strtoupper($cliente->direccion)); ?></span></div>
  <br>
  <div><span>DEPARTAMENTO DE COBRO</span></div>
  
  <div align="center" style="width: 100%"><span>ESTADO DE CUENTA</span></div>
  <br>
  <div><span>DETALLE DE DEUDA</span></div>
  <br>

  <div>
    <table align="center" style="border-collapse: collapse; width: 99%;" >
      <thead>
        <tr>
          <th style="border: 1px solid #333; width: 30px; height: 20px; text-align: center;" rowspan="2"><span style="font-size: 9px;">N</span></th>
          <th style="border: 1px solid #333; width: 200px; text-align: center;" rowspan="2"><span style="font-size: 10px;">DESCRIPCIÓN</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2"><span style="font-size: 10px;">DIAS</span></th>
          <th style="border: 1px solid #333; text-align: center;" colspan="2"><span style="font-size: 10px;">DETALLES</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2" colspan="2"><span style="font-size: 10px;">SALDO CAPITAL SIN<br>INTERESES</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2" colspan="2"><span style="font-size: 10px;">COBRO POR GESTION<br>COBRO</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2" colspan="2"><span style="font-size: 10px;">COBROS DE<br>ADMINISTRACION</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2" colspan="2"><span style="font-size: 10px;">TOTAL</span></th>
        </tr>
        <tr>
          <th style="border: 1px solid #333; text-align: center;" colspan="2"><span style="font-size: 10px;">CUOTA DIARIA<br>$&nbsp;&nbsp; <?php echo e($cliente->cuotadiaria); ?></span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 12px;">1</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Cuotas atrasadas <b><?php echo e($estadoc->diasatrasados); ?></b> de $ <?php echo e($cliente->cuotadiaria); ?></span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"><?php echo e($estadoc->diasatrasados); ?></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->totalcuotas,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->totalcuotas,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 12px;">2</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Saldo capital sin intereses</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px";><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->montoactual,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->montoactual,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px" align="center"><span style="font-size: 12px;">3</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Gastos por gestión cobro / notariales</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>         
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px" align="center"><span style="font-size: 12px;">4</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Gastos de Administracion por Notificacion</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px; " align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        <tr style="font-weight: bold;">
          <td style="border: 1px solid #333; height: 30px; text-align: center;" colspan="2"><span style="font-size: 12px;">TOTAL</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->totalcuotas,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->montoactual,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->total,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
      </tbody>
    </table>
  </div>

  <br><br>
  <div><span>Por cada llamada que le empresa realice a su número de contacto después de a ver vencido el contrato se cargan $5.00 por llamada aun cuando esta no fuere correspondida. números de la empresa asignados: Tel: 2300-8288; Cel. 7333-9200</span></div>
  <br>
  <div><span>&nbsp;&nbsp;&nbsp;&nbsp;1. por visita ténica cuando el contrato ya este vencido se cargaran a su cuenta $10.00 aun cuando no sea atendida,</span></div><br>
  <div><span>- su credito vence el <b><?php echo e($liquidacion->fechadiaria->format('l j')); ?> de <?php echo e($liquidacion->fechadiaria->format('F')); ?> de <?php echo e($liquidacion->fechadiaria->format('Y')); ?></b> de no estar solvente a la fecha de vencimiento. Se cargaran mora por el incumplimiento de 1% diario sobre saldo deudor a la fecha.</span></div>
  <br><br><br>
  <div align="center"><b><span>Email: afimid@yahoo.com</span></b></div>
</div>

<div style="padding: 10px 100px;">
  <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" class="btn btn-danger btn-lg"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>

  <a class="btn btn-danger btn-lg pull-right" data-title="Imprimir" href="<?php echo e(URL::action('ComprobanteController@estadoPDF',$estadoc->idcomprobante)); ?>" data-toggle="modal" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i></a>
</div>
  

<?php echo Form::close(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>