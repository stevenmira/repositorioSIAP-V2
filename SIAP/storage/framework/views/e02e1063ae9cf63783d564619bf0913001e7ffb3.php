<?php $__env->startSection('contenido'); ?>

<!-- Select CSS -->
<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-select.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/table.css')); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

    <!-- Notificación -->
 

    <?php if(Session::has('unicidad')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> No se pudo actualizar, el cliente con el número de DUI  <b><?php echo e(Session::get('unicidad')); ?></b>  ya está en uso.</h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('update')): ?>
    <div class="alert  fade in" style="background:  #bbdefb;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> El cliente  <b><?php echo e(Session::get('update')); ?></b>  ha sido actualizado correctamente.</h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('activo')): ?>
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> El cliente  <b><?php echo e(Session::get('activo')); ?></b>  fué dado de baja exitosamente.</h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('fallo')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('fallo')); ?></b>  </h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('error1')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('error1')); ?></b>  </h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('error5')): ?>
   
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('error5')); ?></b>  </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('exito1')): ?>
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><?php echo e(Session::get('exito1')); ?>. Ver detalles de la cuenta <a href="<?php echo e(url('cuenta/'.$cuenta->idcuenta)); ?>" style="color:blue">AQUI</a></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('cmp1')): ?>
    <div class="alert  fade in" style="background:  #ffe57f;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>  <b>Advertencia: componente -- <?php echo e(Session::get('cmp1')); ?> --</b> </h4>
    </div>
    <?php endif; ?>
    <!-- Fin Notificación -->


<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    <?php if(Session::has('bandera')): ?>
    Credito Completo
    <?php else: ?>
    Refinanciamiento
    <?php endif; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
   
    <li class="active">Credito</li>
  </ol>
</section>
<br>


  <div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <h2>El Credito ha sido Creado Correctamente</h2>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="pricing-table">
                <div class="panel panel-primary" style="border: none;">
                    <div class="controle-header panel-heading panel-heading-landing">
                        <h1 class="panel-title panel-title-landing">
                            Negocio: <strong><?php echo e($negocio->nombre); ?></strong>
                        </h1>
                    </div>
                    <div class="controle-panel-heading panel-heading panel-heading-landing-box">
                        Cliente: <strong><?php echo e($persona->nombre); ?> <?php echo e($persona->apellido); ?></strong>
                    </div>
                    <div class="panel-body panel-body-landing">
                        <table class="table">
                            <tr>
                                <td width="50px"><i class="fa fa-check"></i></td>
                                <td><strong>Monto:</strong></td>
                                <td><?php echo e($prestamo->montooriginal); ?></td>
                            </tr>
                            <tr>
                                <td width="50px"><i class="fa fa-check"></i></td>
                                <td><strong>Monto Financiado:</strong></td>
                                <td><?php echo e($cuenta->montocapital); ?></td>
                            </tr>
                            <tr>
                                <td width="50px"><i class="fa fa-check"></i></td>
                                <td><strong>Interes:</strong></td>
                                <td><?php echo e(($cuenta->interes)*100); ?>%</td>
                            </tr>
                            <tr>
                              <td width="50px"><i class="fa fa-check"></i></td>
                              <td><strong>Fecha Ultima de Pago:</strong></td>
                              <td><?php echo e($prestamo->fechaultimapago); ?></td>
                          </tr>
                        </table>
                    </div>
                    <div class="panel-footer panel-footer-landing">
                        <a href="<?php echo e(URL::action('LiquidacionController@carteraPDF',$cuenta->idcuenta)); ?>" target="_blank" class="btn btn-price btn-success btn-lg">Imprimir Cartera del Cliente</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>


<!-- InputMask -->
<script src="<?php echo e(asset('js/inputmask/jquery3.js')); ?>"></script>  
<script src="<?php echo e(asset('js/inputmask/input-mask.js')); ?>"></script>
<script src="<?php echo e(asset('js/inputmask/input-mask-date.js')); ?>"></script>


<!-- Select -->
<script src="<?php echo e(asset('js/bootstrap-select.min.js')); ?>"></script>

<!--Autocomplete-->
<script src="<?php echo e(asset('js/search/autocomplete.js')); ?>"></script>

<script src="<?php echo e(asset('js/popover.js')); ?>"></script>

<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>


<!--searchphp-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>