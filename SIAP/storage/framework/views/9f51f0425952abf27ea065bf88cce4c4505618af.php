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
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cliente->idcuenta)); ?>"> Cuenta</a></li>
    <li><a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>"> Estados de Cuentas</a></li>
    <li class="active">Editar</li>
  </ol>
</section>
<br>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>EDITAR ESTADO DE CUENTA</b></h4>
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
<br>
<?php echo Form::open(array('action' => array('ComprobanteController@update',$estadoc->idcomprobante), 'method'=>'PATCH','autocomplete'=>'off')); ?>

          
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
                <tbody>
                  <tr>
                    <td>FECHA:</td>
                    <td>
                      <?php echo Form::date('fechaactual', $estadoc->fechacomprobante, ['class' => 'form-control', 'required' => 'required','autofocus'=>'on']); ?>

                    </td>
                  </tr>
                  <tr>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      CUOTAS ATRASADAS DE <b>$ <span id="cuota"><?php echo e($cliente->cuotadiaria); ?></span> </b>
                    </td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <b>
                          <?php echo Form::number('cuotasatrasadas',$estadoc->diasatrasados, ['id'=>'cuotasatrasadas','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'1']); ?>

                        </b>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <b>
                          <?php echo Form::number('totalcuotas',$estadoc->totalcuotas, [ 'id'=>'totalcuotas','class' => 'form-control','readonly'=>'readonly']); ?>

                        </b>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>MONTO SIN INTERES:</td>
                    <td><?php echo Form::number('monto', $estadoc->montoactual, ['id'=>'monto','class' => 'form-control' ,'onkeyup'=>'Sumar()', 'required' => 'required', 'step'=>'0.01']); ?></td>
               
                  </tr>
                  <tr>
                    <td>Gastos por gestión de cobros / notariales:</td>
                    <td><?php echo Form::number('gastosadmon', $estadoc->gastosadmon, ['id'=>'gastosadmon','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Cobros. . .', 'autofocus'=>'on', 'step'=>'0.01']); ?></td>
                  </tr>
                  <tr>
                    <td>Gastos Administrativos por Notificación:</td>
                    <td><?php echo Form::number('gastosnoti', $estadoc->gastosnotariales, ['id'=>'gastosnoti','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Notificación. . .', 'autofocus'=>'on', 'step'=>'0.01']); ?></td>
                  </tr>
                  <tr>
                    <td><b style="color:red">TOTAL A CANCELAR</b></td>
                    <td><b><?php echo Form::text('total', $estadoc->total, [ 'id'=>'total','class' => 'form-control' ,'readonly'=>'readonly', 'autofocus'=>'on', 'step'=>'0.01']); ?></b></td>
                   
                  </tr>
                </tbody>
              </table>
              <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
              <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button class="btn btn-primary btn-lg pull-right" type="submit"> Actualizar</button>
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
<script>
function Multi(){
  totalcuotas=parseFloat(document.getElementById("totalcuotas").value);
  numero1 = parseFloat(document.getElementById("cuotasatrasadas").value);
  numero2 = parseFloat(document.getElementById("cuota").innerHTML);
 
  if(isNaN(numero1)) {
    totalcuotas=totalcuotas*0;
} else {
  totalcuotas=numero1*numero2;
}
document.getElementById("totalcuotas").value = totalcuotas;
}
</script>

<!--Script para sumar el total del monto a pagar-->
<script>
function Sumar(){
 total=parseFloat(document.getElementById("monto").value);
 numero1 = parseFloat(document.getElementById("monto").value);
 numero2 = parseFloat(document.getElementById("totalcuotas").value);
 numero3 = parseFloat(document.getElementById("gastosnoti").value);
 numero4 = parseFloat(document.getElementById("gastosadmon").value);
 
 
if((isNaN(numero2)) && (isNaN(numero4)) && (isNaN(numero3))){
  total=numero1;
}else if((isNaN(numero2)) && (isNaN(numero3))){
    total+=numero4;
}else if((isNaN(numero4)) && (isNaN(numero3))){
  total+=numero2;
}else if((isNaN(numero2)) && (isNaN(numero4))){
  total+=numero3;
}else if((isNaN(numero2))){
    total+=numero4+numero3;
}else if((isNaN(numero3))){
  total+=numero2+numero4;
}else if((isNaN(numero4))){
  total+=numero3+numero2;
}else if((isNaN(numero1))){
  total+=numero3+numero2+numero4;
}
else {
   total=numero1 + numero2 + numero3+numero4;
}
document.getElementById("total").value = total.toFixed(2);
}
</script>



<?php $__env->stopPush(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>