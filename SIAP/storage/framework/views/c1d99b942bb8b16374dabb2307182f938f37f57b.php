<?php $__env->startSection('contenido'); ?>
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('CarteraController@index')); ?>"> Carteras</a></li>
    <li class="active">Editar</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 50px 0px 25px 0px;"><b>EDITAR CARTERA</b></h4>

<?php echo Form::model($cartera,['method'=>'PATCH','route'=>['carteras.update',$cartera->idcartera]]); ?>

<?php echo e(Form::token()); ?>


<div class="container">
  <div class="col-lg-12 col-md-12 col-sm-12"> 

    <div class="row">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if(count($errors) > 0): ?>
        <div class="errors">
          <ul>
            <p><b>Por favor, corrige lo siguiente:</b></p>
            <?php $cont = 1; ?>
          <?php foreach($errors->all() as $error): ?>
            <li><?php echo e($cont); ?>. <?php echo e($error); ?></li>
            <?php $cont=$cont+1; ?>
          <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      </div>
    </div>

    <div class="form-group col-md-4">
      <label for="nombre">Nombre</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </div>
        <?php echo Form::text('nombre', $cartera->nombre, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'50']); ?>

      </div>
    </div>

    <div class="form-group col-md-4">
      <label for="cartera">Ejecutivo</label>
      <select name="idejecutivo" class="form-control">
        <?php foreach($ejecutivos as $ejecutivo): ?>
          <?php if($ejecutivo->idejecutivo == $cartera->idejecutivo): ?>
          <option value="<?php echo e($ejecutivo->idejecutivo); ?>" selected><?php echo e($ejecutivo->nombre); ?> <?php echo e($ejecutivo->apellido); ?></option>
          <?php else: ?>
          <option value="<?php echo e($ejecutivo->idejecutivo); ?>"><?php echo e($ejecutivo->nombre); ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="cartera">Supervisor</label>
      <select name="idsupervisor" class="form-control">
        <?php foreach($supervisores as $supervisor): ?>
          <?php if($supervisor->idsupervisor == $cartera->idsupervisor): ?>
          <option value="<?php echo e($supervisor->idsupervisor); ?>" selected><?php echo e($supervisor->nombre); ?> <?php echo e($supervisor->apellido); ?></option>
          <?php else: ?>
          <option value="<?php echo e($supervisor->idsupervisor); ?>"><?php echo e($supervisor->nombre); ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select>
    </div>

      <div style="padding: 100px 0px 0px 0px;" class="row">
        <div class="form-group">
          <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
          <a href="<?php echo e(URL::action('CarteraController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
          <button class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Guardar</button>
        </div>
      </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;"><?php echo e($fecha_actual); ?></h4>
    </div>

  </div>
</div>  

<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>