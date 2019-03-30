<!DOCTYPE html>
<html>
<head>
	<title>Desembolso</title>
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
	  <p align="right">{{ $prestamo->fecha->format('d/m/Y') }}</p>
	  <p>Detalle de desembolso aprobado</p>
	</div>

	<br>

	<div class="padd">
	  <table  style="width: 100%; border-collapse: collapse;">
	    <thead>
		    <tr>
				<th style="border: 1px solid #333; text-align: center; width: 5%">N</th>
				<th style="border: 1px solid #333; text-align: center; width: 50%">MONTO</th>
				<th style="border: 0px solid #fff; width: 20%;"></th>
				@if($prestamo->idtipodesembolso == 1)
				<th style="border: 1px solid #333; width: 30%; text-align: center;">EFECTIVO</th>
				@else
				<th style="border: 1px solid #333; width: 30%; text-align: center;">CHEQUE</th>
				@endif
		    </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td style="border: 1px solid #333" align="right">{{$cuenta->numeroprestamo}}</td>
	        <td style="border: 1px solid #333; text-align: right;">
	        	<span style="display: block; float: left;" >$ </span> 
	        	<span style="display: block; float: right">{{ number_format($desembolso, 2) }}</span> 
	        </td>
	        <td style="border: 0px solid #fff;"></td>
	        @if($prestamo->idtipodesembolso == 2)
	          <td style="border: 1px solid #333; text-align: center;">{{$prestamo->numerocheque}} </td>
	        @else
	        	<td></td>
	        @endif
	      </tr>
	    </tbody>
	  </table>
	</div>

	<br><br><br><br>
	<div class="padd">
	  <table style="width: 100%; border-collapse: collapse;">
	  	<tr>
			<td style="width: 70%;"><b>Desembolso</b></td>
			<td style="font-weight: bold;">
				$ 
				<span class="spn">{{ number_format($desembolso, 2) }}</span>
			</td>
		</tr>
		<tr>
			<td>( - Desc. De $4.50 de cada $100.00 por desembolso)</td>
			<td>
				$ 
				<span class="spn">{{ number_format($comision, 2) }}</span>
			</td>
		</tr>
		<tr>
			@if($cuotas > 1)
			<td>( - Desc. de cuotas atrasadas  ( {{ $cuotas }} ) )</td>
			@else
			<td>( - Desc. de cuotas  ( {{ $cuotas }} ) )</td>
			@endif
			<td>
				$ 
				<span class="spn">{{ number_format($totalCuota, 2) }}</span>
			</td>
		</tr>
		<tr>
			<td>( - Desc. de mora por incumplimiento )</td>
			<td>
				$ 
				<span class="spn">{{ number_format($mora, 2) }}</span>
			</td>
		</tr>
		<tr>
			<td>( - Saldo capital de credito anterior)</td>
			<td>
				$ 	
				<span class="spn">{{ number_format($saldoCapitalAnterior, 2) }}</span>
					
			</td>
		</tr>
		<tr>
	      	<td></td>
	      	<td>
				<p style="padding: -30px 110px -10px 0px;">___________</p>	
			</td>
	    </tr>
	    <tr>
	      <td>EFECTIVO A RECIBIR</td>
	      <td>
				$ 	
				<span class="spn">{{ number_format($total, 2) }}</span>	
			</td>
	    </tr>
	  </table>
	</div>

	<br><br><br>
	<div class="padd2" style="width: 100%;">
		<aside style="width: 50%; float: left;">
			<table style="width: 100%" cellpadding="0" cellspacing="0">
			  <tr>
			    <td colspan="2">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
			  </tr>
			</table>
			<table style="width: 100%" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="width: 23%;">NOMBRE:</td>
			    <td>{{ $cliente->nombre}} {{ $cliente->apellido }}</td>
			  </tr>
			  <tr>
			    <td>DUI: </td>
			    <td>{{ $cliente->dui }}</td>
			  </tr>
			  <tr>
			    <td>NIT: </td>
			    <td>{{ $cliente->nit }}</td>
			  </tr>
			</table>
			<table style="width: 100%"  cellpadding="0" cellspacing="0">
			  <tr>
			    <td colspan="2">DEUDOR/A RECIBI CONFORME</td>
			  </tr>
			</table>
		</aside>
	  @if($codeudor != null)
	  	<aside style="width: 50%; float: right;">
			<table style="width: 100%" cellpadding="0" cellspacing="0">
			  <tr>
			    <td colspan="2">F: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
			  </tr>
			</table>
			<table style="width: 100%" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="width: 23%;">NOMBRE:</td>
			    <td>{{ $codeudor->nombre }} {{ $codeudor->apellido }}</td>
			  </tr>
			  <tr>
			    <td>DUI: </td>
			    <td>{{ $codeudor->dui }}</td>
			  </tr>
			  <tr>
			    <td>NIT: </td>
			    <td>{{ $codeudor->nit }}</td>
			  </tr>
			</table>
			<table style="width: 100%"  cellpadding="0" cellspacing="0">
			  <tr>
			    <td colspan="2">CODEUDOR/A RECIBI CONFORME</td>
			  </tr>
			</table>
	  	</aside>
	  @endif
	</div>
</body>
</html>