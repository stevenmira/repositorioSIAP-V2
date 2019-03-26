<?php $__env->startSection('contenido'); ?>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('CarteraController@index')); ?>"> Carteras</a></li>
    <li><a href="<?php echo e(URL::action('CarteraController@inactivos')); ?>"> Inactivas</a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>CARTERAS INACTIVAS</b></h4>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <br>
      <?php echo $__env->make('carteras.inactiva.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>

  <div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
    <?php if(Session::has('inactivo')): ?>
    <div class="alert  fade in" style="background:  #f0f4c3;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p> La cartera -- <?php echo e(Session::get('inactivo')); ?> -- se ha dado de alta correctamente</p>
    </div>
    <?php endif; ?>
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive" style="padding: 4px 4px;">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <tr class="success">
              <th colspan="12">
                  <h3 style="text-align: center; font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE CARTERAS</b> <b style="color: red;">INACTIVAS</b></h3>
              </th>
            </tr>
            <tr class="info">
                <th>Nombre</th>
                <th>Ejecutivos</th>
                <th>Supervisor</th>
                <th>Opciones</th>
            </tr>
          </thead>
          <?php foreach($carteras as $cartera): ?>
            <tr>
                  <td><?php echo e($cartera->nombre); ?></td>
                  <td><?php echo e($cartera->nombreEjecutivo); ?></td>
                  <td><?php echo e($cartera->nombreSupervisor); ?></td>
                  <td>  <a class="btn btn-primary azul" data-title="Habilitar Cartera" href="" data-target="#modal-delete-<?php echo e($cartera->idcartera); ?>" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>
                    
                  </td>
                  
                </td>
            </tr>
            <?php echo $__env->make('carteras.inactiva.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endforeach; ?>
        </table>
    </div>
     <?php echo e($carteras->render()); ?>

  </div>
</div>
 
<div class="row">
  <a href="<?php echo e(url('home')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      <?php echo e($fecha_actual); ?></h4>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>