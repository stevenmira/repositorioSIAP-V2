<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Usuario</li>
  </ol>
</section>

<br><br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE USUARIOS</b></h4>

<section class="content">

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
  
  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El Usuario ha sido guardado correctamente.</h4>
  </div>
  <?php endif; ?>

  <?php if(Session::has('unicidad')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> No se pudo actualizar, el cliente con el número de DUI  <b><?php echo e(Session::get('unicidad')); ?></b>  ya está en uso.</h4>
  </div>
  <?php endif; ?>

  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b><?php echo e(Session::get('update')); ?></b>.</h4>
  </div>
  <?php endif; ?>
  <?php if(Session::has('delete')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El Usuario se elimino correctamente</h4>
  </div>
  <?php endif; ?>

  <?php if(Session::has('activo')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El cliente  <b><?php echo e(Session::get('activo')); ?></b>  fué dado de baja exitosamente.</h4>
  </div>
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>   <b><?php echo e(Session::get('error')); ?></b>  </h4>
  </div>
  <?php endif; ?>
  <!-- Fin Notificación -->
  </div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              
                              <h3 style="text-align: center;"><b>Listado de Usuarios</b><a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Usuario" href="<?php echo e(URL::action('UsuarioController@create')); ?>"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h3>
                              
                          </th>
                      </tr>
                        <tr class="info">
                            <th>Nombre </th>
                            <th>Nombre de usuario</th>
                            <th>Rol de usuario</th>
                            <th>E-mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                   <?php foreach($usuarios as $us): ?>
                     
                      <tr>
                          <td><?php echo e($us->nombre); ?></td>
                          <td><?php echo e($us->name); ?></td>
                          <td><?= $us->tipo($us->idtipousuario);   ?></td>
                          <td><?php echo e($us->email); ?></td>
                          <td style="width: 200px;">
                              <a class="btn btn-info azul" data-title="Editar Datos del Usuario" href="<?php echo e(URL::action('UsuarioController@edit',$us->idusuario)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              <a class="btn btn-danger rojo" data-title="Eliminar Usuario" href="" data-target="#modal-delete-<?php echo e($us->idusuario); ?>" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                      <?php echo $__env->make('usuario.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php endforeach; ?>
                </table>
            </div>
            <?php echo e($usuarios->render()); ?>

        </div>
    </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="float: left;">
      <p style="text-align:center;"><b><?php echo e($usuarioactual->nombre); ?></b></p>
      <p style="text-align:center;"><?= $usuarioactual->tipo($usuarioactual->idtipousuario); ?></p>
  </div>

 
</div>

</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>