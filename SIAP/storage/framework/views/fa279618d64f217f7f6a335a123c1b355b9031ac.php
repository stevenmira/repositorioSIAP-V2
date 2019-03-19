<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
        <i>CRÉDITO </i><i class="fa fa-chevron-right" aria-hidden="true"></i>
        <?php if($prestamo->estadodos == "ACTIVO"): ?>
          <b style="color: green;"><?php echo e($prestamo->estadodos); ?></b>
        <?php elseif($prestamo->estadodos == "CERRADO"): ?>
          <b style="color:#3F729B;"><?php echo e($prestamo->estadodos); ?></b>
        <?php else: ?>
          <b style="color: #ff8a80;"><?php echo e($prestamo->estadodos); ?></b>
        <?php endif; ?>

         <i class="col-md-offset-2 col-lg-offset-2 col-sm-offset-2">CUENTA </i><i class="fa fa-chevron-right" aria-hidden="true"></i>  
        <?php if($cuenta->estado == "ACTIVO"): ?>
          <b style="color: green;"><?php echo e($cuenta->estado); ?></b>
        <?php else: ?>
          <b style="color:#ff8a80;"><?php echo e($cuenta->estado); ?></b>
        <?php endif; ?>
  </h1>
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
        
  </h1> 
  <ol class="breadcrumb">
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li class="active">Cuenta</li>
  </ol>
</section>
<br>

<?php if(Session::has('inactivo')): ?>
  <div class="alert  fade in" style="background:  #ffff8d;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La cuenta ha sido modificada al estado <b><?php echo e(Session::get('inactivo')); ?></b>.</h4>
  </div>
<?php endif; ?>

