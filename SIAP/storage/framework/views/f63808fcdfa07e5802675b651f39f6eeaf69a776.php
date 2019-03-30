<?php $__env->startSection('contenido'); ?>
<style type="text/css">
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
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
    <li><a href="<?php echo e(url('cliente/creditos', ['id' => $cliente->idcliente ])); ?>"> Créditos </a></li>
    <li><a href="<?php echo e(url('cliente/credito/garantias', ['id' => $idprestamo])); ?>"> Garantías </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>GESTIÓN DE GARANTÍAS</b></h4>

<div class="row" align="center" style="font-size: 14px; ">
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p><?php echo e($prestamo->estado); ?></p>
      <p>  <?php echo e($prestamo->fecha->format('d-m-Y')); ?>, Monto: $ <?php echo e($prestamo->monto); ?>, Cuota: $ <?php echo e($prestamo->cuotadiaria); ?> </p>
    </div>
  </aside>
  <?php if($negocio != null): ?>
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Negocio</p>
      <p>  <?php echo e($negocio->nombre); ?></p>
    </div>
  </aside>
  <?php endif; ?>
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Deudor</p>
      <p>  <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></p>
    </div>
  </aside>
  
  <?php if($codeudor != null): ?>
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Codeudor</p>
      <p>  <?php echo e($codeudor->nombre); ?> <?php echo e($codeudor->apellido); ?></p>
    </div>
  </aside>
  <?php else: ?>
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Codeudor</p>
      <p>El crédito no tiene codeudor asociado</p>
    </div>
  </aside>
  <?php endif; ?>
</div>

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>Garantía del -- <?php echo e(Session::get('create')); ?> -- se ha guardado correctamente</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>   <b><?php echo e(Session::get('error')); ?></b>  </P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> Garantía del  -- <?php echo e(Session::get('update')); ?> -- se ha actualizado correctamente</P>
  </div>
  <?php endif; ?>

  <?php if(Session::has('delete')): ?>
    <div class="alert  fade in" style="background:  #f0f4c3;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p> La garantía del -- <?php echo e(Session::get('delete')); ?> --  se ha eliminado correctamente</p>
    </div>
  <?php endif; ?>

</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive" style="padding: 5px 5px;">
      <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
              <tr class="">
                <th colspan="12">
                    <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE GARANTÍAS
                      <a class="btn btn-success pull-right verde" data-title="Agregar Garantía" href="<?php echo e(url('cliente/credito/garantias/nuevo', ['idprestamo' => $idprestamo])); ?>"><i class="fa fa-fw -square -circle fa-plus-square"></i></a> 
                    </h4>
                </th>
            </tr> 
              <tr class="">
                <th style="width: 30px;">No.</th>
                <th style="width: 75px;">Garante</th>
                <th style="width: 110px;">Marca</th>
                <th style="width: 110px;">Serie</th>
                <th style="width: 80px;">Valor</th>
                <th>Descripción</th>
                <th>Otras Especificaciones</th>
                <th style="width: 100px;">Acciones</th>
              </tr>
          </thead>
          <?php $cont = 1; ?> 
           <?php foreach($garantias as $ma): ?>
              <tr>
                  <td><?php echo e($cont); ?></td>
                  <td><?php echo e($ma->tipogarante); ?></td>
                  <td><?php echo e($ma->marca); ?></td>
                  <td><?php echo e($ma->serie); ?></td>
                  <td><?php echo e($ma->valor); ?></td>
                  <td><?php echo e($ma->descripcion); ?></td>
                  <td><?php echo e($ma->otros); ?></td>
                  <td>
                    <a class="btn btn-info azul" data-title="Editar Garantía" href="<?php echo e(URL::action('GarantiaController@edit',$ma->idgarantia)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                    <a class="btn btn-danger rojo" data-title="Eliminar Garantía" href="" data-target="#modal-delete-<?php echo e($ma->idgarantia); ?>" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
              </tr>
              <?php echo $__env->make('garantia.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php $cont = $cont + 1; ?>
          <?php endforeach; ?>
      </table>
    </div>
    <?php echo e($garantias->render()); ?>

  </div>
</div>


<div class="row">
  <a href="<?php echo e(URL::action('ClienteController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      <?php echo e($fecha_actual); ?></h4>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>