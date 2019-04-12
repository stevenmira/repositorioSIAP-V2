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
    <li><a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>"> Estados de Cuentas</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>
<br>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>NUEVO ESTADO DE CUENTA</b></h4>
<br><br>
<div class="container">
  <table>
    <thead>
      <tr>
        <td style="width: 10%; font-weight: bold;">CLIENTE:</td>
        <td style="width: 25%;"><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></td>
        <td style="width: 10%; font-weight: bold;">NEGOCIO:</td>
        <td style="width: 25%;"><?php echo e($cliente->nombreNegocio); ?></td>
        <td style="width: 7%; font-weight: bold;">CARTERA:</td>
        <td style="width: 18%; font-weight: bold;">"<?php echo e($cliente->nombreCartera); ?>"</td>
        <td style="width: 5%;">
          <a href="<?php echo e(URL::action('ClienteController@show',$cliente->idcliente)); ?>">Ver Perfil</a>
        </td>
      </tr>
    </thead>
  </table>
</div>

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



  <?php echo Form::open(array('action' => array('ComprobanteController@agregarestado',$cliente->idcuenta), 'method'=>'POST','autocomplete'=>'off')); ?>

  <div style="padding: 0px 40px;">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
      <div class="panel panel-success"> 
        <div class="panel-heading">
          <h3 class="panel-title">DETALLE DE LA DEUDA</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 col-sm-12  col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <thead>
                  <th>No.</th>
                  <th>FECHAS</th>
                  <th>DÍAS</th>
                  <th>MONTOS</th>                
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Fecha</td>
                    <td></td>
                    <td>
                      <?php echo Form::date('fechaactual', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required','autofocus'=>'on']); ?>

                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      Saldo pendiente de cuota: 
                    </td>                      
                    <td>
                        <?php echo Form::number('diaspendiente',$diaspendx, ['id'=>'diaspendx','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'1']); ?>

                    </td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                        <?php echo Form::number('totalpendiente',$totalpendx, ['id'=>'totalpendx','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'0.01']); ?>

                    </td>
                  </tr>

                  <tr>
                    <td>5</td>
                    <td>Gastos de Administración por gestion de cobros:</td>
                    <td></td>
                    <td><?php echo Form::number('gastosadmon', null, ['id'=>'gastosadmon','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca los gastos administrativos. . .', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Gastos Administrativos por Notificación:</td>
                    <td></td>
                    <td><?php echo Form::number('gastosnoti', null, ['id'=>'gastosnoti','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Notificación. . .', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><b style="color:red">TOTAL A CANCELAR</b></td>
                    <td></td>
                    <td><b><?php echo Form::number('total', null, [ 'id'=>'total','class' => 'form-control' , 'disabled' => 'disabled', 'autofocus'=>'on', 'maxlength'=>'6']); ?></b></td>
                   
                  </tr>
                </tbody>
              </table>
              <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
              <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button class="btn btn-primary btn-lg pull-right" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>

<!--Script para sumar el total del monto a pagar-->
<script>
function Sumar(){
 total=parseFloat(document.getElementById("monto").innerHTML);
 numero1 = parseFloat(document.getElementById("monto").innerHTML);
 numero2 = parseFloat(document.getElementById("gastosadmon").value);
 numero4 = parseFloat(document.getElementById("gastosnoti").value);


if((isNaN(numero2)) && (isNaN(numero4))){
  total=numero1;
}else if(isNaN(numero2)){
    total+=numero4;
}else if(isNaN( numero4)){
  total+=numero2;
}
else {
   total=numero1 + numero2 + numero4;
}
document.getElementById("total").value = total.toFixed(2);
}
</script>



<?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>