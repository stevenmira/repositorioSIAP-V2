<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Estado de Cuenta</li>
  </ol>
</section>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>ESTADO DE CUENTA</b></h4>

<br><br>
<div class="row">
  <p class="col-md-3 col-lg-3 col-sm-3"><b>Cliente:</b>&nbsp;&nbsp;&nbsp; <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></p>
  <p class="col-md-3 col-lg-3 col-sm-3"><b>Cartera:</b>&nbsp;&nbsp;&nbsp; <?php echo e($cliente->nombreCartera); ?></p>
</div>
  <!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> <?php echo e(Session::get('create')); ?>  </P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('unicidad')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> No se pudo actualizar,<b><?php echo e(Session::get('unicidad')); ?></b>  ya está en uso.</h4>
  </div>
  <?php endif; ?>

  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>  <b><?php echo e(Session::get('update')); ?></b></h4>
  </div>
  <?php endif; ?>
  <?php if(Session::has('delete')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>El estado de cuenta se elimino correctamente</h4>
  </div>
  <?php endif; ?>

  <?php if(Session::has('activo')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><b><?php echo e(Session::get('activo')); ?></b></h4>
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
      <div class="table-responsive" style="padding: 4px 4px;">
          <table class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                  <tr class="success">
                    <th colspan="12">
                        <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ESTADOS DE CUENTA<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Estado" href="<?php echo e(URL::action('ComprobanteController@nuevoestado',$cliente->idcuenta)); ?>"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                    </th>
                </tr>
                  <tr class="info">
                      
                      <th>Fecha Realizado</th>
                      <th>Dias Atrasados</th>
                      <th>Total</th>
                      <th>Tipo</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
             <?php foreach($estados as $es): ?>     
                <tr>
                    <td><?php echo e($es->fechacomprobante); ?></td>
                    <td><?php echo e($es->diasatrasados); ?></td>
                    <td><?php echo e($es->total); ?></td>
                    <td><?php echo e($es->estado); ?></td>
                    <td><?php echo e($es->estadodos); ?></td>
                    <td style="width: 200px;">

                        <a class="btn btn-warning amarillo" data-title="Consultar datos" href="<?php echo e(URL::action('ComprobanteController@mostrar',$es->idcomprobante)); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a class="btn btn-info azul" data-title="Editar datos" href="<?php echo e(URL::action('ComprobanteController@edit',$es->idcomprobante)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-danger rojo" data-title="Imprimir" href="<?php echo e(URL::action('ComprobanteController@estadoPDF',$es->idcomprobante)); ?>" data-toggle="modal" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <a class="btn btn-danger rojo" data-title="Eliminar" href="" data-target="#modal-delete-<?php echo e($es->idcomprobante); ?>" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    </td>
                </tr>
                <?php echo $__env->make('estadoCuenta.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; ?>
            </table>
        </div>
        <?php echo e($estados->render()); ?>

    </div>
</div>



</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>