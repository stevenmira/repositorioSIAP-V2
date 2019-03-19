<?php $__env->startSection('contenido'); ?>

<style type="text/css">
  th{
    text-align: center;
  }

  a.total{
    color: black;
  }
  a.total:visited {text-decoration:none; color:#000} /*Link visitado*/
  a.total:active {text-decoration:none; color:#000;} /*Link activo*/
  a.total:hover {text-decoration:none; color:#000; } /*Mause sobre el link*/

  /* Style The Dropdown Button */
  .dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 2px 8px;
    font-size: 15px;
    border: none;
    cursor: pointer;
  }

  /* Mis estilos */
  .idbtn {
    background-color: #f9f9f9;
    border: none;
    cursor: pointer;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    min-width: 200px;
    text-align: left;
  }

  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  /* Links  inside the dropdown */
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {background-color: #f1f1f1}
  .dropdown-content .idbtn:hover {background-color: #f1f1f1}

  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content, .idbtn {
    display: block;
  }

  /* Change the background color of the dropdown button when the dropdown content is shown */
  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }
</style>

<section class="content-header">  
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="<?php echo e(URL::action('RecordClienteController@index')); ?>"> Récord Cliente</a></li>
    <li><a href="<?php echo e(URL::action('CuentaController@show',$cuenta->idcuenta)); ?>"> Cuenta</a></li>
    <li class="active">Cartera de Pagos</li>
  </ol>
</section>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 0px 0px 10px 0px;"><b>CARTERA DE PAGOS</b></h4>

<div style="border-color:#212121; border-style:dashed; border-width:2px;" class="container">
  <table>
    <thead style="padding: 10px 5px 5px 5px;">
      <tr style="padding: 10px 5px 5px 5px;">
        <td style="width: 160px; font-weight: bold; padding: 10px 5px 5px 5px;">NOMBRE DEL CLIENTE:</td>
        <td style="width: 250px;"><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></td>
        <td style="width: 160px; font-weight: bold;">NOMBRE DEL NEGOCIO:</td>
        <td style="width: 250px;"><?php echo e($negocio->nombre); ?></td>
        <td style="width: 90px; font-weight: bold;">CATEGORIA:</td>
        <td style="width: 30px; font-weight: bold;">"<?php echo e($categoria->letra); ?>"</td>
        <td style="width: 30px;">
          <a data-target="#modalCategoria-delete-<?php echo e($cliente->idcliente); ?>" data-toggle="modal" style="cursor: pointer;">
            <span class="fa fa-pencil">editar</span> 
          </a>
          <?php echo $__env->make('liquidacion.modalCategoria', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="width: 160px; font-weight: bold; padding: 5px 5px 10px 5px;">ACTIVIDAD ECON.:</td>
        <td style="width: 250px;"><?php echo e($negocio->actividadeconomica); ?></td>
        <td style="width: 160px; font-weight: bold;">DIREC. DEL NEGOCIO:</td>
        <td style="width: 250px;"><?php echo e($negocio->direccionnegocio); ?></td>
        <td>
          <div class="dropdown">
            <button class="dropbtn">Acciones</button>
            <div class="dropdown-content">
              <a href="<?php echo e(URL::action('ClienteController@show',$cliente->idcliente)); ?>">Ver Perfil</a>
              <?php echo Form::open(array('url'=>'cuenta/carteraPagos/'.$cuenta->idcuenta,'method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

                <button  class="idbtn"  type="submit">
                  Actualizar estados de cuotas
                </button>
                <input type="text" name="searchText" hidden="on" value="actualizarEstadosCuotas">
              <?php echo e(Form::close()); ?>


              <?php echo Form::open(array('url'=>'cuenta/carteraPagos/'.$cuenta->idcuenta,'method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

                <button class="idbtn" type="submit">
                  Actualizar Pagos
                </button>
                <input type="text" name="searchText" hidden="on" value="actualizarPagos">
              <?php echo e(Form::close()); ?>


              <a href="<?php echo e(URL::action('LiquidacionController@show',$cuenta->idcuenta)); ?>" target="_blank">Proyectar cartera de pagos</a>
              <a href="<?php echo e(URL::action('LiquidacionController@carteraPDF',$cuenta->idcuenta)); ?>" target="_blank">Imprimir cartera ideal</a>
              <a href="<?php echo e(URL::action('LiquidacionController@carteraRealPDF',$cuenta->idcuenta)); ?>" target="_blank">Imprimir cartera real</a>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<section class="content">
<!-- Notificación -->
  <div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
    <?php if(Session::has('create')): ?>
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>El cliente <b><?php echo e(Session::get('create')); ?></b> ha sido guardado correctamente.</h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('inactivo')): ?>
    <div class="alert  fade in" style="background:  #ffd54f;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('inactivo')); ?></b></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('mensaje')): ?>
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('mensaje')); ?></b></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('negativo')): ?>
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('negativo')); ?></b></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('fail')): ?>
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('fail')); ?></b></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('gravado')): ?>
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('gravado')); ?></b></h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('limpiar')): ?>
    <div class="alert  fade in" style="background:  #ffe57f ;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('limpiar')); ?></b></h4>  
    </div>
    <?php endif; ?>

    <?php if(Session::has('finish')): ?>
    <div class="alert  fade in" style="background:  #b2ebf2 ;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><b><?php echo e(Session::get('finish')); ?></b></h4>  
    </div>
    <?php endif; ?>

    <?php if(Session::has('cmp1')): ?>
    <div class="alert  fade in" style="background:  #ffe57f;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>  <b>Advertencia: componente -- <?php echo e(Session::get('cmp1')); ?> --</b> </h4>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj0')): ?>
    <div class="alert  fade in" style="background:  #ccff90;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p> <?php echo e(Session::get('msj0')); ?> </p>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj1')): ?>
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p> <?php echo e(Session::get('msj1')); ?> </p>
    </div>
    <?php endif; ?>

    <?php if(Session::has('msj2')): ?>
    <div class="alert  fade in" style="background:  #ff9e80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <P> <?php echo e(Session::get('msj2')); ?> </P>
    </div>
    <?php endif; ?>

    <?php if(Session::has('cmp2')): ?>
    <div class="alert  fade in" style="background:  #ffe57f;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <p>Advertencia: componente -- <?php echo e(Session::get('cmp2')); ?> -- </p>
    </div>
    <?php endif; ?>
  </div>

  <!-- Fin Notificación -->
