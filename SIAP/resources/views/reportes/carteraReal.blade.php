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
	<div align=center>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$prestamo->fecha->format('d/m/y')}}</div>

	<table style="border-collapse: collapse;">
		<tbody>
			<tr>
				<th style="width: 92px"><span>NOMBRE:</span></th>
				<td style="width: 230px"><span>&nbsp;{{strtoupper($cliente->nombre)}} {{strtoupper($cliente->apellido)}}&nbsp;</td>
				<th style="width: 75px"><span>DUI:</span></th>
				<td style="width: 231px"><span>&nbsp;{{$cliente->dui}}&nbsp;</td>
				<th style="width: 60px"><span>NIT:</span></th>
				<td style="width: 100px"><span>&nbsp;{{$cliente->nit}}&nbsp;</td>
			</tr>
			<tr>
				<th><span>DIRECCION:</span></th>
				<td><span>&nbsp;{{strtoupper($cliente->direccion)}}&nbsp;</td>
				<th><span>ACTIVIDAD E.:</span></th>
				<td><span>&nbsp;{{strtoupper($negocio->actividadeconomica)}}&nbsp;</td>
				<th><span>TELEFONO:</span></th>
				<td><span>&nbsp;{{$cliente->telefonofijo}} ; {{$cliente->telefonocel}}&nbsp;</td>
			</tr>
			<tr>
				<th><span>NOMBRE DE NEG.:</span></th>
				<td><span>&nbsp;{{strtoupper($negocio->nombre)}}&nbsp;</td>
				<td colspan="4"><span><b>DIRECCION DE NEGOCIO:</b>&nbsp;{{strtoupper($negocio->direccionnegocio)}}&nbsp;</th>
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
				<th style="border: 1px solid #333;" rowspan="3" align="center"><span>{{$tipo_credito->interes*100}}%</span></th>
				<th rowspan="2"></th>
				<th rowspan="2"></th>
			</tr>
			<tr>
				<td style="border: 1px solid #333; height: 10px;" align="center"><span>{{$tipo_credito->interes*100}}%</span></td>
			</tr>
			<tr>
				<td style="border: 1px solid #333" align="right"><span>{{$cuenta->numeroprestamo}}</span></td>
				<td style="border: 1px solid #333" align=""><span>&nbsp;$ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$prestamo->monto}}</span></td>
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
      
      
    @foreach ($liquidaciones as $ma) 
        @if($ma->estado == 'CANCELADO')
          <tr style="background: #ccff90;">
        @elseif($ma->estado == 'CANCELADO CON REF.')
          <tr style="background: #e6ee9c;">
        @elseif($ma->estado == 'ATRASO')
          <tr style="background: #ffcdd2;">
        @elseif($ma->estado == 'ABONO')
          <tr style="background: #fff59d;">
        @elseif($ma->estado == 'NO VALIDO')
          <tr style="background: #eeeeee;">
        @else
          <tr>
        @endif
            @if($ma->fechadiaria->format('Y-m-d') == $fecha_actual->format('Y-m-d'))
              <td class="tds" style="border: 1px solid #333; background: #ffd740; font-size: 10px;" align="center"><span>{{ $ma->contador}}</span></td>
            @else
              <td class="tds" style="border: 1px solid #333; font-size: 10px;" align="center"><span>{{ $ma->contador}}</span></td>
            @endif

            <!-- Pasamos la fecha a español con Jenssegers -->
            
            @if( $ma->fechadiaria != null)
            <td class="tds" style="border: 1px solid #333;" align="right"><span> {{ $ma->fechadiaria->format('l j  F Y ') }}</span></td>
            @else
            <td class="tds" style="border: 1px solid #333" align="right"><span>{{ $ma->fechadiaria }}</span></td>
            @endif

            <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> {{ $ma->monto }}&nbsp;</p>
            </td>

            @if( $ma->abonocapital == "NO")
              <td class="tds" style="border: 1px solid #333; background:#b2ff59;">
                <p class="b"><span class="a">&nbsp;$</span> {{ $ma->interes }}&nbsp;</p>
              </td>
            @else
              <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> {{ $ma->interes }}&nbsp;</p>
            </td>
            @endif

            @if( $ma->abonocapital == "SI")
              <td class="tds" style="border: 1px solid #333; background: #b2ff59;">
                <p class="b"><span class="a">&nbsp;$</span> {{ $ma->cuotacapital }}&nbsp;</p>
            </td>
            @else
              <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> {{ $ma->cuotacapital }}&nbsp;</p>
            </td>
            @endif

            <td class="tds" style="border: 1px solid #333;">
                <p class="b"><span class="a">&nbsp;$</span> {{ $ma->totaldiario }}&nbsp;</p>
            </td>

            <td class="tds" style="border: 1px solid #333" align="center"></td>

            @if( $ma->fechaefectiva != null)
            <td class="tds" style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva->format('l j  F Y ') }}</span></td>
            @else
            <td class="tds" style="border: 1px solid #333" align="center"><span>{{ $ma->fechaefectiva }}</span></td>
            @endif

            <td class="tds" style="border: 1px solid #333" align="center"><span style="text-align: center; font-size: 10px;">{{ $ma->estado }}</span></td>

          </tr>
    @endforeach

      <tr class="danger">
        <td class="tds" style="border: 1px solid #333"><span>TOTALES</span></td>
        <td class="tds" style="border: 1px solid #333"></td>
        <td class="tds" style="border: 1px solid #333"></td>
        <td class="tds" style="border: 1px solid #333; text-align: right;"><p class="b"><span class="a">&nbsp;$</span> {{ $sum_interes_diario }}&nbsp;</p></td>
        <td class="tds" style="border: 1px solid #333; text-align: right;"><p class="b"><span class="a">&nbsp;$</span> {{ $sum_cuota_capital }}&nbsp;</p></td>
        <td class="tds" style="border: 1px solid #333; text-align: right;"><p class="b"><span class="a">&nbsp;$</span> {{ $sum_total_diario }}&nbsp;</p></td>
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
				<td style="width: 220px"><span>&nbsp;{{strtoupper($cliente->nombre)}} {{strtoupper($cliente->apellido)}}&nbsp;</td>
                <td style="width: 125px"></td>
                <td rowspan="4"><span>Firmando me obligo a pagar lo que detalla el documento, según el pagare a favor<br>de: ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS SOCIEDAD<br>ANÓNIMA DE CAPITAL VARIABLE, y que puede abreviarse AFIMID, S.A. DE C.V. con<br>numero de identificación tributaria cero seiscientos catorce - trescientos un mil<br>diecisiete - ciento tres - cero</td>
			</tr>
			<tr>
				<th><span>DUI:</span></th>
				<td><span>&nbsp;{{strtoupper($cliente->dui)}}&nbsp;</td>
                <td rowspan="3"><img src="img/log.jpg" width="125px" height="50px"></td>
			</tr>
			<tr>
				<th><span>NIT:</span></th>
				<td><span>&nbsp;{{strtoupper($cliente->nit)}}&nbsp;</td>
			</tr>
			<tr>
				<th><span>DEUDOR/A&nbsp;&nbsp;</span></th>
				<td></td>
			</tr>
		</tbody>
	</table>
    <br>
    @if($codeudor != null)
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
                <td style="width: 220px"><span>&nbsp;{{strtoupper($codeudor->nombre)}} {{strtoupper($codeudor->apellido)}}&nbsp;</td>
            </tr>
            <tr>
                <th><span>DUI:</span></th>
                <td><span>&nbsp;{{strtoupper($codeudor->dui)}}&nbsp;</td>
            </tr>
            <tr>
                <th><span>NIT:</span></th>
                <td><span>&nbsp;{{strtoupper($codeudor->nit)}}&nbsp;</td>
            </tr>
            <tr>
                <th><span>CODEUDOR/A&nbsp;&nbsp;</span></th>
                <td></td>
            </tr>
        </tbody>
    </table>
    @endif
</body>
</html>