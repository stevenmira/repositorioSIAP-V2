<!DOCTYPE html>
<html>
<head>
	<title>Formato Estado Cuenta</title>
	<style type="text/css">
		@page{
			margin-top: 25mm;
            margin-left: 15mm;
            margin-right: 15mm;
            margin-bottom: 25mm;

		}
		span{
			font-size: 13px;
		}
	</style>
</head>
<body>
	<div>
		<table>
			<tr>
				<th style="width: 500px;" align="left" valign="bottom">
					<img src="img/log.jpg" width="180px" height="70px">
				</th>
				<td valign="bottom">
					<span><?php echo e($diahoy); ?> DE <?php echo e(strtoupper($meshoy)); ?> DE <?php echo e($aniohoy); ?></span>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<div><span>CLIENTE: &nbsp;&nbsp;<?php echo e(strtoupper($cliente->nombre)); ?> <?php echo e(strtoupper($cliente->apellido)); ?></span></div>
	<div><span>NEGOCIO: &nbsp;&nbsp;<?php echo e(strtoupper($negocio->nombre)); ?> </span></div>
	<div><span>DUI: &nbsp;&nbsp;<?php echo e($cliente->dui); ?></span></div>
	<div><span>NIT: &nbsp;&nbsp;<?php echo e($cliente->nit); ?></span></div>
	<div><span>DIRECCION: &nbsp;&nbsp;<?php echo e(strtoupper($cliente->direccion)); ?></span></div>
	<div><span>TELEFONO: &nbsp;&nbsp;<?php echo e($cliente->telefonocel); ?></span></div>
	<br>
	<div><span>DEPARTAMENTO DE COBRO</span></div>
	<br>
	<br>
	<div align="center" style="width: 100%"><span>ESTADO DE CUENTA VENCIDA</span></div>
	<br>
	<div><span>DETALLE DE DEUDA</span></div>
	<br>
	<div>
		<table align="center" style="border-collapse: collapse; width: 99%;" >
			<thead>
				<tr>
					<th style="border: 1px solid #333; width: 30px; height: 20px;" align="center" valign="bottom" rowspan="2"><span style="font-size: 9px;">N</span></th>
					<th style="border: 1px solid #333; width: 200px;" align="center" valign="bottom" rowspan="2"><span style="font-size: 9px;">FECHAS</span></th>
					<th style="border: 1px solid #333" align="center" valign="bottom" rowspan="2"><span style="font-size: 10px;">DIAS</span></th>
					<th style="border: 1px solid #333" align="center" valign="bottom" colspan="2"><span style="font-size: 10px;">DETALLES</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">MORA POR<br>RETRASO/<br>O<br>INCUM-<br>PLIMIENTO</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">COBROS DE<br>ADMINISTRACION<br></span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">TOTAL</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2"><span style="font-size: 10px;">DETALLE</span></th>
				</tr>
				<tr>
					<th style="border: 1px solid #333" align="center" valign="bottom" colspan="2"><span style="font-size: 10px;">CUOTA DIARIA<br>$&nbsp;<?php echo e($prestamo->cuotadiaria); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">1</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">SALDO PENDIENTE DE <?php echo e($estadoc->diaspendientes); ?> CUOTA DE <?php echo e($estadoc->totalpendiente); ?> </span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"><?php echo e($estadoc->diaspendientes); ?></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->totalpendiente,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->totalpendiente,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">CUOTAS<br>VENCIDAS</span></td>	
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">2</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"> <?php echo e($estadoc->cuotadeuda); ?> CUOTAS DE $<?php echo e($prestamo->cuotadiaria); ?>. C/U</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"><?php echo e($estadoc->cuotadeuda); ?></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->totalcuotasdeuda,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->totalcuotasdeuda,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">CUOTAS<br>VENCIDAS</span></td>	
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">3</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"> 1 CUOTA <?php echo e($diafe); ?> DE <?php echo e(strtoupper($mesfe)); ?> DE <?php echo e($aniofe); ?></span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;">1</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->ultimacuota,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->ultimacuota,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">CUOTAS<br>VENCIDAS</span></td>	
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">4</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">Mora por incumplimiento de contrato<br>de un capital $<?php echo e($estadoc->montoactual); ?>*1%*<?php echo e($estadoc->diasexpirados); ?>*Dias<br>atrasados. Del</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"><?php echo e($estadoc->diasexpirados); ?></span></td>
					
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->mora,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->mora,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">MORA POR<br>INCUMPLI<br>MIENTO</span></td>	
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">5</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">Gasto de Administracion por gestion de<br>cobro</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
					
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">ADMON</span></td>	
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 10px;">6</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">Gastos Administrativos por Notificación</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
					
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">ADMON</span></td>	
				</tr>
				<tr>
					<th style="border: 1px solid #333; height: 30px" align="center" colspan="2"><span style="font-size: 9px;">TOTAL</span></th>
					<th style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></th>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->totalpendiente+$estadoc->totalcuotasdeuda+$estadoc->ultimacuota,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->mora,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e(number_format($estadoc->gastosadmon+$estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;"><?php echo e($estadoc->total); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;"></span></td>	
				</tr>
			</tbody>
		</table>
	</div>
	<br><br>
	<div><span>Por cada llamada que le empresa realice a su número de contacto después de a ver vencido el contrato se cargan $5.00 por llamada aun cuando esta no fuere correspondida. números de la empresa asignados: Tel: 2300-8288; Cel. 7333-9200</span></div>
	<br>
	<div><span>&nbsp;&nbsp;&nbsp;&nbsp;1. por visita ténica cuando el contrato ya este vencido se cargaran a su cuenta $10.00 aun cuando no sea atendida,</span></div><br>
	<div><span>- su credito vencio el <b><?php echo e($liquidacion->fechadiaria->format('l j')); ?> de <?php echo e($liquidacion->fechadiaria->format('F')); ?> de <?php echo e($liquidacion->fechadiaria->format('Y')); ?></b> de no estar solvente a la fecha de vencimiento. Se cargaran mora por el incumplimiento de 1% diario sobre saldo deudor a la fecha.</span></div>
	<br><br>
	<div align="center"><b><span>Email: afimid@yahoo.com</span></b></div>
</body>
</html>