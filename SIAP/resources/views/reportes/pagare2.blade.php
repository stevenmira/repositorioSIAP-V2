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
<span>
	<div style="font-size: 25px" align="center"><b>PAGARE</b></div>
	<div style="font-size: 25px" align="center"><b>"SIN PROTESTO"</b></div>
	<br>
	<table>
		<div align="justify" style="page-break-after: always;">
			Yo, <span><b>{{strtoupper( $nombre -> nombre)}} {{strtoupper( $nombre -> apellido )}} Y {{strtoupper( $codeudor -> nombre)}} {{strtoupper( $codeudor -> apellido )}} </b></span>, el/la primero/a <b> mayor de Edad</b>, @if($nombre->profesion!=''&&$nombre->profesion!=' ') {{$nombre->profesion}}, @endif del domicilio de {{$nombre->domicilio}}, portador de Documento Único de Identidad número
			
			@if(substr($dui, -10, 1)==0)
				cero
				@if(substr($dui, -9, 1)==0)
					cero
					@if(substr($dui, -8, 1)==0)
						cero
						@if(substr($dui, -7, 1)==0)
							cero
							@if(substr($dui, -6, 1)==0)
								cero
								@if(substr($dui, -5, 1)==0)
									cero
									@if(substr($dui, -4, 1)==0)
										cero
										@if(substr($dui, -3, 1)==0)
											cero
										@endif
									@endif
								@endif
							@endif
						@endif
					@endif
				@endif
			@endif
			
			@if(strcmp("UN ",$du1)==0)
				uno
			@else
					{{strtolower($du1)}}
			@endif
			-
			@if(strcmp("UN ",$du2)==0)
				uno
			@else
				@if($newdui[1]=="0")
					cero
				@else
					{{strtolower($du2)}}
				@endif
			@endif

			, y Número de Identificación Tributaria 
			@if(substr($nit, -17, 1)==0)
				cero
				@if(substr($nit, -16, 1)==0)
					cero
					@if(substr($nit, -15, 1)==0)
						cero
						@if(substr($nit, -14, 1)==0)
							cero
						@endif
					@endif
				@endif
			@endif

			@if(strcmp("UN ",$ni1)==0)
				uno
			@else
				{{strtolower($ni1)}}
			@endif
			-
			@if(substr($nit, -12, 1)==0)
				cero
				@if(substr($nit, -11, 1)==0)
					cero
					@if(substr($nit, -10, 1)==0)
						cero
						@if(substr($nit, -9, 1)==0)
							cero
							@if(substr($nit, -8, 1)==0)
								cero
								@if(substr($nit, -7, 1)==0)
									cero
								@endif
							@endif
						@endif
					@endif
				@endif
			@endif

			@if(strcmp("UN ",$ni2)==0)
				uno
			@else
				{{strtolower($ni2)}}
			@endif
			-
			@if(substr($nit, -5, 1)==0)
				cero
				@if(substr($nit, -4, 1)==0)
					cero
					@if(substr($nit, -3, 1)==0)
						cero
					@endif
				@endif
			@endif
			@if(strcmp("UN ",$ni3)==0)
				uno
			@else
				{{strtolower($ni3)}}
			@endif
			-
			@if(strcmp("UN ",$ni4)==0)
				uno
			@else
				@if($newnit[3]=="0")
					cero
				@else
					{{strtolower($ni4)}}
				@endif
			@endif
			,el/la segundo/a <b> mayor de Edad</b>,  @if($codeudor->profesion!=''&&$codeudor->profesion!=' ') {{$codeudor->profesion}}, @endif del domicilio de {{$codeudor->domicilio}}, portador de Documento Único de Identidad número
			
			@if(substr($duic, -10, 1)==0)
				cero
				@if(substr($duic, -9, 1)==0)
					cero
					@if(substr($duic, -8, 1)==0)
						cero
						@if(substr($duic, -7, 1)==0)
							cero
							@if(substr($duic, -6, 1)==0)
								cero
								@if(substr($duic, -5, 1)==0)
									cero
									@if(substr($duic, -4, 1)==0)
										cero
										@if(substr($duic, -3, 1)==0)
											cero
										@endif
									@endif
								@endif
							@endif
						@endif
					@endif
				@endif
			@endif
			
			@if(strcmp("UN ",$du1c)==0)
				uno
			@else
					{{strtolower($du1c)}}
			@endif
			-
			@if(strcmp("UN ",$du2c)==0)
				uno
			@else
				@if($newduic[1]=="0")
					cero
				@else
					{{strtolower($du2c)}}
				@endif
			@endif

			, y Número de Identificación Tributaria 
			@if(substr($nitc, -17, 1)==0)
				cero
				@if(substr($nitc, -16, 1)==0)
					cero
					@if(substr($nitc, -15, 1)==0)
						cero
						@if(substr($nitc, -14, 1)==0)
							cero
						@endif
					@endif
				@endif
			@endif

			@if(strcmp("UN ",$ni1c)==0)
				uno
			@else
				{{strtolower($ni1c)}}
			@endif
			-
			@if(substr($nitc, -12, 1)==0)
				cero
				@if(substr($nitc, -11, 1)==0)
					cero
					@if(substr($nitc, -10, 1)==0)
						cero
						@if(substr($nitc, -9, 1)==0)
							cero
							@if(substr($nitc, -8, 1)==0)
								cero
								@if(substr($nitc, -7, 1)==0)
									cero
								@endif
							@endif
						@endif
					@endif
				@endif
			@endif

			@if(strcmp("UN ",$ni2c)==0)
				uno
			@else
				{{strtolower($ni2c)}}
			@endif
			-
			@if(substr($nitc, -5, 1)==0)
				cero
				@if(substr($nitc, -4, 1)==0)
					cero
					@if(substr($nitc, -3, 1)==0)
						cero
					@endif
				@endif
			@endif
			@if(strcmp("UN ",$ni3c)==0)
				uno
			@else
				{{strtolower($ni3c)}}
			@endif
			-
			@if(strcmp("UN ",$ni4c)==0)
				uno
			@else
				@if($newnitc[3]=="0")
					cero
				@else
					{{strtolower($ni4c)}}
				@endif
			@endif

			, por este PAGARE, me obligo a pagar incondicionalmente en la ciudad de Tepecoyo, departamento de La Libertad al señor <b>GREGORIO ROSALES PORTILLO,</b> de {{$edad}} años de edad, contador, del domicilio de Tepecoyo, departamento de La Libertad, portador de Documento Único de Identidad número cero dos millones dieciocho mil setecientos setenta y seis - siete y Número de Identificación Tributaria cero  quinientos veintiuno – cero  treinta mil novecientos sesenta y nueve - ciento uno - nueve, actuando en nombre y representación  Sociedad <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b>  con número de identificación tributaria cero seiscientos catorce - trescientos un mil diecisiete - ciento tres - cero; en calidad de Administrador Único Propietario de la Sociedad, por la suma de: <span><b>{{strtolower($monto)}} @if($monto=='UN ') DÓLAR @else DÓLARES @endif @if($sepa!='00') con {{strtolower($sepa1)}} @endif
			@if($sepa!='00')
				centavos de DOLAR
			@endif
			DE LOS ESTADOS UNIDOS DE AMERICA,</b></span> mas interés del
			@if(strcmp("UN ",$porcenta1)==0)
				<b>UNO</b>
			@else
				@if($porcenta1=="")
					<b>CERO</b>
				@else
					<b>{{$porcenta1}}</b>
				@endif
			@endif

			@if($por==0)
			@else
				<b>PUNTO {{$porcenta2}}</b>
			@endif
			<b>POR CIENTO</b> diario sobre saldo deudor, para el plazo de <b>{{$n1}}</b>días, contando a partir de esta fecha, pagadas por medio de <b>{{$n2}}</b> cuotas de <b> @if($longi==1) {{$exculet}} @else {{$cuo1}} @if($cuo1=='UN ') DÓLAR @else DÓLARES @endif CON {{$cuo2}} @endif</b>
			@if($longi==2)
				<b>CENTAVOS DE</b>
			@endif
			@if($exculet=='UN ')
				<b>DÓLAR DE LOS ESTADOS UNIDOS DE AMÉRICA</b> 
			@else
				@if($longi==1)
					<b>DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA</b>
				@else 
				 	<b>DÓLAR DE LOS ESTADOS UNIDOS DE AMÉRICA</b>
				 @endif
			@endif

			@if($total!=0)
			<b>Y UNA CUOTA DE 

			@if($extota1=='UN ')
				UN DÓLAR CON {{$extota2}}
			@else
				@if($extota1=="")
					{{$extota2}}
				@else 
				 {{$extota1}} DÓLARES CON {{$extota2}}
				@endif

			@endif

			@if($logto==2)
				CENTAVOS DE
			@endif

			@if($extoe=='UN ')
				DOLAR DE LOS ESTADOS UNIDOS DE AMÉRICA,
			@else
				DOLAR DE LOS ESTADOS UNIDOS DE AMÉRICA,
			@endif
			</b></span>
			@endif
			en la cuota diaria se paga interés y capital, plazo final el día <b>{{$diaaus}} DE {{strtoupper($nuevomes)}} DE {{$anius}}.</b> En caso de mora, reconoceré un  punto más de interés diario sobre el convenido <b>(1%).</b> El tipo de interés quedara fijo. 
			<br>
			<br>
			Para todos los efectos de esta obligación mercantil, fijo como domicilio especial la ciudad de Santa Tecla, departamento de La Libertad, y en caso de acción judicial, renuncio al Derecho de apelar del Decreto de embargo, de la sentencia de remate y de otra providencia apelable, que se dictare en el juicio mercantil ejecutivo o en sus incidencias, siendo a mi cargo cualquier gasto que la empresa <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> de generales antes relacionadas hicieren en el cobro de este PAGARE, inclusive los llamados personales y aún cuando por regla general no hubiere condenación en costas y faculto a <b>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE,</b> y que puede abreviarse <b>AFIMID, S.A. DE C.V.</b> Para que designe la persona depositaria de los bienes que se embarguen, a quienes relevo de la obligación de rendir fianza y cuentas. 
			<BR>
			@if($garantiaDeudor != null)
			@if(count($garantiaDeudor) > 0 || count($garantiaCodeudor) > 0)
				
				Dejando en garantia: en caso de vencimiento de pagare sin protesto,o incumplimiento de las condiciones del crédito, los siguientes.
			@endif
				@foreach( $garantiaDeudor as $garantia)
					<TABLE style="width: 100%; border-collapse: collapse;">
						<TR>
							<TD style="width: 13%;"><b> - Descripción:</b></TD>
							<TD style="width: 27%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;{{$garantia->descripcion}}</TD>
							<TD style="width: 8%;">&nbsp;&nbsp;<b>Marca:</b></TD>
							<TD style="width: 22%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;{{$garantia->marca}}</TD> 
							<TD style="width: 8%;">&nbsp;&nbsp;<b>Serie:</b></TD>
							<TD style="width: 22%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;{{$garantia->serie}}</TD> >
						</TR>
					</TABLE>
					<TABLE style="width: 100%; border-collapse: collapse;">
							<TR>
								<TD style="width: 22%; "><b> Otras Especificaciones : </b></TD>
								<TD style="width: 50%; border-bottom: 1px solid #333333;">{{$garantia->otros}}</TD>
								<TD style="width: 8%"><b> Valor : </b></TD>
								<TD style="width: 22%;border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;$ {{$garantia->valor}}</TD>
							</TR>

					</TABLE>
				@endforeach	
			@endif
			@if($garantiaCodeudor !=null)
				@if(count($garantiaCodeudor) > 0)
				<br>
				GARANTIAS CODEUDOR
				@endif
				@foreach( $garantiaCodeudor as $garantia)
					<TABLE style="width: 100%; border-collapse: collapse;">
							<TR>
								<TD style="width: 13%;"><b> - Descripción:</b></TD>
								<TD style="width: 27%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;{{$garantia->descripcion}}</TD>
								<TD style="width: 8%;">&nbsp;&nbsp;<b>Marca:</b></TD>
								<TD style="width: 22%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;{{$garantia->marca}}</TD> 
								<TD style="width: 8%;">&nbsp;&nbsp;<b>Serie:</b></TD>
								<TD style="width: 22%; border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;{{$garantia->serie}}</TD> >
							</TR>
					</TABLE>
					<TABLE style="width: 100%; border-collapse: collapse;">
								<TR>
									<TD style="width: 22%; "><b> Otras Especificaciones : </b></TD>
									<TD style="width: 50%; border-bottom: 1px solid #333333;">{{$garantia->otros}}</TD>
									<TD style="width: 8%"><b> Valor : </b></TD>
									<TD style="width: 22%;border-bottom: 1px solid #333333;">&nbsp;&nbsp;&nbsp;$ {{$garantia->valor}}</TD>
								</TR>

					</TABLE>
				@endforeach	
			@endif
			<br>
		<div align="center">En la ciudad de Tepecoyo a los {{$diafech}} @if($diafech=='UN ') dia @else días @endif del mes de {{strtoupper($mesfech)}} de {{$aniopre}}.</div><br>
		<div>CONDICIONES DEL CREDITO:</div>
		<div>1) Sera para inversión de negocio; Compra de Mobiliario y Equipo de trabajo, mercadería. </div>
		<div>2) Por falta de pago de dos cuota autorizo se me asigne un ejecutivo de cobro para que cobre la venta diaria de mi negocio.</div>
		<div>3) Por falta de pago de tres cuotas vencidas acepto el embargo de: Mobiliario, Equipo de Trabajo, Mercadería, Equipo Informático, Electrodomésticos del Hogar.</div>
		<div>4) Que el valuó de lo embargado lo  realicen  mis  acreedor o a quien ellos designen para este caso.</div>
		<div>5) Eximo de toda responsabilidad a mi acreedor por los bienes que me sean embargados quien podrá venderlos para recuperar el crédito que se me otorgo.</div>
		<br>
	<div>
		<table align="center" style="width: 100%;padding: 0px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width: 50%;">F:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
				<td><div>F:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
			</tr>
			<tr style="margin: 0px; border: 1px solid #ff00ff; padding: 0px;">
				<td><div>Deudor: {{strtoupper( $nombre -> nombre)}} {{strtoupper( $nombre -> apellido )}}</div> </td>
				<td><div>Codeudor: {{strtoupper( $codeudor -> nombre)}} {{strtoupper( $codeudor -> apellido )}}</div></td>
			</tr>
			<tr style="margin: 0px; border: 1px solid #ff00ff; padding: 0px;">
				<td><div>Documento único de identidad Número: {{$nombre->dui}}</div> </td>
				<td><div>Documento único de identidad Número: {{$codeudor->dui}}</div></td>
			</tr>

			<tr style="margin: 0px; border: 1px solid #ff00ff; padding: 0px;">
				<td> <div>Lugar y fecha de expedición: {{strtoupper($nombre->lugarexpedicion)}}, {{$fechaex}}</div></td>
				<td><div>Lugar y fecha de expedición: {{strtoupper($codeudor->lugarexpedicion)}}, {{$fechaex}}</div></td>
			</tr>
			<tr style="margin: 0px; border: 1px solid #ff00ff; padding: 0px;">
				<td> <div>Número de Identificación Tributaria: {{$nombre->nit}}</div></td>
				<td><div>Número de Identificación Tributaria: {{$codeudor->nit}}</div></td>
			</tr>

		</table>
	</div>
</table>
	<br>
</span>
</body>
</html>