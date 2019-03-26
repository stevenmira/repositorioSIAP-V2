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
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"> Cliente </a></li>
    <li><a href="<?php echo e(url('cliente/creditos', ['id' => $cliente->idcliente ])); ?>"> Créditos </a></li>
    <li><a href="<?php echo e(url('cliente/credito/garantias', ['id' => $idprestamo])); ?>"> Garantías </a></li>
    <li class="active"> Nuevo </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVA GARANTÍA</b></h4>

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

<?php echo Form::open(array('url'=>'garantia','method'=>'POST','autocomplete'=>'off', 'onsubmit'=> 'return checkSubmit();')); ?>

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
        <div class="form-group col-md-2">
          <label>Garante</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <select class="form-control" name="tipogarante" autofocus="on">
              <option value="Deudor"> Deudor</option>
              <?php if($codeudor != null): ?>
              <option value="Codeudor"> Codeudor</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label>Marca</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::text('marca', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la marca . . .', 'maxlength'=>'50']); ?>

          </div>
        </div>
        <div class="form-group col-md-4">
          <label>Serie</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::text('serie', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la serie . . .', 'maxlength'=>'50']); ?>

          </div>
        </div>
        <div class="form-group col-md-2">
          <label>Valor</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::number('valor', null, ['class' => 'form-control', 'step'=>'0.01', 'placeholder'=>'Digite el valor estimado . . .']); ?>

          </div>
        </div>
      </div>
      
      <div class="row"> 
        <div class="form-group col-md-6">
          <label>Descripción</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::textarea('descripcion', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Describa la garantia . . .', 'rows'=>'3']); ?>

          </div>
        </div>
        <div class="form-group col-md-6">
          <label>Otras especificaciones</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <?php echo Form::textarea('otros', null, ['class' => 'form-control', 'placeholder'=>'Describa las especificaciones . . .', 'rows'=>'3']); ?>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
          <div class="form-group">
          <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
              <a href="<?php echo e(url('cliente/credito/garantias', ['id' => $idprestamo])); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button id="btsubmit" class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
        </div>
      </div>
  </div>
</div>


<input type="hidden" name="idprestamo" value="<?php echo e($idprestamo); ?>">

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