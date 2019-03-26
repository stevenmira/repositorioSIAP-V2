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
    <li><a href="<?php echo e(URL::action('TasaInteresController@index')); ?>"> Tasa de Interés</a></li>
    <li class="active">Editar</li>
  </ol>
</section>


<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>


<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 50px 0px 5px 0px;"><b>EDITAR TASAS DE INTERES</b></h4>


  <?php if(Session::has('msj1')): ?>
  <div class="alert  fade in" style="background:  #ff8a80;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>   <b><?php echo e(Session::get('msj1')); ?></b>  </h4>
  </div>
  <?php endif; ?>

<?php echo Form::model($interes,['method'=>'PATCH','route'=>['tasa-interes.update',$interes->idtipocredito]]); ?>

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

            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
              <label for="nombre">Tipo Crédito</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('nombre', $interes->nombre, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Normal, Prefencial, Oro, Otros  . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2">
              <label for="interes">Interés (%)</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-percent" aria-hidden="true"><b>%</b></i>
                </div>
                <?php echo Form::number('interes', $interes->interes*100, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'En Porcentaje', 'step'=>'0.01']); ?>

              </div>
            </div>

          </div>

          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
              <label for="condicion">Condición</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('condicion', $interes->condicion, ['class' => 'form-control', 'placeholder'=>'Mayor, Menor, Igual . . .', 'maxlength'=>'90']); ?>

              </div>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2">
              <label for="monto">Monto</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-dollar" aria-hidden="true"></i>
                </div>
                <?php echo Form::number('monto', $interes->monto, ['class' => 'form-control' , 'placeholder'=>'Monto . . .', 'step'=>'0.01']); ?>

              </div>
            </div>
          </div>

          <br>
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
              <div class="form-group">
              <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
                  <a href="<?php echo e(URL::action('TasaInteresController@index')); ?>" class="btn btn-danger btn-lg col-lg-offset-3 col-md-offset-3 col-sm-offset-3"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
                  <button class="btn btn-primary btn-lg col-lg-offset-3 col-md-offset-3 col-sm-offset-3" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Actualizar</button>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;"><?php echo e($fecha_actual); ?></h4>
            </div>
          </div>
    </div>
  </div>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>