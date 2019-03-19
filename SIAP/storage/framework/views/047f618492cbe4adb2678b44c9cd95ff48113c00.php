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
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"> Cliente</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVO CLIENTE</b></h4>

<?php echo Form::open(array('url'=>'cliente','method'=>'POST','autocomplete'=>'off')); ?>

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
              <label for="cartera">Carteras</label>
              <?php echo e(Form::select('idcartera', $carteras->pluck('nombre','idcartera'), null, ['class'=>'form-control', 'placeholder'=>'-- Selecciona la Cartera --'])); ?>

            </div>

            <div class="form-group col-md-4">
              <label for="nombre">Nombres del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="apellido">Apellidos del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('apellido', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el apellido . . .', 'autofocus'=>'on', 'maxlength'=>'30']); ?>

              </div>
            </div>
            
          </div>

          <div class="row"> 

            <div class="form-group col-md-4">
              <label for="dui">DUI</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('dui', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el DUI . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "99999999-9"',  'data-mask'=>'on']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="lugar">Lugar de Expedición (DUI)</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('lugarexpedicion', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el lugar . . .', 'autofocus'=>'on', 'maxlength'=>'50']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="fecha">Fecha de Expedición (DUI)</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                <?php echo Form::date('fechaexpedicion', null, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']); ?>

              </div>
            </div>
          </div>

          <div class="row"> 
            <div class="form-group col-md-4">
              <label for="nit">NIT</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('nit', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el NIT . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-999999-999-9"',  'data-mask'=>'on']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="edad">Fecha de Nacimiento</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <?php echo Form::date('fechanacimiento', null, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="nombre">Domicilio</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('domicilio', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el domicilio . . .', 'autofocus'=>'on', 'maxlength'=>'45']); ?>

              </div>
            </div>
          </div>

          <div class="row"> 
            <div class="form-group col-md-8">
              <label for="direccionCliente">Dirección del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::textarea('direccionCliente', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca la dirección del cliente . . .', 'autofocus'=>'on', 'rows'=>'1']); ?>

              </div>
            </div>

            <div class="form-group col-md-3 col-lg-3 col-sm-3">
              <label for="cartera">Categoria</label>
              <?php echo e(Form::select('idcategoria', $categorias->pluck('letra','idcategoria'), null, ['class'=>'form-control', 'placeholder'=>'-- Selecciona la Categoria --'])); ?>

            </div>

            <div class="form-group col-md-1 col-lg-1 col-sm-1">
              <a href="" data-target="#modal-help" data-toggle="modal"><i class="fa fa-info-circle"> AYUDA</i></a>
              <?php echo $__env->make('cliente.modal2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-4">
              <label for="profesion">Profesion</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('profesion', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la profesion del cliente. . .', 'autofocus'=>'on', 'maxlength'=>'50']); ?>

              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="telefonocel">Teléfono celular</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-android" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('telefonocel', null, ['class' => 'form-control' , 'placeholder'=>'Tel. Celular  . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']); ?>

              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="telefonofijo">Teléfono fijo</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                <?php echo Form::text('telefonofijo', null, ['class' => 'form-control' ,'placeholder'=>'Tel. Fijo . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']); ?>

              </div>
            </div>
          </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
    <div class="form-group">
    <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
        <a href="<?php echo e(URL::action('ClienteController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
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