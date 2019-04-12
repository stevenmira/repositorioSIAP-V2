<?php $__env->startSection('contenido'); ?>

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    Editar Estado de Cuenta
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>"> Estados de Cuentas</a></li>
    <li class="active">Editar</li>
  </ol>
</section>
<br>



  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
      

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
      
          <section class="posts col-md-9">
          <?php echo Form::open(array('action' => array('ComprobanteController@update',$estadoc->idcomprobante), 'method'=>'PATCH','autocomplete'=>'off')); ?>

          
        <?php echo e(Form::token()); ?> 
          <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
              <div class="panel panel-info">
        
                <div class="panel-heading">
                  <h3 class="panel-title">INFORMACIÓN DEL CLIENTE</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                   
        
                    <div class=" col-md-12 col-lg-12"> 
                      <table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td>NOMBRES Y APELLIDOS:</td>
                            <td><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></td>
                          </tr> 
                        
                          <tr>
                            <td>DUI:</td>
                            <td><?php echo e($cliente->dui); ?></td>
                          </tr>
                          <tr>
                            <td>NIT:</td>
                            <td><?php echo e($cliente->nit); ?></td>
                          </tr>                
                          <tr>
                            <td>DIRECCIÓN:</td>
                            <td><?php echo e($cliente->direccion); ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                </div>
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
                            <td>CUOTAS ATRASADAS <b class="col-xs-3 col-sm-3  col-md-3 col-lg-3"><?php echo Form::text('cuotasatrasadas',$estadoc->diasatrasados, ['id'=>'cuotasatrasadas','readonly'=>'readonly','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','autofocus'=>'on','maxlength'=>'3']); ?></b> DE $<span id="cuota"><?php echo e($cliente->cuotadiaria); ?></span></td>
                            <td><b><?php echo Form::text('totalcuotas',$estadoc->totalcuotas, [ 'id'=>'totalcuotas','class' => 'form-control','readonly'=>'readonly', 'autofocus'=>'on','maxlength'=>'6']); ?></b></td>
                          </tr>
                          <tr>
                            <td>MONTO SIN INTERES:</td>
                            <td><?php echo Form::text('monto', $estadoc->montoactual, ['id'=>'monto','class' => 'form-control' ,'readonly'=>'readonly','onkeyup'=>'Sumar()', 'required' => 'required', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                       
                          </tr>
                          <tr>
                            <td>Gastos Administrativos por Gestión de Cobros:</td>
                            <td><?php echo Form::text('gastosadmon', $estadoc->gastosadmon, ['id'=>'gastosadmon','readonly'=>'readonly','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Cobros. . .', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                          </tr>
                          <tr>
                            <td>Gastos Administrativos por Notificación:</td>
                            <td><?php echo Form::text('gastosnoti', $estadoc->gastosnotariales, ['id'=>'gastosnoti','readonly'=>'readonly','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Notificación. . .', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                          </tr>
                          <tr>
                            <td><b style="color:red">TOTAL A CANCELAR</b></td>
                            <td><b><?php echo Form::text('total', $estadoc->total, [ 'id'=>'total','class' => 'form-control' ,'readonly'=>'readonly', 'autofocus'=>'on', 'maxlength'=>'6']); ?></b></td>
                           
                          </tr>
                        </tbody>
                      </table>
                   </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
              <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>
                <div>
                  <a href="<?php echo e(URL::action('ComprobanteController@estadoPDF',$id)); ?>" class="btn btn-danger btn-lg col-md-offset-9">Imprimir</a></div>
<div>
                <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" class="btn btn-danger btn-lg col-md-offset-2">Cancelar</a>
                  </div>
 
                  </div>
            </div>
          </div>
            
        </section>
        <aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
        <div class="box-body">
    <?php if($usuarioactual->idtipousuario!=1): ?>
    <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="<?php echo e(URL::action('RecordClienteController@recibo',$cliente->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
      <a href="<?php echo e(URL::action('RecordClienteController@pagare',$cliente->idcuenta)); ?>" target="_blank" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Imprimir pagaré">
        <i class="fa fa-print"></i> Pagaré
      </a>
    <?php endif; ?>
    <?php if($usuarioactual->idtipousuario==1): ?>
      <a href="<?php echo e(URL::action('RecordClienteController@pagare',$cliente->idcuenta)); ?>" target="_blank" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Imprimir pagaré">
        <i class="fa fa-print"></i> Pagaré
      </a>
      <a href="<?php echo e(url('cuenta/desembolso', ['id' => $cliente->idcuenta])); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver desembolso">
        <i class="fa fa-print"></i> Desembolso
      </a>
      <a href="<?php echo e(url('cuenta/carteraPagos', ['id' => $cliente->idcuenta])); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver cartera de pagos">
        <i class="fa fa-money"></i> Cartera Pagos
      </a>
      <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="<?php echo e(URL::action('RecordClienteController@recibo',$cliente->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
     
      <?php endif; ?>
    </div>
</aside>

          
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