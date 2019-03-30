<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('CategoriaController@index')); ?>"><i class="fa fa-dashboard"></i> Categoria</a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>GESTIÓN DE CATEGORIAS</b></h4>

<!-- Criterios de búsquedas -->

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

  <?php if(Session::has('create')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P>La Categoria -- <?php echo e(Session::get('create')); ?> -- se ha guardado correctamente</P>
  </div>
  <?php endif; ?>


  <?php if(Session::has('update')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> La Categoria  -- <?php echo e(Session::get('update')); ?> -- se ha actualizado correctamente</P>
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
                              
                              <h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">LISTADO DE CATEGORIAS<a class="btn btn-success pull-right verde" data-title="Agregar Nuevo Ejecutivo" href="<?php echo e(URL::action('CategoriaController@create')); ?>"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></h4>
                          </th>
                      </tr>
                        <tr class="info">
                            <th style="width: 75px; text-align: center;">Letra</th>
                            <th>Calificacion</th>
                            <th>Descripcion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                   <?php foreach($categorias as $ma): ?>
                      <tr>
                          <td><?php echo e($ma->letra); ?></td>
                          <td><?php echo e($ma->calificacion); ?></td>
                          <td><?php echo e($ma->descripcion); ?></td>
                          <td style="width: 230px;">

                              <?php if($ma->letra != 'E'): ?>

                              <a class="btn btn-info azul" data-title="Editar Datos de la Categoria" href="<?php echo e(URL::action('CategoriaController@edit',$ma->idcategoria)); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <?php endif; ?>
                          </td>
                      </tr>
                  <?php endforeach; ?>
                </table>
            </div>
            <?php echo e($categorias->render()); ?>

        </div>
</div>

<div align="center">
  <div style="padding: 0px 25 px 0px 25px" align="left">
    <br>
    <div class="smallfont" align="center">
      <strong></strong>
   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">   
  <a href="<?php echo e(URL::action('CategoriaController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás </a> 
  </div>
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