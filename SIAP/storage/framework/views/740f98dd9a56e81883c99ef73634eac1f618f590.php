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
	<br>
	<div><span>DEPARTAMENTO DE COBRO</span></div>
	<br>
	<br>
	<div align="center" style="width: 100%"><span>ESTADO DE CUENTA</span></div>
	<br>
	<div><span>DETALLE DE DEUDA</span></div>
	<br>
	<div>
		<table align="center" style="border-collapse: collapse; width: 99%;" >
			<thead>
				<tr>
					<th style="border: 1px solid #333; width: 30px; height: 20px;" align="center" valign="bottom" rowspan="2"><span style="font-size: 9px;">N</span></th>
					<th style="border: 1px solid #333; width: 200px;" align="center" valign="bottom" rowspan="2"><span style="font-size: 10px;">FECHAS</span></th>
					<th style="border: 1px solid #333" align="center" valign="bottom" rowspan="2"><span style="font-size: 10px;">DIAS</span></th>
					<th style="border: 1px solid #333" align="center" valign="bottom" colspan="2"><span style="font-size: 10px;">DETALLES</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">SALDO CAPITAL SIN<br>INTERESES</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">COBRO POR GESTION<br>COBRO</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">COBROS DE<br>ADMINISTRACION</span></th>
					<th style="border: 1px solid #333" align="center" rowspan="2" colspan="2"><span style="font-size: 10px;">TOTAL</span></th>
				</tr>
				<tr>
					<th style="border: 1px solid #333" align="center" valign="bottom" colspan="2"><span style="font-size: 10px;">CUOTA DIARIA<br>$&nbsp;&nbsp; <?php echo e($prestamo->cuotadiaria); ?></span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 12px;">1</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Cuotas atrasadas <b><?php echo e($estadoc->diasatrasados); ?></b> de $ <?php echo e($prestamo->cuotadiaria); ?></span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"><?php echo e($estadoc->diasatrasados); ?></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->totalcuotas,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->totalcuotas,2)); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 12px;">2</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Saldo capital sin intereses</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px";><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->montoactual,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->montoactual,2)); ?>&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px" align="center"><span style="font-size: 12px;">3</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Gastos por Gestión Cobro</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>					
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px; " align="center"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?></span></td>
				</tr>
				<tr>
					<td style="border: 1px solid #333; height: 30px" align="center"><span style="font-size: 12px;">4</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">Gastos de Administracion por Notificacion</span></td>
					<td style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 12px;"></span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;</span></td>
					<td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></td>
					<td style="border: 1px solid #333; border-left: 0px; " align="center"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?></span></td>
				</tr>
				<tr>
					<th style="border: 1px solid #333; height: 30px" align="center" colspan="2"><span style="font-size: 12px;">TOTAL</span></th>
					<th style="border: 1px solid #333" align="center"><span style="font-size: 12px;"></span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->totalcuotas,2)); ?>&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->montoactual,2)); ?>&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosadmon,2)); ?>&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->gastosnotariales,2)); ?>&nbsp;&nbsp;</span></th>
					<th style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 12px;">&nbsp;&nbsp;$</span></th>
					<th style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 12px;"><?php echo e(number_format($estadoc->total,2)); ?></span></th>
				</tr>
			</tbody>
		</table>
	</div>
	<br><br>
	<div><span>Por cada llamada que le empresa realice a su número de contacto después de a ver vencido el contrato se cargan $5.00 por llamada aun cuando esta no fuere correspondida. números de la empresa asignados: Tel: 2300-8288; Cel. 7333-9200</span></div>
	<br>
	<div><span>&nbsp;&nbsp;&nbsp;&nbsp;1. por visita ténica cuando el contrato ya este vencido se cargaran a su cuenta $10.00 aun cuando no sea atendida,</span></div><br>
	<div><span>- su credito vence el <b><?php echo e($liquidacion->fechadiaria->format('l j')); ?> de <?php echo e($liquidacion->fechadiaria->format('F')); ?> de <?php echo e($liquidacion->fechadiaria->format('Y')); ?></b> de no estar solvente a la fecha de vencimiento. Se cargaran mora por el incumplimiento de 1% diario sobre saldo deudor a la fecha.</span></div>
	<br><br><br><br><br><br>
	<div align="center"><b><span>Email: afimid@yahoo.com</span></b></div>
</body>
</html>