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

<!-- Notificación -->
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">

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

  <?php if(Session::has('exito')): ?>
  <div class="alert  fade in" style="background:  #bbdefb;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <P> <?php echo e(Session::get('exito')); ?> </P>
  </div>
  <?php endif; ?>
</div>
    
<section class="posts col-md-9">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            CLIENTE
            <?php if($usuarioactual->idtipousuario==1): ?>
            <a href="<?php echo e(URL::action('ClienteController@show',$cliente->idcliente)); ?>">
              <span class="pull-right"> ver perfil <i class="fa fa-user"></i></span> 
            </a>
            <?php endif; ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">

            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>CARTERA CLIENTE:</td>
                    <td><?php echo e($cartera->nombre); ?></td>
                  </tr>

                  <tr>
                    <td>NOMBRE CLIENTE:</td>
                    <td><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?> (<?php echo e($edad); ?> años)</td>
                  </tr>

                  <tr>
                    <td>DUI CLIENTE:</td>
                    <td><?php echo e($cliente->dui); ?></td>
                  </tr>
                </tbody>
              </table>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            NEGOCIO 
            <?php if($usuarioactual->idtipousuario==1): ?>
            <a href="<?php echo e(URL::action('NegocioController@edit',$negocio->idnegocio)); ?>">
              <span class="pull-right">editar <i class="fa fa-info-circle"></i></span> 
            </a>
            <?php endif; ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
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
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            CRÉDITO
            <?php if($usuarioactual->idtipousuario==1): ?>
            <a data-target="#modalCredito-delete-<?php echo e($prestamo->idprestamo); ?>" data-toggle="modal" style="cursor: pointer;">
              <span class="pull-right"> editar <i class="fa fa-info-circle"></i></span> 
            </a>
            <?php echo $__env->make('cuenta.modalCredito', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
          </h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class=" col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>CRÉDITO:</td>
                    <td><?php echo e($prestamo->estado); ?></td>
                    <td>FECHA:</td>
                    <td><?php echo e($prestamo->fecha->format('l j  F Y ')); ?></td>
                    <td>DESEMBOLSO:</td>
                    <?php if($prestamo->idtipodesembolso == 1): ?>
                      <td> <?php echo e($tipo_desembolso->nombre); ?></td>
                    <?php else: ?>
                      <td><?php echo e($prestamo->numerocheque); ?></td>
                    <?php endif; ?>
                  </tr>

                  <tr>
                    <td>MONTO:</td>
                    <td>$ <?php echo e($prestamo->monto); ?></td>
                    <?php $interes = $tipo_credito->interes * 100;  ?>
                    <td>INTERÉS:</td>
                    <td><?php echo e($interes); ?> %</td>
                    <td>CUOTA DIARIA:</td>
                    <td>$ <?php echo e($prestamo->cuotadiaria); ?></td>
                  </tr>
                  
                  <?php if($prestamo->estadodos == 'CERRADO'): ?>
                  <tr style="background:rgba(244, 67, 54, 0.1);">
                    <td>SALDO CAPITAL:</td>
                    <td><?php echo e($cuenta->capitalanterior); ?></td>
                    <td>CUOTAS ATRASADAS:</td>
                    <td><?php echo e($cuenta->cuotaatrasada); ?></td>
                    <td>MORA:</td>
                    <td><?php echo e($cuenta->mora); ?></td>
                  </tr>
                  <?php endif; ?>

                </tbody>
              </table>
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