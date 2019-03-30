<!DOCTYPE html>
<html>
<head>
	<title>Pagare</title>
	<style type="text/css">
		@page{
			margin-top: 20.0mm;
            margin-left: 20.0mm;
            margin-right: 20.0mm;
            margin-bottom: 20.0mm;

		}
		body{
			line-height: 27px;
		}
		span{
			font-size: 13px;
		}
	</style>
</head>
<body>
<span><div style="font-size: 25px" align="center"><b>PAGARE</b></div>
	<div style="font-size: 25px" align="center"><b>"SIN PROTESTO"</b></div>
	<br>
	<table>
		<div align="justify" style="page-break-after: always;">
			Yo, <span><b><?php echo e(strtoupper( $nombre -> nombre)); ?> <?php echo e(strtoupper( $nombre -> apellido )); ?>,</b></span> mayor edad, <?php if($nombre->profesion!=''&&$nombre->profesion!=' '): ?> <?php echo e($nombre->profesion); ?>, <?php endif; ?> del domicilio de <?php echo e($nombre->domicilio); ?>, portador de Documento Único de Identidad número
			
			<?php if(substr($dui, -10, 1)==0): ?>
				cero
				<?php if(substr($dui, -9, 1)==0): ?>
					cero
					<?php if(substr($dui, -8, 1)==0): ?>
						cero
						<?php if(substr($dui, -7, 1)==0): ?>
							cero
							<?php if(substr($dui, -6, 1)==0): ?>
								cero
								<?php if(substr($dui, -5, 1)==0): ?>
									cero
									<?php if(substr($dui, -4, 1)==0): ?>
										cero
										<?php if(substr($dui, -3, 1)==0): ?>
											cero
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(strcmp("UN ",$du1)==0): ?>
				uno
			<?php else: ?>
					<?php echo e(strtolower($du1)); ?>

			<?php endif; ?>
			-
			<?php if(strcmp("UN ",$du2)==0): ?>
				uno
			<?php else: ?>
				<?php if($newdui[1]=="0"): ?>
					cero
				<?php else: ?>
					<?php echo e(strtolower($du2)); ?>

				<?php endif; ?>
			<?php endif; ?>

			, y Número de Identificación Tributaria 
			<?php if(substr($nit, -17, 1)==0): ?>
				cero
				<?php if(substr($nit, -16, 1)==0): ?>
					cero
					<?php if(substr($nit, -15, 1)==0): ?>
						cero
						<?php if(substr($nit, -14, 1)==0): ?>
							cero
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if(strcmp("UN ",$ni1)==0): ?>
				uno
			<?php else: ?>
				<?php echo e(strtolower($ni1)); ?>

			<?php endif; ?>
			-
			<?php if(substr($nit, -12, 1)==0): ?>
				cero
				<?php if(substr($nit, -11, 1)==0): ?>
					cero
					<?php if(substr($nit, -10, 1)==0): ?>
						cero
						<?php if(substr($nit, -9, 1)==0): ?>
							cero
							<?php if(substr($nit, -8, 1)==0): ?>
								cero
								<?php if(substr($nit, -7, 1)==0): ?>
									cero
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if(strcmp("UN ",$ni2)==0): ?>
				uno
			<?php else: ?>
				<?php echo e(strtolower($ni2)); ?>

			<?php endif; ?>
			-
			<?php if(substr($nit, -5, 1)==0): ?>
				cero
				<?php if(substr($nit, -4, 1)==0): ?>
					cero
					<?php if(substr($nit, -3, 1)==0): ?>
						cero
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
			<?php if(strcmp("UN ",$ni3)==0): ?>
				uno
			<?php else: ?>
				<?php echo e(strtolower($ni3)); ?>

			<?php endif; ?>
			-
			<?php if(strcmp("UN ",$ni4)==0): ?>
				uno
			<?php else: ?>
				<?php if($newnit[3]=="0"): ?>
					cero
				<?php else: ?>
					<?php echo e(strtolower($ni4)); ?>

				<?php endif; ?>
			<?php endif; ?>
			,  por este PAGARE, me obligo a pagar incondicionalmente en la ciudad de Tepecoyo, departamento de La Libertad al señor <b>GREGORIO ROSALES PORTILLO,</b> de <?php echo e($edad); ?> años de edad, contador, del domicilio de Tepecoyo, departamento de La Libertad, portador de Documento Único de Identidad número cero dos millones dieciocho mil setecientos setenta y seis - siete y Número de Identificación Tributaria cero  quinientos veintiuno – cero  treinta mil novecientos sesenta y nueve - ciento uno - nueve, actuando en nombre y representación  Sociedad <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b>  con número de identificación tributaria cero seiscientos catorce - trescientos un mil diecisiete - ciento tres - cero; en calidad de Administrador Único Propietario de la Sociedad, por la suma de: <span><b><?php echo e(strtolower($monto)); ?> <?php if($monto=='UN '): ?> DÓLAR <?php else: ?> DÓLARES <?php endif; ?> <?php if($sepa!='00'): ?> con <?php echo e(strtolower($sepa1)); ?> <?php endif; ?>
			<?php if($sepa!='00'): ?>
				centavos de DOLAR
			<?php endif; ?>
			DE LOS ESTADOS UNIDOS DE AMERICA,</b></span> mas interés del
			<?php if(strcmp("UN ",$porcenta1)==0): ?>
				<b>UNO</b>
			<?php else: ?>
				<?php if($porcenta1==""): ?>
					<b>CERO</b>
				<?php else: ?>
					<b><?php echo e($porcenta1); ?></b>
				<?php endif; ?>
			<?php endif; ?>

			<?php if($por==0): ?>
			<?php else: ?>
				<b>PUNTO <?php echo e($porcenta2); ?></b>
			<?php endif; ?>
			<b>POR CIENTO</b> diario sobre saldo deudor, para el plazo de <b><?php echo e($n1); ?></b>días, contando a partir de esta fecha, pagadas por medio de <b><?php echo e($n2); ?></b> cuotas de <b> <?php if($longi==1): ?> <?php echo e($exculet); ?> <?php else: ?> <?php echo e($cuo1); ?> <?php if($cuo1=='UN '): ?> DÓLAR <?php else: ?> DÓLARES <?php endif; ?> CON <?php echo e($cuo2); ?> <?php endif; ?></b>
			<?php if($longi==2): ?>
				<b>CENTAVOS DE</b>
			<?php endif; ?>
			<?php if($exculet=='UN '): ?>
				<b>DÓLAR DE LOS ESTADOS UNIDOS DE AMÉRICA</b> 
			<?php else: ?>
				<?php if($longi==1): ?>
					<b>DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA</b>
				<?php else: ?> 
				 	<b>DÓLAR DE LOS ESTADOS UNIDOS DE AMÉRICA</b>
				 <?php endif; ?>
			<?php endif; ?>

			<?php if($total!=0): ?>
			<b>Y UNA CUOTA DE 

			<?php if($extota1=='UN '): ?>
				UN DÓLAR CON <?php echo e($extota2); ?>

			<?php else: ?>
				<?php if($extota1==""): ?>
					<?php echo e($extota2); ?>

				<?php else: ?> 
				 <?php echo e($extota1); ?> DÓLARES CON <?php echo e($extota2); ?>

				<?php endif; ?>

			<?php endif; ?>

			<?php if($logto==2): ?>
				CENTAVOS DE
			<?php endif; ?>

			<?php if($extoe=='UN '): ?>
				DOLAR DE LOS ESTADOS UNIDOS DE AMÉRICA,
			<?php else: ?>
				DOLAR DE LOS ESTADOS UNIDOS DE AMÉRICA,
			<?php endif; ?>
			</b></span>
			<?php endif; ?>
			en la cuota diaria se paga interés y capital, plazo final el día <b><?php echo e($diaaus); ?> DE <?php echo e(strtoupper($nuevomes)); ?> DE <?php echo e($anius); ?>.</b> En caso de mora, reconoceré un  punto más de interés diario sobre el convenido <b>(1%).</b> El tipo de interés quedara fijo. 
			
			<br><br>
			Para todos los efectos de esta obligación mercantil, fijo como domicilio especial la ciudad de Santa Tecla, departamento de La Libertad, y en caso de acción judicial, renuncio al Derecho de apelar del Decreto de embargo, de la sentencia de remate y de otra providencia apelable, que se dictare en el juicio mercantil ejecutivo o en sus incidencias, siendo a mi cargo cualquier gasto que la empresa <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> de generales antes relacionadas hicieren en el cobro de este PAGARE, inclusive los llamados personales y aún cuando por regla general no hubiere condenación en costas y faculto a <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> Para que designe la persona depositaria de los bienes que se embarguen, a quienes relevo de la obligación de rendir fianza y cuentas. 
		</div>
	</table>
	<?php if($garantiaDeudor != null): ?>
	<?php foreach( $garantiaDeudor as $garantia): ?>

	<p>Dejando en garantia: en caso de vencimiento de pagare sin protesto,o incumplimiento de las condiciones del crédito, los siguientes.</p>

		<TABLE style="width: 100%; border-collapse: collapse;">
			<TR>
				<TD style="width: 13%;"><b> - Descripción:</b></TD>
				<TD style="width: 27%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;<?php echo e($garantia->descripcion); ?></TD>
				<TD style="width: 8%;">&nbsp;&nbsp;<b>Marca:</b></TD>
				<TD style="width: 22%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;<?php echo e($garantia->marca); ?></TD> 
				<TD style="width: 8%;">&nbsp;&nbsp;<b>Serie:</b></TD>
				<TD style="width: 22%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;<?php echo e($garantia->serie); ?></TD> >
			</TR>
		</TABLE>
		<TABLE style="width: 100%; border-collapse: collapse;">
			<TR>
				<TD style="width: 22%; "><b> Otras Especificaciones : </b></TD>
				<TD style="width: 50%; border-bottom: 1px solid #333333;"><?php echo e($garantia->otros); ?></TD>
				<TD style="width: 8%"><b> Valor : </b></TD>
				<TD style="width: 22%;border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;$ <?php echo e($garantia->valor); ?></TD>
			</TR>

		</TABLE>
		<?php endforeach; ?>	
		<?php endif; ?>
	<br>

	<div align="center">En la ciudad de Tepecoyo a los <?php echo e($diahoy); ?> <?php if($diahoy=='UN '): ?> dia <?php else: ?> días <?php endif; ?> del mes de <?php echo e(strtoupper($meshoy)); ?> de <?php echo e($aniohoy); ?>.</div><br>
	<div>CONDICIONES DEL CREDITO:</div>
	<div>1) Sera para inversión de negocio; Compra de Mobiliario y Equipo de trabajo, mercadería. </div>
	<div>2) Por falta de pago de dos cuota autorizo se me asigne un ejecutivo de cobro para que cobre la venta diaria de mi negocio.</div>
	<div>3) Por falta de pago de tres cuotas vencidas acepto el embargo de: Mobiliario, Equipo de Trabajo, Mercadería, Equipo Informático, Electrodomésticos del Hogar.</div>
	<div>4) Que el valuó de lo embargado lo  realicen  mis  acreedor o a quien ellos designen para este caso.</div>
	<div>5) Eximo de toda responsabilidad a mi acreedor por los bienes que me sean embargados quien podrá venderlos para recuperar el crédito que se me otorgo.</div>
	<br>
	<br>
	<br>
	<div>F:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div>
	<div>Deudor: <?php echo e(strtoupper( $nombre -> nombre)); ?> <?php echo e(strtoupper( $nombre -> apellido )); ?></div>
	<div>Documento único de identidad Número: <?php echo e($nombre->dui); ?></div>
	<div>Lugar y fecha de expedición: <?php echo e(strtoupper($nombre->lugarexpedicion)); ?>, <?php echo e($fechaex); ?></div>
	<div>Número de Identificación Tributaria: <?php echo e($nombre->nit); ?></div></span>

</body>
</html>