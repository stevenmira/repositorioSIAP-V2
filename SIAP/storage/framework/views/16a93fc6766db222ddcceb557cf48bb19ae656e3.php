<!DOCTYPE html>
<html>
<head>
	<title>CONTROL DE CREDITOS</title>
	<style type="text/css">
		
		body{
			line-height: 22px;
		}

		.padd{
		    padding: 0px 40px 0px 0px;
		  }


		.spn{
			display: block; 
			float: right; 
			padding: 0px 110px 0px 0px;
		}
	</style>
</head>
<body>
	<div>
		<table>
			<tr>
				<th style="width: 500px;" align="center" valign="bottom">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AFIMID, S.A. DE C.V.
				</th>
				<td>
					<img src="img/log.jpg" width="180px" height="70px">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS<br>SOCIEDAD ANONIMA DE CAPITAL<br>VARIABLE</td>
			</tr>
		</table>
	</div>
	<br>

	<div style="padding: 0px 10px 0px 10px;">
		<table style="width: 100%; border-collapse: collapse;">
			<tr>
				<td>
					<p style="float: left;">
						Usuario: <?php echo e($usuarioactual->nombre); ?>

					</p>
	 				<p style="float: right;">
	      				Fecha Emisión: <?php echo e(\Carbon\Carbon::now()->format('d-m-Y')); ?>

	  				</p>
				</td>
			</tr>
	  	</table>
	</div>

	<br>
	<br>
	<p style="font-size: 18px;" align="center">REPORTE DE CONTROL DE CRÉDITOS</p>

	<?php 
    	$desdeX = date("d/m/Y", strtotime($desde));
    	$hastaX = date("d/m/Y", strtotime($hasta));
  	?>

	<div>
		<table style="width: 100%; border-collapse: collapse;">
			<tr>
				<td>
					<p style="">
						Cartera:&nbsp;&nbsp; <?php echo e($idcartera); ?>

					</p>
				</td>
				<td>
					<p style="">
						Fecha de inicio:&nbsp;&nbsp; <?php echo e($desdeX); ?>

					</p>
				</td>
				<td>
					<p style="">
						Fecha Fin:&nbsp;&nbsp; <?php echo e($hastaX); ?>

					</p>
				</td>
			</tr>
	  	</table>

	<div class="padd">
		 <table  style="width: 100%; border-collapse: collapse; border: 1px solid #333;">
		    <thead>
			    <tr style="font-size: 12px; font-weight: normal;">
					<th style="border: 1px solid #333; text-align: center; width: 5%">N</th>
					<th style="border: 1px solid #333; text-align: center; width: 18%">CLIENTE</th>
					<th style="border: 1px solid #333; text-align: center; width: 12%">DUI</th>
					<th style="border: 1px solid #333; text-align: center; width: 10%">FECHA</th>
					<th style="border: 1px solid #333; text-align: center; width: 10%">MONTO</th>
					<th style="border: 1px solid #333; text-align: center; width: 10%">INTERES</th>
					<th style="border: 1px solid #333; text-align: center; width: 10%">COMISION</th>
					<th style="border: 1px solid #333; text-align: center; width: 10%">EFECTIVO NETO</th>
					<th style="border: 1px solid #333; text-align: center; width: 10%">CARTERA</th>
					<th style="border: 1px solid #333; text-align: center; width: 5%">DESEMBOLSO</th>
			    </tr>
		    </thead>
		    <?php
              $n=0;
            ?>
		    <tbody>
              <?php foreach($consulta as $con): ?>
              <tr style="font-size: 12px; font-weight: normal;border: 1px solid #333;">
                <?php $n=$n+1?>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e($n); ?></td>
                <td style="border: 1px solid #333; text-align: left;"><?php echo e($con->nombre); ?> <?php echo e($con->apellido); ?></td>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e($con->dui); ?></td>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e($con->fecha); ?></td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->monto,2)); ?></td>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e(number_format($con->interes,2)); ?>%</td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->comision,2)); ?></td>
                <td style="border: 1px solid #333; text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($con->montooriginal,2)); ?></td>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e($con->nombreCartera); ?></td>

                <?php if($con->nombreDesembolso == 'EFECTIVO'): ?>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e($con->nombreDesembolso); ?></td>
                <?php else: ?>
                <td style="border: 1px solid #333; text-align: center;"><?php echo e($con->numerocheque); ?></td>
                <?php endif; ?>
              </tr>
              <?php endforeach; ?>
              <tr style="background:rgba(244, 67, 54, 0.1); font-size: 12px;">
                <td></td>
                <td style="text-align: left;">TOTALES</td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($sumMonto,2)); ?></td>
                <td></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($sumComision,2)); ?></td>
                <td style="text-align: right;"><span class="pull-left">&nbsp;$</span><?php echo e(number_format($sumMontooriginal,2)); ?></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
		</table>
	</div>

</body>
</html>