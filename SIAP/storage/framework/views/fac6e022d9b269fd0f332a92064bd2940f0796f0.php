<?php $__env->startSection('contenido'); ?>
<style type="text/css">
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
</style>
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
    <li class="active"> Créditos </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>SELECCIONE UN CRÉDITO</b></h4>


<div class="row">
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 0px 0px 25px;">  <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></i></span> </p>
</div>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 5px 5px;">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr class="success">
                          <th colspan="12">
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CRÉDITOS</h4>
                          </th>
                      </tr>
                        <tr class="info">
                        	<th style="width: 30px;">No.</th>
                            <th>Fecha</th>
                            <th>Tipo Crédito</th>
                            <th>Negocio</th>
                            <th>Monto</th>
                            <th>Tasa de Interés</th>
                            <th>Cuota</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                   <?php $cont = 1; ?> 
                   <?php foreach($cuentas as $ma): ?>
                      <tr>
                      	  <td><?php echo e($cont); ?></td>
                          <td><?php echo e($ma->fecha); ?></td>
                          <td><?php echo e($ma->estadoPrestamo); ?></td>
                          <td><?php echo e($ma->nombreNegocio); ?></td>
                          <td>$ <?php echo e($ma->monto); ?></td>
                          <?php $tasa = $ma->interes * 100; ?> 
                          <td><?php echo e($tasa); ?> %</td>
                          <td>$ <?php echo e($ma->cuotadiaria); ?></td>
                          <td style="width: 150px;">
                            <a class="btn btn-warning amarillo"  data-title="Ver Garantias" href="<?php echo e(url('cliente/credito/garantias', ['id' => $ma->idprestamo])); ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                          </td>
                      </tr>
                  <?php $cont = $cont + 1; ?>
                  <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php if($cuentas == null): ?>
      <p style="text-align: center;">No hay créditos para este cliente</p>
    <?php endif; ?>
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