<?php if(Session::has('activo')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> La cuenta ha sido modificada al estado <b><?php echo e(Session::get('activo')); ?></b>.</h4>
  </div>
<?php endif; ?>

<?php if(Session::has('inactivoP')): ?>
  <div class="alert  fade in" style="background:  #ffff8d;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El Prestamo ha sido modificado al estado <b><?php echo e(Session::get('inactivoP')); ?></b>.</h4>
  </div>
<?php endif; ?>

<?php if(Session::has('activoP')): ?>
  <div class="alert  fade in" style="background:  #ccff90;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4> El prestamo ha sido modificado al estado <b><?php echo e(Session::get('activoP')); ?></b>.</h4>
  </div>
<?php endif; ?>
    
<section class="posts col-md-9">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">CLIENTE</h3>
        </div>
        <div class="panel-body">
          <div class="row">

            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>CARTERA:</td>
                    <td><?php echo e($cartera->nombre); ?></td>
                  </tr>

                  <tr>
                    <td>NOMBRE:</td>
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
                    <td>EDAD:</td>
                    <td><?php echo e($cliente->edad); ?></td>
                  </tr>

                  <tr>
                    <td>TELÉFONO FIJO:</td>
                    <td><?php echo e($cliente->telefonofijo); ?></td>
                  </tr>

                  <tr>
                    <td>TELÉFONO CELULAR:</td>
                    <td><?php echo e($cliente->telefonocel); ?></td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN CLIENTE:</td>
                    <td><?php echo e($cliente->direccion); ?></td>
                  </tr>
                </tbody>
              </table>
              <?php if($usuarioactual->idtipousuario==1): ?> 
              <a href="<?php echo e(URL::action('ClienteController@edit',$cliente->idcliente)); ?>" class="btn btn-primary  pull-right">Actualizar</a>
           <?php endif; ?>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >
      <div class="panel panel-danger">

        <div class="panel-heading">
          <h3 class="panel-title">CRÉDITO - NEGOCIO</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>CRÉDITO:</td>
                    <td><?php echo e($prestamo->estado); ?></td>
                  </tr>

                  <tr>
                    <td>FECHA:</td>
                    <td><?php echo e($prestamo->fecha->format('l j  F Y ')); ?></td>
                  </tr>


                  <tr>
                    <td>MONTO</td>
                    <td> <?php echo e($prestamo->monto); ?></td>
                  </tr>

                  <?php $interes = $tipo_credito->interes * 100;  ?>

                  <tr>
                    <td>INTERÉS</td>
                    <td><?php echo e($interes); ?> %</td>
                  </tr>

                  <tr>
                    <td>CUOTA DIARIA</td>
                    <td> <?php echo e($prestamo->cuotadiaria); ?></td>
                  </tr>

                  <tr>
                    <td>NOMBRE NEGOCIO:</td>
                    <td><?php echo e($negocio->nombre); ?></td>
                  </tr>

                  <tr>
                    <td>ACTIVIDAD ECON.:</td>
                    <td><?php echo e($negocio->actividadeconomica); ?></td>
                  </tr>


                  <tr>
                    <td>DIRECCIÓN NEGOCIO:</td>
                    <td><?php echo e($negocio->direccionnegocio); ?></td>
                  </tr>

                </tbody>
              </table>
              <?php if($usuarioactual->idtipousuario==1): ?> 
              <a href="<?php echo e(URL::action('NegocioController@edit',$negocio->idnegocio)); ?>" class="btn btn-primary  pull-right">Actualizar</a>
             <?php endif; ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<aside class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
    <div class="box-body">
    <?php if($usuarioactual->idtipousuario!=1): ?>
    <a href="<?php echo e(URL::action('ComprobanteController@show',$cuenta->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="<?php echo e(URL::action('RecordClienteController@recibo',$cuenta->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
    <?php endif; ?>
    <?php if($usuarioactual->idtipousuario==1): ?>
      <a href="<?php echo e(URL::action('RecordClienteController@pagare',$cuenta->idcuenta)); ?>" target="_blank" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Imprimir pagaré">
        <i class="fa fa-print"></i> Pagaré
      </a>
      <a href="<?php echo e(url('cuenta/desembolso', ['id' => $cuenta->idcuenta])); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver desembolso">
        <i class="fa fa-print"></i> Desembolso
      </a>
      <a href="<?php echo e(url('cuenta/carteraPagos', ['id' => $cuenta->idcuenta])); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver cartera de pagos">
        <i class="fa fa-money"></i> Cartera Pagos
      </a>
      <a href="<?php echo e(URL::action('ComprobanteController@show',$cuenta->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Ver estados de cuenta">
        <i class="fa fa-folder"></i> Estado Cuenta
      </a>
      <a href="<?php echo e(URL::action('RecordClienteController@recibo',$cuenta->idcuenta)); ?>" style="background: #ccff90; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Generar recibo">
        <i class="fa fa-file"></i> Recibos
      </a>
      <a data-target="#modal-deleteP-<?php echo e($cuenta->idcuenta); ?>" data-toggle="modal" style="background: #ff8a80; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Cambiar estado del prestamo">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <b>Préstamo </b>
       </a>
       <a data-target="#modal-delete-<?php echo e($cuenta->idcuenta); ?>" data-toggle="modal" style="background: #ff8a80; color: black;" class="btn col-md-12 col-lg-12 btn-app" title="Cambiar estado de la cuenta">
       <i class="fa fa-info-circle" aria-hidden="true"></i> <b>Cuenta </b>
      </a>
     
      <?php endif; ?>
    </div>
</aside>

<?php echo $__env->make('cuenta.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div><?php echo $__env->make('cuenta.modalPrestamo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
<div><?php echo $__env->make('cuenta.modalDelete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>

<div class="row">
  <a href="<?php echo e(URL::action('RecordClienteController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<?php if($usuarioactual->idtipousuario==1): ?>
<div class="footer text-right">
  <div class="container-fluid">
      <a href="#" data-target="#modal-deleteD-<?php echo e($cuenta->idcuenta); ?>" data-toggle="modal" style="color: red;"  title="Elimina el Crédito Actual">
      <i class="fa fa-times" aria-hidden="true"></i> <b>Eliminar Crédito</b>
     </a>
  </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>