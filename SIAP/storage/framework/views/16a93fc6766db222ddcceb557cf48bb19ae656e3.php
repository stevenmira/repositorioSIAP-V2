<!DOCTYPE html>
<html>
<head>
	<title>CONTROL DE CREDITOS</title>
	<style type="text/css">
		@page{
			margin-top: 10.0mm;
            margin-bottom: 10.0mm;
		}
		body{
			line-height: 22px;
		}

		.padd{
		    padding: 0px 25px 0px 25px;
		  }

		  .padd2{
		    padding: 0px 10px 0px 10px;
		    font-size: 15px;
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

	<div class="padd">
		<table style="width: 100%; border-collapse: collapse;">
			<tr>
				<td>
					<p style="">
						Cartera:&nbsp;&nbsp; <?php echo e($idcartera); ?>

					</p>
				</td>
				<td>
					<p style="">
						Fecha de inicio:&nbsp;&nbsp; <?php echo e($desde); ?>

					</p>
				</td>
				<td>
					<p style="">
						Fecha Fin:&nbsp;&nbsp; <?php echo e($hasta); ?>

					</p>
				</td>
			</tr>
	  	</table>
		<p class="col-md-3 col-lg-3 col-sm-3  "><b>Cartera:</b>&nbsp;&nbsp;&nbsp; asdas</p>
    	<p class="col-md-3 col-lg-3 col-sm-3"><b>Fecha de Inicio:</b>&nbsp;&nbsp;&nbsp; <?php echo e($desde); ?></p>
    	<p class="col-md-2 col-lg-2 col-sm-2"><b>Fecha Fin:</b>&nbsp;&nbsp;&nbsp; <?php echo e($hasta); ?></p>
	</div>

</body>
</html>