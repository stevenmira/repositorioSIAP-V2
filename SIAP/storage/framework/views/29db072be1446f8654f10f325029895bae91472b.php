<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('EmpleadoController@indexPersonal')); ?>"><i class="fa fa-dashboard"></i> Personal</a></li>
    <li><a href="<?php echo e(URL::action('SupervisorController@index')); ?>"> Ejecutivos </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>LISTA DE SUPERVISORES INACTIVOS</b></h4>

<section class="content">

  <?php if(Session::has('inactivo')): ?>
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El Supervisor <b><?php echo e(Session::get('inactivo')); ?></b>  ha sido modificado al estado <b> ACTIVO </b>  nuevamente. </h4>
  </div>
  <?php endif; ?>

<section class="content">

   <!-- Notificación -->
   <?php if(Session::has('inactivo')): ?>
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El Supervisor <b><?php echo e(Session::get('inactivo')); ?></b>  ha sido modificado al estado <b> ACTIVO </b>  nuevamente. </h4>
  </div>
  <?php endif; ?>

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <div>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      </div>
      <?php echo $__env->make('personal.supervisor.inactivo.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>


<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center; font-family:  Times New Roman, sans-serif; color: #1C2331;"><b>LISTADO DE SUPERVISORES</b> <b style="color: red;">INACTIVOS</b></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th style="width: 30px;">No.</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>DUI</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                  <?php $cont = 1; ?> 
                   <?php foreach($supervisores as $ma): ?>
                      <tr>
                          <td><?php echo e($cont); ?></td>
                          <td><?php echo e($ma->nombre); ?></td>
                          <td><?php echo e($ma->apellido); ?></td>
                          <td><?php echo e($ma->telefono); ?></td>
                          <td><?php echo e($ma->dui); ?></td>
                          <td style="width: 230px;">

                              <a class="btn btn-primary azul" data-title="Habilitar Supervisor" href="" data-target="#modal-delete-<?php echo e($ma->idsupervisor); ?>" data-toggle="modal"><i class="fa fa-check" aria-hidden="true"></i></a>


                          </td>
                      </tr>
                      <?php echo $__env->make('personal.supervisor.inactivo.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endforeach; ?>
                </table>
            </div>
            <?php echo e($supervisores->render()); ?>

        </div>
    </div>

<div class="row">
  <a href="<?php echo e(URL::action('SupervisorController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b><?php echo e($fecha_actual); ?></b></h3>
  </div>
</div>

</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>