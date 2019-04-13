<?php $__env->startSection('contenido'); ?>
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
</style>

<section class="content-header">
  <ol class="breadcrumb">
   <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio </a></li>
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"> Cliente </a></li>
    <li><a href="<?php echo e(url('comentarios/list', ['id' => $cliente->idcliente ])); ?>"> Comentario </a></li>
    <li class="active">Editar</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>EDITAR COMENTARIO</b></h4>


<div class="container">
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 13px 0px 13px;"> <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></i></span> </p>
</div>

<?php echo Form::model($observacion, ['method'=>'PATCH','route'=>['comentario.update',$observacion->idobservacion]]); ?>

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
      

      <div class="row"> 

        <div class="form-group col-md-4">
          <label for="nombreNegocio">Fecha</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <?php echo Form::date('fecha', $observacion->fecha, ['class' => 'form-control' , 'required' => 'required']); ?>

          </div>
        </div>

        <div class="form-group col-md-7">
          <label for="actividadEconomica">Responsable</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
           <?php echo Form::text('responsable', $observacion->responsable, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el responsable . . .', 'autofocus'=>'on', 'maxlength'=>'100']); ?>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-11">
          <label for="comentario">Comentario</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::textarea('comentario', $observacion->comentario, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el Comentario . . .', 'autofocus'=>'on', 'rows'=>'5', 'maxlength'=>'1024']); ?>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
          <div class="form-group">
          <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
              <a href="<?php echo e(url('comentarios/list', ['id' => $cliente->idcliente ])); ?>" class="btn btn-danger btn-lg col-md-offset-2">Cancelar</a>
              <button class="btn btn-primary btn-lg col-md-offset-6" type="submit">Actualizar</button>
            </div>
        </div>
      </div>
  </div>
</div>

  <input type="hidden" name="idcliente" value="<?php echo e($cliente->idcliente); ?>">

<?php echo Form::close(); ?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;"><?php echo e($fecha_actual); ?></h4>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>