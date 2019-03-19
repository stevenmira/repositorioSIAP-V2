<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('EmpleadoController@indexPersonal')); ?>"><i class="fa fa-dashboard"></i> Personal</a></li>
    <li><a href="<?php echo e(URL::action('SupervisorController@index')); ?>"> Supervisor </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE SUPERVISORES</b></h4>

<!-- Criterios de búsquedas -->
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php echo $__env->make('personal.supervisor.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>El ejecutivo -- <?php echo e(Session::get('create')); ?> -- se ha guardado correctamente</P>
  </div>
  <?php endif; ?>


  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El supervisor  -- <?php echo e(Session::get('update')); ?> -- se ha actualizado correctamente</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('activo')): ?>
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El supervisor  -- <?php echo e(Session::get('activo')); ?> --  se ha dado de baja correctamente</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>   <b><?php echo e(Session::get('error')); ?></b>  </P>
  </div>
  <?php endif; ?>
 
</div>
 <!-- Fin Notificación -->
  

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE SUPERVISORES<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Supervisor" href="<?php echo e(URL::action('SupervisorController@create')); ?>"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
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
                              <a class="btn btn-warning amarillo"  data-title="Ver Datos del Supervisor" href="<?php echo e(URL::action('SupervisorController@show',$ma->idsupervisor)); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                              <a class="btn btn-info azul" data-title="Editar Datos del Supervisor" href="<?php echo e(URL::action('SupervisorController@edit',$ma->idsupervisor)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Inhabilitar Supervisor" href="" data-target="#modal-delete-<?php echo e($ma->idsupervisor); ?>" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      <?php echo $__env->make('personal.supervisor.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                      <?php $cont = $cont + 1; ?>
                  <?php endforeach; ?>
                </table>
            </div>
            <?php echo e($supervisores->render()); ?>

        </div>
</div>

<div align="center">
  <div style="padding: 0px 25 px 0px 25px" align="left">
    <br>
    <div class="smallfont" align="center">
      <strong></strong>
   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">   
  <a href="<?php echo e(URL::action('EmpleadoController@indexPersonal')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás </a> 
  </div>

  <a href="<?php echo e(URL::action('SupervisorController@inactivos')); ?>" class="btn btn-info btn-lg col-md-offset-2">Supervisores Inactivos <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
  <strong></strong>
    </div>
    </br>
  </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      <?php echo e($fecha_actual); ?></h4>
  </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>