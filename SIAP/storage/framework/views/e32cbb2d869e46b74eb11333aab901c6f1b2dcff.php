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
    <li><a href="<?php echo e(url('negocios/list', ['id' => $cliente->idcliente ])); ?>"> Negocio </a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVO NEGOCIO</b></h4>


<div class="container">
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 13px 0px 13px;"> <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></i></span> </p>
</div>

<?php echo Form::open(array('url'=>'negocio','method'=>'POST','autocomplete'=>'off', 'onsubmit'=> 'return checkSubmit();')); ?>

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
          <label for="nombreNegocio">Nombre del Negocio</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::textarea('nombreNegocio', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite el nombre del negocio . . .', 'autofocus'=>'on', 'rows'=>'3']); ?>

          </div>
        </div>

        <div class="form-group col-md-4">
          <label for="actividadEconomica">Actividad Economica</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::textarea('actividadEconomica', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite la actividad economica del negocio . . . ', 'autofocus'=>'on', 'rows'=>'3']); ?>

          </div>
        </div>

        <div class="form-group col-md-4">
          <label for="direccionNegocio">Dirección del Negocio</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::textarea('direccionNegocio', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite la dirección del negocio . . .', 'autofocus'=>'on', 'rows'=>'3']); ?>

          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
          <div class="form-group">
          <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
              <a href="<?php echo e(url('negocios/list', ['id' => $cliente->idcliente ])); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button id="btsubmit" class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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

<script type="text/javascript">
  function checkSubmit() {
    $('#btsubmit').html("Enviando . . .");
    document.getElementById("btsubmit").disabled = true;
    return true;
  }
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>