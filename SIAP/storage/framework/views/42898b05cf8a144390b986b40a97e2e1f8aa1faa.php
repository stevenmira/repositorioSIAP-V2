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
    <li><a href="<?php echo e(URL::action('EmpleadoController@indexPersonal')); ?>"><i class="fa fa-dashboard"></i> Personal</a></li>
    <li><a href="<?php echo e(URL::action('EjecutivoController@index')); ?>"> Ejecutivo </a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVO EJECUTIVO</b></h4>

<?php echo Form::open(array('url'=>'ejecutivo','method'=>'POST','autocomplete'=>'off', 'files'=>'true')); ?>

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

            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label for="nombre">Nombre</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label for="apellido">Apellido</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('apellido', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el apellido . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label for="apellido">Fotografia</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <?php echo Form::file('fotografia', null, ['class' => 'form-control']); ?>

              </div>
            </div>
            
          </div>

          <div class="row"> 

            <div class="form-group col-md-4">
              <label for="dui">DUI</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('dui', null, ['class' => 'form-control', 'data-inputmask'=>'"mask": "99999999-9"',  'data-mask'=>'on']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="fecha">Fecha de Nacimiento</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <?php echo Form::date('fechanacimiento', null, ['class' => 'form-control']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label>Sexo</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <label><?php echo Form::radio('sexo', 0); ?> Femenino  </label>
                <label><?php echo Form::radio('sexo', 1, ['select'=>'on']); ?> Masculino </label>
              </div>
            </div>

          </div>

          <div class="row"> 

            <div class="form-group col-md-4">
              <label for="direccionCliente">Dirección</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::textarea('direccion', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la direccion . . .', 'rows'=>'1', 'maxlength'=>'255']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="telefonocel">Teléfono</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-android" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('telefono', null, ['class' => 'form-control', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="edad">Correo</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::email('correo', null, ['class' => 'form-control']); ?>

              </div>
            </div>

          </div>

          <div class="row"> 
            <div class="form-group col-md-8">
              <label>Comentario</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::textarea('comentario', null, ['class' => 'form-control', 'rows'=>'4']); ?>

              </div>
            </div>
          </div>

  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
    <div class="form-group">
    <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
        <a href="<?php echo e(URL::action('EjecutivoController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
        <button class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Guardar</button>
      </div>
  </div>
</div>

<?php echo Form::close(); ?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;"><?php echo e($fecha_actual); ?></h4>
</div>



<?php $__env->startPush('scripts'); ?>


<!-- InputMask -->
<script src="<?php echo e(asset('js/inputmask/jquery3.js')); ?>"></script>  
<script src="<?php echo e(asset('js/inputmask/input-mask.js')); ?>"></script>
<script src="<?php echo e(asset('js/inputmask/input-mask-date.js')); ?>"></script>

<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>
<?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>