<div class="container">
<div class="row">

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p><label class="control-label input-label" >CANCELADO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-3 col-xs-12">
            <p style="color: red;"> <b> <?php echo e($cancelado); ?> </b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >ABONO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b><?php echo e($abono); ?></b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >ATRASO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b><?php echo e($atraso); ?></b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >PENDIENTE:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b><?php echo e($pendiente); ?></b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >NO_VALIDO:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <p style="color: red;"><b><?php echo e($novalido); ?></b></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-1 col-xs-12">
            <p><label class="control-label input-label" >TOTAL:</label></p>
      </div>

      <div class="col-md-1 col-lg-1 col-sm-2 col-xs-12">
            <?php $total = $cancelado + $abono + $atraso + $pendiente + $novalido?>
            <p style="color: red;"><b><?php echo e($total); ?></b></p>
      </div>
    </div>
</div>


<div class="table-responsive">
  <table class="table table-striped table-bordered  table-condensed table-hover">
    <thead>
      <tr class="info">
        <th style="border: 1px solid #333; width: 75px; background: #fff; border-left: 0px; border-top: 0px;" rowspan="3"> </th>
        <th style="border: 1px solid #333; width: 200px" rowspan="2" align="center"><span>N</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>MONTO</span></th>
        <th style="border: 1px solid #333; width: 130px" align="center"><span>Interés diario</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>PAGOS DIARIOS</span></th>
        <th style="border: 1px solid #333; width: 130px" rowspan="2" align="center"><span>CUOTA DIARIA</span></th>
        <th style="border: 1px solid #333; width: 170px" rowspan="2" align="center"><span>CARTERA</span></th>
      </tr>
      <tr class="info">
        <?php $interes = $tipo_credito->interes * 100; ?>
        <td style="border: 1px solid #333; height: 10px; text-align:center;"><?php echo e($interes); ?> %</td>
      </tr>
      <tr class="info">
      <td style="border: 1px solid #333; text-align: right;"><?php echo e($cuenta->numeroprestamo); ?></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span><?php echo e($prestamo->monto); ?></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
       <td style="border: 1px solid #333; text-align: right;"><span class="pull-left" >$ </span> <?php echo e($prestamo->cuotadiaria); ?></td>
       <td style="border: 1px solid #333; text-align:center;"> <?php echo e($cartera->nombre); ?></td>
      </tr>
    </thead>
    <tbody>
      <tr class="warning">
        <td style="border: 1px solid #333" align="center"><span>DIA</span></td>
        <td style="border: 1px solid #333" align="center"><span>FECHA</span></td>
        <td style="border: 1px solid #333" align="center"><span>MONTO</span></td>
        <td style="border: 1px solid #333" align="center"><span>INTERES DIARIO</span></td>
        <td style="border: 1px solid #333" align="center"><span>CUOTA CAPITAL</span></td>
        <td style="border: 1px solid #333" align="center"><span>TOTAL DIARIO</span></td>
        <td style="border: 1px solid #333" align="center"><span>FECHA EFECTIVA DE PAGO</span></td>
        <td style="border: 1px solid #333" align="center"><span>ESTADO</span></td>
      </tr>
      
      <?php foreach($liquidaciones as $ma): ?>
      
       
        <?php if($ma->estado == 'CANCELADO'): ?>
          <tr style="background: #ccff90;">
        <?php elseif($ma->estado == 'CANCELADO CON REF.'): ?>
          <tr style="background: #e6ee9c;">
        <?php elseif($ma->estado == 'ATRASO'): ?>
          <tr style="background: #ffcdd2;">
        <?php elseif($ma->estado == 'ABONO'): ?>
          <tr style="background: #fff59d;">
        <?php elseif($ma->estado == 'NO VALIDO'): ?>
          <tr style="background: #eeeeee;">
        <?php else: ?>
          <tr>
        <?php endif; ?>
            <?php if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d')): ?>
            <td style="border: 1px solid #333; background: #ffd740;" align="center"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-<?php echo e($ma->iddetalleliquidacion); ?>" data-toggle="modal"> <?php echo e($ma->contador); ?></a></span></td>
            <?php else: ?>
              <td style="border: 1px solid #333;" align="center"><span><a class="rojo" data-title=" ANULAR PAGO " href="" data-target="#modal-delete-<?php echo e($ma->iddetalleliquidacion); ?>" data-toggle="modal"> <?php echo e($ma->contador); ?></a></span></td>
            <?php endif; ?>

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            <?php if( $ma->fechadiaria != null): ?>
            <td style="border: 1px solid #333;" align="center"><span> <?php echo e($ma->fechadiaria->format('l j  F Y ')); ?></span></td>
            <?php else: ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechadiaria); ?></span></td>
            <?php endif; ?>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->monto); ?></td>

            <?php if( $ma->abonocapital == "NO"): ?>
              <td style="border: 1px solid #333; text-align: right; background:#b2ff59;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->interes); ?></td>
            <?php else: ?>
              <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->interes); ?></td>
            <?php endif; ?>

            <?php if( $ma->abonocapital == "SI"): ?>
              <td style="border: 1px solid #333; text-align: right; background: #b2ff59;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->cuotacapital); ?></td>
            <?php else: ?>
              <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->cuotacapital); ?></td>
            <?php endif; ?>

            <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span> <?php echo e($ma->totaldiario); ?></td>

            <?php if( $ma->fechaefectiva != null): ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechaefectiva->format('l j  F Y ')); ?></span></td>
            <?php else: ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechaefectiva); ?></span></td>
            <?php endif; ?>

            <?php if($ma->estado != 'NO VALIDO'): ?>
            <td style="border: 1px solid #333" align="center">
              <span> 
                <a data-target="#modalEsta2-delete-<?php echo e($ma->iddetalleliquidacion); ?>" data-toggle="modal" style="cursor: pointer;">
                  <?php echo e($ma->estado); ?>

                </a>
              </span>
            </td>
            <?php else: ?>
            <td style="border: 1px solid #333" align="center"><span><?php echo e($ma->estado); ?></span></td>
            <?php endif; ?>
            
            <?php if($ma->estado != 'NO VALIDO'): ?>
            <td style="border: 1px solid #333" align="center"><span></span> <a href="<?php echo e(URL::action('LiquidacionController@edit', $ma->iddetalleliquidacion)); ?> " class="btn btn-success verde" data-title="Ingresar cuota"><i class="fa fa-fw -square -circle fa-plus-square"></i></a></td>
            <?php else: ?>
            <td style="border: 1px solid #333" align="center"><span></span></td>
            <?php endif; ?>

          </tr>
        <?php echo $__env->make('liquidacion.modalEstados', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('liquidacion.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; ?>
      <tr class="danger">
        <td style="border: 1px solid #333"><span>TOTALES</span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de Intereses" class="rojo total"> <b><?php echo e($sum_interes_diario); ?></b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de cuota capital" class="rojo total"> <b><?php echo e($sum_cuota_capital); ?></b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total diario" class="rojo total"> <b><?php echo e($sum_total_diario); ?></b> </a></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
      </tr>
    </tbody>
  </table>
</div>
<?php echo e($liquidaciones->render()); ?>


<div class="row">
  <a href="<?php echo e(URL::action('RecordClienteController@index')); ?>" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b><?php echo e($fecha_server); ?></b></h3>
  </div>
</div>

</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>