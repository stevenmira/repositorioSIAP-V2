<?php $__env->startSection('contenido'); ?>
<style type="text/css">
  .padd{
    padding: 0px 170px 0px 170px;
  }
</style>
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    DESEMBOLSO CON REFINANCIAMIENTO 
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cuenta->idcuenta)); ?>"> Cuenta</a></li>
    <li class="active">Desembolso con refinanciamiento</li>
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
        <td style="border: 1px solid #333; text-align: right;">
          <span class="pull-left" >$ </span> 
          <span class="pull-right" id="ppmonto"><?php echo e(number_format($desembolso, 2)); ?></span></td>
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
<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
  <?php if(Session::has('msj')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>   <?php echo e(Session::get('msj')); ?> </p>
  </div>
  <?php endif; ?>
</div>

<?php echo e(Form::Open(['action'=>'CuentaController@desembolsoRefinanciamientoPDF', 'target'=>'_blank'])); ?>

<div class="padd">
  <table style="width: 100%; border-collapse: collapse;">
    <tr>
      <td style="width: 50%; font-weight:bold;">Desembolso</td>
      <td style="width: 25%; font-weight:bold;" id="ppdesembolso">$ <?php echo e(number_format($desembolso, 2)); ?></td>
      <td>
        <?php echo Form::number('desembolso', $desembolso, ['placeholder'=>'Desembolso', 'step'=>'0.01', 'onkeyup'=>'suma()', 'id'=>'pdesembolso']); ?>

      </td>
      
    </tr>
    <tr>
      <td>( - Desc. De $4.50 de cada $100.00 por desembolso)</td>
      <td id="ppcomision">$ <?php echo e(number_format($comision, 2)); ?></td>
      <td>
        <?php echo Form::number('comision', $comision, ['placeholder'=>'Comision', 'step'=>'0.01', 'onkeyup'=>'suma()', 'id'=>'pcomision']); ?>

      </td>
    </tr>
    <tr>
      <?php if($cuotas > 1): ?>
      <td>( - Desc. de cuotas atrasadas  ( <?php echo e($cuotas); ?> ) )</td>
      <?php else: ?>
      <td>( - Desc. de cuotas  ( <?php echo e($cuotas); ?> ) )</td>
      <?php endif; ?>
      <td id="pptotalCuota">$ <?php echo e(number_format($totalCuota, 2)); ?></td>
      <td>
        <?php echo Form::number('totalCuota', $totalCuota, ['placeholder'=>'Total Cuota', 'step'=>'0.01', 'onkeyup'=>'suma()', 'id'=>'ptotalCuota']); ?>

      </td>
    </tr>
    <tr>
      <td>( - Desc. de mora por incumplimiento )</td>
      <td  id="ppmora">$ <?php echo e(number_format($mora, 2)); ?></td>
      <td>
        <?php echo Form::number('mora', $mora, ['placeholder'=>'Mora', 'step'=>'0.01', 'onkeyup'=>'suma()', 'id'=>'pmora']); ?>

      </td>
    </tr>
    <tr>
      <td>( - Saldo capital del crédito anterior  )</td>
      <td>
        <u>
          <span  id="ppsaldoCapitalAnterior">$ <?php echo e(number_format($saldoCapitalAnterior,2)); ?></span>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </u>
      </td>
      <td>
        <?php echo Form::number('saldoCapitalAnterior', $saldoCapitalAnterior, ['placeholder'=>'Saldo Capital Anterior', 'step'=>'0.01', 'onkeyup'=>'suma()', 'id'=>'psaldoCapitalAnterior']); ?>

      </td>
    </tr>
    <tr>
      <td>EFECTIVO A RECIBIR</td>
      <td style="font-weight: bold;" id="pptotal"><b>$ <?php echo e(number_format($total,2)); ?></b></td>
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

<button type="submit" class="btn btn-danger btn-lg pull-right">
  <i class="fa fa-print" aria-hidden="true"></i> Imprimir
</button>

<input type="number" name="idcuenta" hidden="on" value="<?php echo e($cuenta->idcuenta); ?>">
<input type="number" name="idprestamo" hidden="on" value="<?php echo e($prestamo->idprestamo); ?>">
<input type="number" name="idcliente" hidden="on" value="<?php echo e($cliente->idcliente); ?>">
<input type="number" name="cuotas" hidden="on" value="<?php echo e($cuotas); ?>">
<?php echo e(Form::Close()); ?>




<!-- <input  id="monto" value="<?php echo e($prestamo->monto); ?>" type="hidden"></input> -->

<?php $__env->startPush('scripts'); ?>
<!-- InputMask -->
<script src="<?php echo e(asset('js/inputmask/jquery3.js')); ?>"></script>  

<script>
  function suma(){

    // desembolso
    pdesembolso = parseFloat(document.getElementById("pdesembolso").value);
    if (isNaN(pdesembolso)){
      pdesembolso = 0.00;
    }

    //comision
    pcomision = parseFloat(document.getElementById("pcomision").value);
    if (isNaN(pcomision)){
      pcomision = 0.00;
    }

    //totalCuota
    ptotalCuota = parseFloat(document.getElementById("ptotalCuota").value);
    if (isNaN(ptotalCuota)){
      ptotalCuota = 0.00;
    }

    //mora
    pmora = parseFloat(document.getElementById("pmora").value);
    if (isNaN(pmora)){
      pmora = 0.00;
    }

    //saldoCapitalAnterior
    psaldoCapitalAnterior = parseFloat(document.getElementById("psaldoCapitalAnterior").value);
    if (isNaN(psaldoCapitalAnterior)){
      psaldoCapitalAnterior = 0.00;
    }

    // Se refleja en el html
    document.getElementById("ppmonto").innerHTML = pdesembolso.toFixed(2);

    $('#ppdesembolso').html("$ "+ pdesembolso.toFixed(2));
    $('#ppcomision').html("$ "+ pcomision.toFixed(2));
    $('#pptotalCuota').html("$ "+ ptotalCuota.toFixed(2));
    $('#ppmora').html("$ "+ pmora.toFixed(2));
    $('#ppsaldoCapitalAnterior').html("$ "+ psaldoCapitalAnterior.toFixed(2));

    efectivoRecibir = pdesembolso - pcomision - ptotalCuota - pmora - psaldoCapitalAnterior;
    efectivoRecibir = efectivoRecibir.toFixed(2);

    $('#pptotal').html("$ "+ efectivoRecibir);
  }

</script>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>