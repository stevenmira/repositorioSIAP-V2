<?php $__env->startSection('contenido'); ?>
<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
     LISTA DE CLIENTES POR CARTERA
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo e(URL::action('ClienteController@index')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"><a href="<?php echo e(URL::action('CarteraController@index')); ?>"> Carteras</a></li>
    <li class="active"> Cartera de clientes</li>
  </ol>
</section>

<br>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <?php echo $__env->make('carteras.ListaCliente.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
  </div>
  <div class="row">
   <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
      <div style="text-align: left;">
        <h4><b>Cartera : </b> <?php echo e($nombre); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Ejecutivo : </b><?php echo e($car->ejecutivo); ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Supervisor : </b><?php echo e($car->supervisor); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </h4>
    </div>
   </div>

   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <?php echo Form::open(array('url'=>'lista/clientesPDF/'.$id ,'method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

      <div class="form-group">
        <span class="input-group-btn">
        <input type="date" hidden="true" name="fecha" value="<?php echo e($searchText); ?>">
        <button type="submit" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-print" aria-hidden="true"></i>Imprimir</button></span>
      </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" style="padding: 4px 4px;">
            <table class="table table-striped table-bordered table-condensed table-hover text-centered" style="border: 1px solid #333;">

                    <thead>
              <tr class="success" style="border: 1px solid #333;">

              <th colspan="12" style="border: 1px solid #333;">

             <h3 style="text-align: center;"><b>PAGOS DIARIOS</b></h3>

                              
                          </th>
                      </tr>
             <tr class="info" style="border: 1px solid #333;text-align: center;">

                            
                  <th style="border: 1px solid #333;text-align: center;">Nº</th>
                  <th style="border: 1px solid #333;text-align: center;">CLIENTE/NOMBRE</th>
                  <th style="border: 1px solid #333;text-align: center;">SALDO CAPITAL</th>
                  <th style="border: 1px solid #333;text-align: center;">INTERES DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">CAPITAL DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">TOTAL RECIBIDO DIARIO</th>
                  <th style="border: 1px solid #333;text-align: center;">#CUOTAS ATRASADAS</th>
                  <th style="border: 1px solid #333;text-align: center;">PRECIO DE CUOTA</th>
                  <th style="border: 1px solid #333;text-align: center;">TOTAL CUOTAS ATRASADAS</b></th>
                  </tr>

                        <?php
                        $sum_interes_diario=0;
                        $sum_capital_diario=0;
                        $sum_recibo_diario=0;
                        $sum_total_atrasadas=0;

                        $n=0;

                        $i=0;
                        ?>

                    </thead>
                      <?php foreach($consulta as $con): ?>
                     <tr style="text-align: center;">
                          
                          <?php $n=$n+1?>                         
                          <td style="border: 1px solid #333;"><?php echo e($n); ?></td>
                          <td style="border: 1px solid #333;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>

                          <?php $saldo_capital = $con->monto - $con->cuotacapital; ?>

                          <?php if($con->monto == null): ?>
                          <td style="border: 1px solid #333;"><?php echo e($array2[$i]); ?></td>
                          <?php else: ?>
                           <td style="border: 1px solid #333;"><?php echo e($saldo_capital); ?></td>
                          <?php endif; ?>

                          <td style="border: 1px solid #333;"><?php echo e($con->interes); ?></td>
                          <td style="border: 1px solid #333;"><?php echo e($con->cuotacapital); ?></td>
                          <td style="border: 1px solid #333;"><?php echo e($con->totaldiario); ?></td>

                          <td style="border: 1px solid #333;"><?php echo e($array[$i]); ?></td>
                          
                          <td style="border: 1px solid #333;"><?php echo e($con->cuotadiaria); ?></td>

                          <?php $total = $array[$i] * $con->cuotadiaria ?>
                          <td style="border: 1px solid #333;"><?php echo e($total); ?></td>
                      </tr>
                    


                      <?php 
                    
                     $sum_interes_diario = $sum_interes_diario + $con->interes; 
                     $sum_capital_diario = $sum_capital_diario + $con->cuotacapital;
                     $sum_recibo_diario =  $sum_recibo_diario+  $con->totaldiario;
                     $sum_total_atrasadas = $sum_total_atrasadas + $total;

                     $i = $i + 1;

                     ?>
                    <?php endforeach; ?>

                     <tr class="danger">
        <td style="border: 1px solid #333"><span>TOTAL</span></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
      
        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de Intereses" class="rojo total"> <b><?php echo e($sum_interes_diario); ?></b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total de cuota capital" class="rojo total"> <b><?php echo e($sum_capital_diario); ?></b></a></td>

        <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><a href="#" data-title="Total diario" class="rojo total"> <b><?php echo e($sum_recibo_diario); ?></b> </a></td>
         <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333"></td>
        <td style="border: 1px solid #333; text-align: center;"><span class="pull-center">&nbsp;$</span><a href="#" data-title="Total Cuotas Atrasadas" class="rojo total"> <b><?php echo e($sum_total_atrasadas); ?></b> </a></td>

        
       
      </tr>
    
  </table>

  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b><?php echo e($fecha_actual); ?></b></h3>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>