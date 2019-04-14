<!DOCTYPE html>
<html>
<head>
	<title>Cartera Pago</title>
	<style type="text/css">
		@page{
			margin-top: 1.5mm;
            margin-left: 1.5mm;
            margin-right: 1.5mm;
            margin-bottom: 1.5mm;

		}
        .tds{
            padding: -9px 0px;
        }
		span{
			font-size: 10px;
		}

        .a{
            float: left;
            display: block;
            font-size: 10px;
            
        }

        .b{
            font-size: 10px;
            text-align: right;
            padding: 0px; 
        }


	</style>
</head>
<body>
	<div align=center><b>AFIMID S.A. de C.V.</b></div>
	<div align=center>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($prestamo->fecha->format('d/m/y')); ?></div>

	<table style="border-collapse: collapse;">
		<tbody>
			<tr>
				<th style="width: 92px"><span>NOMBRE:</span></th>
				<td style="width: 230px"><span>&nbsp;<?php echo e(strtoupper($cliente->nombre)); ?> <?php echo e(strtoupper($cliente->apellido)); ?>&nbsp;</td>
				<th style="width: 75px"><span>DUI:</span></th>
				<td style="width: 231px"><span>&nbsp;<?php echo e($cliente->dui); ?>&nbsp;</td>
				<th style="width: 60px"><span>NIT:</span></th>
				<td style="width: 100px"><span>&nbsp;<?php echo e($cliente->nit); ?>&nbsp;</td>
			</tr>
			<tr>
				<th><span>DIRECCION:</span></th>
				<td><span>&nbsp;<?php echo e(strtoupper($cliente->direccion)); ?>&nbsp;</td>
				<th><span>ACTIVIDAD E.:</span></th>
				<td><span>&nbsp;<?php echo e(strtoupper($negocio->actividadeconomica)); ?>&nbsp;</td>
				<th><span>TELEFONO:</span></th>
				<td><span>&nbsp;<?php echo e($cliente->telefonofijo); ?> ; <?php echo e($cliente->telefonocel); ?>&nbsp;</td>
			</tr>
			<tr>
				<th><span>NOMBRE DE NEG.:</span></th>
				<td><span>&nbsp;<?php echo e(strtoupper($negocio->nombre)); ?>&nbsp;</td>
				<td colspan="4"><span><b>DIRECCION DE NEGOCIO:</b>&nbsp;<?php echo e(strtoupper($negocio->direccionnegocio)); ?>&nbsp;</th>
			</tr>
			<tr>
				<td colspan="6"><span>Detalles de pagos de capital e intereses</span></td>
			</tr>
		</tbody>
	</table>

	<table style="border-collapse: collapse;">
		<thead>
			<tr>
				<th style="width: 25px" rowspan="3"> </th>
				<th style="border: 1px solid #333;" rowspan="2" align="center"><span>N</span></th>
				<th style="border: 1px solid #333; width: 65px" rowspan="2" align="center"><span>MONTO</span></th>
				<th style="border: 1px solid #333; width: 65px" align="center"><span>Interés diario</span></th>
				<th style="border: 1px solid #333; width: 65px" rowspan="2" align="center"><span>PAGOS DIARIOS</span></th>
				<th style="width: 65px" rowspan="2"> </th>
				<th style="border: 1px solid #333;" rowspan="3" align="center"><span><?php echo e($tipo_credito->interes*100); ?>%</span></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
			</tr>
			<tr>
				<td style="border: 1px solid #333; height: 10px;" align="center"><span><?php echo e($tipo_credito->interes*100); ?>%</span></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333" align="right"><span><?php echo e($cuenta->numeroprestamo); ?></span></td>
				<td style="border: 1px solid #333" align=""><span>&nbsp;$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($prestamo->monto); ?></span></td>
				<td style="border: 1px solid #333"></td>
				<td style="border: 1px solid #333"></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333;" align="center"><span>DIA</span></td>
				<td style="border: 1px solid #333" align="center"><span>FECHA</span></td>
				<td style="border: 1px solid #333" align="center"><span>MONTO</span></td>
				<td style="border: 1px solid #333" align="center"><span>INTERES DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>CUOTA CAPITAL</span></td>
				<td style="border: 1px solid #333" align="center"><span>TOTAL DIARIO</span></td>
				<td style="border: 1px solid #333" align="center"><span>FIRMA DE<br>COMPROBANTE DE<br>PAGO</span></td>
				<td style="border: 1px solid #333;" align="center"><span>FECHA EFECTIVA DE<br>PAGO</span></td>
				<td style="border: 1px solid #333; width: 120px;" align="center"><span>ABONO</span></td>
			</tr>
		</thead>
		<tbody>
      
      
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
              <td class="tds" style="border: 1px solid #333; background: #ffd740; font-size: 10px;" align="center"><span><?php echo e($ma->contador); ?></span></td>
            <?php else: ?>
              <td class="tds" style="border: 1px solid #333; font-size: 10px;" align="center"><span><?php echo e($ma->contador); ?></span></td>
            <?php endif; ?>

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            <?php if( $ma->fechadiaria != null): ?>
            <td class="tds" style="border: 1px solid #333;" align="right"><span> <?php echo e($ma->fechadiaria->format('l j  F Y ')); ?></span></td>
            <?php else: ?>
            <td class="tds" style="border: 1px solid #333" align="right"><span><?php echo e($ma->fechadiaria); ?></span></td>
            <?php endif; ?>

            <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> <?php echo e($ma->monto); ?>&nbsp;</p>
            </td>

            <?php if( $ma->abonocapital == "NO"): ?>
              <td class="tds" style="border: 1px solid #333; background:#b2ff59;">
                <p class="b"><span class="a">&nbsp;$</span> <?php echo e($ma->interes); ?>&nbsp;</p>
              </td>
            <?php else: ?>
              <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> <?php echo e($ma->interes); ?>&nbsp;</p>
            </td>
            <?php endif; ?>

            <?php if( $ma->abonocapital == "SI"): ?>
              <td class="tds" style="border: 1px solid #333; background: #b2ff59;">
                <p class="b"><span class="a">&nbsp;$</span> <?php echo e($ma->cuotacapital); ?>&nbsp;</p>
            </td>
            <?php else: ?>
              <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> <?php echo e($ma->cuotacapital); ?>&nbsp;</p>
            </td>
            <?php endif; ?>

            <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> <?php echo e($ma->totaldiario); ?>&nbsp;</p>
            </td>

            <td class="tds" style="border: 1px solid #333" align="center"></td>

            <?php if( $ma->fechaefectiva != null): ?>
            <td class="tds" style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechaefectiva->format('l j  F Y ')); ?></span></td>
            <?php else: ?>
            <td class="tds" style="border: 1px solid #333" align="center"><span><?php echo e($ma->fechaefectiva); ?></span></td>
            <?php endif; ?>

            <td class="tds" style="border: 1px solid #333" align="center"><span style="text-align: center; font-size: 10px;"><?php echo e($ma->estado); ?></span></td>

          </tr>
    <?php endforeach; ?>

      <tr class="danger">
        <td class="tds" style="border: 1px solid #333"><span>TOTALES</span></td>
        <td class="tds" style="border: 1px solid #333"></td>
        <td class="tds" style="border: 1px solid #333"></td>
        <td class="tds" style="border: 1px solid #333; text-align: right;"><p class="b"><span class="a">&nbsp;$</span> <?php echo e($sum_interes_diario); ?>&nbsp;</p></td>
        <td class="tds" style="border: 1px solid #333; text-align: right;"><p class="b"><span class="a">&nbsp;$</span> <?php echo e($sum_cuota_capital); ?>&nbsp;</p></td>
        <td class="tds" style="border: 1px solid #333; text-align: right;"><p class="b"><span class="a">&nbsp;$</span> <?php echo e($sum_total_diario); ?>&nbsp;</p></td>
        <td class="tds" style="border: 1px solid #333"></td>
        <td class="tds" style="border: 1px solid #333"></td>
        <td class="tds" style="border: 1px solid #333"></td>
      </tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<th>
					<span>F:&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span>
				</th>
			</tr>
		</tbody>
	</table>
	<table>
		<tbody>
			<tr>
				<th><span>NOMBRE:</span></th>
				<td style="width: 220px"><span>&nbsp;<?php echo e(strtoupper($cliente->nombre)); ?> <?php echo e(strtoupper($cliente->apellido)); ?>&nbsp;</td>
                <td style="width: 125px"></td>
                <td rowspan="4"><span>Firmando me obligo a pagar lo que detalla el documento, según el pagare a favor<br>de: ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD<br>ANÓNIMA DE CAPITAL VARIABLE, y que puede abreviarse AFIMID, S.A. DE C.V. con<br>numero de identificación tributaria cero seiscientos catorce - trescientos un mil<br>diecisiete - ciento tres - cero</td>
			</tr>
			<tr>
				<th><span>DUI:</span></th>
				<td><span>&nbsp;<?php echo e(strtoupper($cliente->dui)); ?>&nbsp;</td>
                <td rowspan="3"><img src="img/log.jpg" width="125px" height="50px"></td>
			</tr>
			<tr>
				<th><span>NIT:</span></th>
				<td><span>&nbsp;<?php echo e(strtoupper($cliente->nit)); ?>&nbsp;</td>
			</tr>
			<tr>
				<th><span>DEUDOR/A&nbsp;&nbsp;</span></th>
				<td></td>
			</tr>
		</tbody>
	</table>
    <br>
    <?php if($codeudor != null): ?>
    <table>
        <tbody>
            <tr>
                <th>
                    <span>F:&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span>
                </th>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <th><span>NOMBRE:</span></th>
                <td style="width: 220px"><span>&nbsp;<?php echo e(strtoupper($codeudor->nombre)); ?> <?php echo e(strtoupper($codeudor->apellido)); ?>&nbsp;</td>
            </tr>
            <tr>
                <th><span>DUI:</span></th>
                <td><span>&nbsp;<?php echo e(strtoupper($codeudor->dui)); ?>&nbsp;</td>
            </tr>
            <tr>
                <th><span>NIT:</span></th>
                <td><span>&nbsp;<?php echo e(strtoupper($codeudor->nit)); ?>&nbsp;</td>
            </tr>
            <tr>
                <th><span>CODEUDOR/A&nbsp;&nbsp;</span></th>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php endif; ?>
</body>
</html>