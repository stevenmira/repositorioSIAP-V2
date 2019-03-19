<?php $__env->startSection('contenido'); ?>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('EmpleadoController@index')); ?>"> Ajustes</a></li>
    <li><a href="<?php echo e(URL::action('EmpleadoController@index')); ?>"> Personal </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>


  <div class="row">
    <a class="button" style="font-size: 15px;" title="" href="">
    <span class="g.glyphicon .glyphicon-user"></span></a>
  </div>

  <div style="text-align:center">
    <img src="../img/logo.png"  width="200" height="200">
    </div>

  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="row col-sm-12">
                <div class="col-sm-4" align="center">
                  <span class="fa fa-users fa-5x"></span>
                  <h3>Ejecutivo</h3>
                  <p><a href="<?php echo e(URL::action('EjecutivoController@index')); ?>">Lista de Ejecutivos</a></p>
                </div>
                
                <div class="col-sm-4" align="center">
                  <span class="fa fa-users fa-5x"></span>
                  <h3>Supervisor</h3>
                  <p><a href="<?php echo e(URL::action('SupervisorController@index')); ?>">Lista de Supervisores</a></p>
                </div>

                <?php if($usuarioactual->idtipousuario==1): ?>
                <div class="col-sm-4" align="center">
                  <span class="fa fa-user-plus fa-5x"></span>
                  <h3>Empleados</h3>
                  <p><a href="<?php echo e(URL::action('EmpleadoController@index')); ?>">Lista de Empleados</a></p>
                </div>
                <?php endif; ?>

              </div>
          </div>
      </div>
  </div>

<div>
  <br>
</br>
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