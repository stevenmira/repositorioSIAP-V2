<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cliente->idcuenta)); ?>"> Cuenta</a></li>
    <li class="active">Estado de Cuentas</li>
  </ol>
</section>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>GESTIÓN DE ESTADOS DE CUENTAS</b></h4>

<br><br>
<div class="container">
  <table>
    <thead>
      <tr>
        <td style="width: 10%; font-weight: bold;">CLIENTE:</td>
        <td style="width: 25%;"><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></td>
        <td style="width: 10%; font-weight: bold;">NEGOCIO:</td>
        <td style="width: 25%;"><?php echo e($cliente->nombreNegocio); ?></td>
        <td style="width: 7%; font-weight: bold;">CARTERA:</td>
        <td style="width: 18%; font-weight: bold;">"<?php echo e($cliente->nombreCartera); ?>"</td>
        <td style="width: 5%;">
          <a href="<?php echo e(URL::action('ClienteController@show',$cliente->idcliente)); ?>">Ver Perfil</a>
        </td>
      </tr>
    </thead>
  </table>
</div>
<br>
  <!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> <?php echo e(Session::get('create')); ?>  </P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> <?php echo e(Session::get('update')); ?> </P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('delete')): ?>
    <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> El estado de cuenta -- <?php echo e(Session::get('delete')); ?> --  se ha eliminado correctamente</p>
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
                      <th>Tipo</th>
                      <th>Fecha Realizado</th>
                      <th>Dias Atrasados</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                      <th>Imprimir</th>
                  </tr>
              </thead>
             <?php foreach($estados as $es): ?>     
                <tr>
                    <td><?php echo e($es->estado); ?></td>
                    <?php $fechacomprobante = \Carbon\Carbon::parse($es->fechacomprobante)->format('d-m-Y'); ?>
                    <td><?php echo e($fechacomprobante); ?></td>
                    <?php if($es->estado == 'NORMAL'): ?>
                      <td><?php echo e($es->diasatrasados); ?></td>
                    <?php else: ?>
                      <?php $subtotax = round($es->diaspendientes + $es->cuotadeuda + 1, 2); ?>
                      <td><?php echo e($subtotax); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($es->total); ?></td>
                    <td>
                      <a title="Editar pago" data-target="#modalEstado-delete-<?php echo e($es->idcomprobante); ?>" data-toggle="modal" style="cursor: pointer; color: black;">
                        <span> <?php echo e($es->estadodos); ?> <i class="fa fa-info-circle"></i></span> 
                      </a>
                      <?php echo $__env->make('estadoCuenta.modalEstado', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </td>
                    <td style="width: 200px;">

                        <a class="btn btn-warning amarillo" data-title="Consultar datos" href="<?php echo e(URL::action('ComprobanteController@mostrar',$es->idcomprobante)); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a class="btn btn-info azul" data-title="Editar datos" href="<?php echo e(URL::action('ComprobanteController@edit',$es->idcomprobante)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-danger rojo" data-title="Eliminar" href="" data-target="#modal-delete-<?php echo e($es->idcomprobante); ?>" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>

                    </td>
                    <td>
                      <a class="btn btn-danger rojo" data-title="Imprimir" href="<?php echo e(URL::action('ComprobanteController@estadoPDF',$es->idcomprobante)); ?>" data-toggle="modal" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php echo $__env->make('estadoCuenta.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; ?>
            </table>
        </div>
        <?php echo e($estados->render()); ?>

    </div>
</div>

<div class="row">
  <a href="<?php echo e(URL::action('CuentaController@show',$cliente->idcuenta)); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      <?php echo e($fecha_actual); ?>

    </h4>
  </div>
</div>



</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>