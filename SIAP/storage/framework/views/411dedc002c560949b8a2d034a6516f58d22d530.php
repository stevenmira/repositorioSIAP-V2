<?php $__env->startSection('contenido'); ?>

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
  EDITAR ESTADO DE CUENTA VENCIDO
  </h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
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
          <?php echo Form::open(array('action' => array('ComprobanteController@mostrar',$estadoc->idcomprobante), 'method'=>'PATCH','autocomplete'=>'off')); ?>

          
        <?php echo e(Form::token()); ?> 
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
              <div class="panel panel-info">
        
                <div class="panel-heading">
                  <h3 class="panel-title">INFORMACIÓN DEL CLIENTE</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                           
                    <div class=" col-md-9 col-lg-9 "> 
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
                          
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 "> 
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>SALDO PENDIENTE DE CUOTAS: <b><?php echo e($estadoc->diaspendientes); ?></b> DE <b>$<?php echo e($estadoc->totalpendiente); ?></b></td>
                            <td> <b>$<?php echo e($estadoc->totalpendiente); ?></b></td>
                          </tr>
                          <tr>
                            <td><b><?php echo e($estadoc->cuotadeuda); ?></b> CUOTAS DE <b>$<?php echo e($cliente->cuotadiaria); ?></b> DEL </td>
                            <td> <b>$<?php echo e($estadoc->totalcuotasdeuda); ?></b></td>
                          </tr>
                          <tr>
                            <td><b><?php echo e($ultimacuota); ?></b> CUOTA DE <b>$<?php echo e($estadoc->ultimacuota); ?></b> DEL </td>
                            <td> <b>$<?php echo e($estadoc->ultimacuota); ?></b></td>
                          </tr>
                          <tr>
                            <td class="col-xs-12 col-sm-12 col-md-8 col-lg-8">MORA POR INCUMPLIMIENTO DE CONTRATO DE UN CAPITAL DE <b><?php echo e($estadoc->montoactual); ?>*<?php echo e($cliente->interes*100); ?>*<?php echo e($estadoc->diasatrasados); ?></b> DIAS ATRASADOS:</td>
                            <td><?php echo e($estadoc->mora); ?></td>
                          </tr>
                          <tr>
                            <td><b style="color:blue">SubTotal</b></td>
                            <td><span id="monto"><?php echo e($subtotal); ?></span></td>
                          </tr>
                          <tr>
                            <td>Gastos de Administración por gestion de cobros:</td>
                            <td><?php echo Form::text('gastosadmon', $estadoc->gastosadmon, ['id'=>'gastosadmon','readonly'=>'readonly','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca los gastos administrativos. . .', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                          </tr>
                          <tr>
                            <td>Gastos Administrativos por Notificación:</td>
                            <td><?php echo Form::text('gastosnoti', $estadoc->gastosnotariales, ['id'=>'gastosnoti','readonly'=>'readonly','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Gastos por Notificación. . .', 'autofocus'=>'on', 'maxlength'=>'6']); ?></td>
                          </tr>
                          <tr>
                            <td><b style="color:red">TOTAL A CANCELAR</b></td>
                            <td><b><?php echo Form::text('total',$estadoc->total, [ 'id'=>'total','class' => 'form-control' , 'disabled' => 'disabled', 'autofocus'=>'on', 'maxlength'=>'6']); ?></b></td>
                           
                          </tr>
                        </tbody>
                      </table>
                   </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                 <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input>

                 <a href="<?php echo e(URL::action('ComprobanteController@show',$cliente->idcuenta)); ?>" class="btn btn-danger btn-lg col-md-offset-2">Cancelar</a>
                 <a href="<?php echo e(URL::action('ComprobanteController@estadoPDF',$id)); ?>" class="btn btn-danger btn-lg col-md-offset-2">IMPRIMIR</a>
                          

                 
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
      <a data-target="#modal-cancelar-<?php echo e($estadoc->idcomprobante); ?>" data-toggle="modal" class="btn col-md-12 col-lg-12 btn-app" style="background: #ccff90; color: black;" data-title="Realizar Pago" >
       <i class="fa fa-info-circle" aria-hidden="true"></i> <b>CANCELAR DEUDA </b>
      </a>
                 
      <?php endif; ?>
    </div>
</aside>
      </div>
    </div>
  </div>

<?php echo Form::close(); ?>

<?php echo $__env->make('estadoCuenta.cancelar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
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