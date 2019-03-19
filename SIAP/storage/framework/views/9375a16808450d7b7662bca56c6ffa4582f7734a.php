<?php $__env->startSection('contenido'); ?>
<style type="text/css">
  .circuloCSS{
  width: 31px;
  height: 31px;
  text-align: center;
  padding: 6px 0;
  font-size: 13px;
  line-height: 1.43;
  border-radius: 16px;
}
</style>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"> Cliente </a></li>
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"> Activos </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE CLIENTES</b></h4>

<!-- Criterios de búsquedas -->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <?php echo $__env->make('cliente.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>El cliente -- <?php echo e(Session::get('create')); ?> -- se ha guardado correctamente</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('unicidad')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> No se pudo actualizar, el cliente con el número de DUI -- <?php echo e(Session::get('unicidad')); ?> --  ya está en uso.</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El cliente  -- <?php echo e(Session::get('update')); ?> -- se ha actualizado correctamente</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('activo')): ?>
  <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> El cliente  -- <?php echo e(Session::get('activo')); ?> --  se ha dado de baja correctamente</P>
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
                              
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CLIENTES ACTIVOS<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Cliente" href="<?php echo e(URL::action('ClienteController@create')); ?>"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th style="width: 120px;">Cartera</th>
                            <th style="width: 120px;">Nombres</th>
                            <th style="width: 120px;">Apellidos</th>
                            <th style="width: 80px;">DUI</th>
                            <th style="width: 75px; text-align: center;">Negocios</th>
                            <th style="width: 75px; text-align: center;">Comentarios</th>
                            <th style="width: 75px; text-align: center;">Codeudores</th>
                            <th style="width: 75px; text-align: center;">Garantias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   <?php foreach($clientes as $ma): ?>
                      <tr>
                          <td><?php echo e($ma->nombreCartera); ?></td>
                          <td><?php echo e($ma->nombre); ?></td>
                          <td><?php echo e($ma->apellido); ?></td>
                          <td><?php echo e($ma->dui); ?></td>
                          <td>
                            <a class="dark" data-title="Ver lista de negocios" href="<?php echo e(url('negocios/list', ['id' => $ma->idcliente ])); ?>"><button style="background: #263238; color: #fff;" class=" btn btn-default center-block circuloCSS"><i class="fa fa-briefcase"></i></button>
                            </a> 
                          </td>
                          <td>
                            <a class="dark" data-title="Ver lista de comentarios" href="<?php echo e(url('comentarios/list', ['id' => $ma->idcliente ])); ?>"><button style="background: #263238; color: #fff;" class=" btn btn-default center-block circuloCSS"><i class="fa fa-sticky-note"></i></button>
                            </a> 
                          </td>
                          <td>
                            <a class="dark" data-title="Ver lista de codeudores" href="<?php echo e(url('codeudores/list', ['id' => $ma->idcliente ])); ?>"><button style="background: #263238; color: #fff;" class=" btn btn-default center-block circuloCSS"><i class="fa fa-users"></i></button>
                            </a> 
                          </td>
                          <td>
                            <a class="dark" data-title="Ver Garantias" href="<?php echo e(url('cliente/creditos', ['id' => $ma->idcliente ])); ?>"><button style="background: #263238; color: #fff;" class=" btn btn-default center-block circuloCSS"><i class="fa fa-users"></i></button>
                            </a> 
                          </td>
                          <td style="width: 230px;">
                              <a class="btn btn-warning amarillo"  data-title="Ver Datos del Cliente" href="<?php echo e(URL::action('ClienteController@show',$ma->idcliente)); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                              <a class="btn btn-info azul" data-title="Editar Datos del Cliente" href="<?php echo e(URL::action('ClienteController@edit',$ma->idcliente)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                              <a class="btn btn-danger rojo" data-title="Inhabilitar Cliente" href="" data-target="#modal-delete-<?php echo e($ma->idcliente); ?>" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      <?php echo $__env->make('cliente.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endforeach; ?>
                </table>
            </div>
            <?php echo e($clientes->render()); ?>

        </div>
</div>

<div class="row">
  <a href="<?php echo e(URL::action('ClienteController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      <?php echo e($fecha_actual); ?></h4>
  </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>