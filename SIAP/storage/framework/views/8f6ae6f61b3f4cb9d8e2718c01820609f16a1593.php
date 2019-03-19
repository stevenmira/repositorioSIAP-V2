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
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"> Nuevo </li>

    <?php if(Session::has('bandera')): ?>
    <li class="active">Financiamiento</li>
    <?php endif; ?>
    <?php if(Session::has('ban')): ?>
    <li class="active">Refinanciamiento</li>
    <?php endif; ?>

    <li class="active"> Fracaso </li>
  </ol>
</section>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;">
  <b>
    <?php if(Session::has('bandera')): ?>
        NUEVO CRÉDITO COMPLETO
        <?php endif; ?>
        <?php if(Session::has('ban')): ?>
        NUEVO REFINANCIAMIENTO
    <?php endif; ?>
  </b>
</h4>
<div class="row text-center">
  <h2><i class="fa fa-info-circle"> Ha Ocurrido un Error  </i></h2>
</div>
<br>
    <!-- Notificación -->
 
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #212121; padding: 0px 0px 0px 0px;">
    
    <?php if(Session::has('msj1A') && Session::has('msj1B')): ?>
    <div class="alert  fade in" style="background:  #ff8a80; font-size: 15px; height: 110px">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
              <table  class="table">
                <tr>
                  <td style="border:0px">La fecha de creacion del préstamo: </td>
                  <td style="border:0px"> <?php echo e(Session::get('msj1A')); ?></td>
                </tr>
                <tr>
                  <td style="border:0px">Debe ser menor a la fecha de comienzo de la cartera de pagos:</td>
                  <td style="border:0px"> <?php echo e(Session::get('msj1B')); ?></td>
                </tr>
              </table>
          </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj2')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj2')); ?></b>  </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj3')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj3')); ?></b>  </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj4')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj4')); ?></b>  </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj5')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj5')); ?></b>  </h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('fallo')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('fallo')); ?></b>  </h4>
    </div>
    <?php endif; ?> 

    <!-- Redefinir Cuota -->
    <?php if(Session::has('msj6')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> <?php echo e(Session::get('msj6')); ?>  </h4>
    </div>
    <?php endif; ?>

    <!-- Categoria E -->
    <?php if(Session::has('msj7')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> <?php echo e(Session::get('msj7')); ?>  </h4>
    </div>
    <?php endif; ?>

    <!-- No posee credito para refinanciar -->
    <?php if(Session::has('msj8')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj8')); ?></b>. Puede abrir un nuevo credito pulsando 
        <a href="<?php echo e(url('credito/create')); ?>">AQUI</a></h4>
    </div>
    <?php endif; ?>

    <!-- Abonos pendientes de pago -->
    <?php if(Session::has('msj9')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj9')); ?></b> Puede revisar la 
        <a href="<?php echo e(url('cuenta/carteraPagos/'.$cuenta)); ?>">cartera de pago</a>  
      </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj10')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj10')); ?></b>. Puede revisar la <a href="<?php echo e(url('cuenta/carteraPagos/'.$cuenta)); ?>">cartera de pago</a></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj11')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('msj11')); ?></b>  </h4>
    </div>
    <?php endif; ?>
  
    <?php if(Session::has('error1')): ?>
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b><?php echo e(Session::get('error1')); ?></b>  </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('cmp1')): ?>
    <div class="alert  fade in" style="background:  #ffe57f;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>  <b>Advertencia: componente -- <?php echo e(Session::get('cmp1')); ?> --. Verifique la cuenta anterior o -- Cancele Con Refinancimiento -- los pagos de forma manual.</b> </h4>
    </div>
    <?php endif; ?>

</div>

    <!-- Fin Notificación -->


  <div class="container">
    <div class="row text-center">
        <div class="col-md-12" style="margin-top: 0px;">
            <div class="pricing-table">
                <div class="panel panel-primary" style="border: none;">
                    <div class="controle-header panel-heading panel-heading-landing">
                        <h1 class="panel-title panel-title-landing">
                          
                        </h1>
                    </div>
                    <div class="controle-panel-heading panel-heading panel-heading-landing-box">
                           Intentelo Nuevamente
                    </div>
                    
                    <div class="panel-footer panel-footer-landing">
                            <?php if(Session::has('bandera')): ?>
                        <a href="<?php echo e(URL::action('TipoCreditoController@create')); ?>"  class="btn btn-price btn-danger btn-lg">Nuevo Credito Completo</a>
                        <?php endif; ?>
                        <?php if(Session::has('ban')): ?>
                        <a href="<?php echo e(URL::action('RefinanciamientoController@create')); ?>"  class="btn btn-price btn-danger btn-lg">Nuevo Refinanciamiento</a>
                        <?php endif; ?>
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