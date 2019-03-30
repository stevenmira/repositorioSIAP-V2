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
    <li><a href="<?php echo e(URL::action('UsuarioController@index')); ?>">Usuario</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>
<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>NUEVO USUARIO</b></h4>

<?php echo Form::open(array('url'=>'usuario','method'=>'POST','autocomplete'=>'off')); ?>


        
  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
          <h4 style="color: #333333; font-family: 'Times New Roman', Times, serif;"><b>Complete los campos</b></h4>
          <hr>
         
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
              <label for="nombre">Nombre de Empleado</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="name">Nombre de Usuario</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('name', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el username . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="cartera">Rol de Usuario</label>
              <?php echo e(Form::select('idtipousuario', $tipousuario->pluck('nombre','idtipousuario'), null, ['class'=>'form-control','required' => 'required', 'placeholder'=>'-- Seleccione un Tipo de usuario --'])); ?>

            </div>
            
          </div>
          <div class="row"> 

          <div class="form-group col-md-4">
              <label for="apellido">Email</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at" aria-hidden="true"></i>
                </div>
                <?php echo Form::email('email', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el apellido . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="apellido">Contraseña</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <?php echo Form::password('password',['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca una  contraseña . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?></div>
            </div>
            <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
              <div class="form-group">
              
                  <a href="<?php echo e(URL::action('UsuarioController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                  <button class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                </div>
            </div>
          </div>
                  
          </div>
           
      </div>
    </div>
  </div>

<?php echo Form::close(); ?>


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