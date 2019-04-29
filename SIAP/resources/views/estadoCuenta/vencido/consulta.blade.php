@extends ('layouts.inicio')
@section('contenido')

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('RecordClienteController@index')}}"> Récord Cliente</a></li>
    <li><a href="{{URL::action('CuentaController@show',$cliente->idcuenta)}}"> Cuenta</a></li>
    <li><a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}"> Estados de Cuentas</a></li>
    <li class="active">Ver</li>
  </ol>
</section>
<br>

<div style="padding: 10px 100px;">
    <div>
    <table>
      <tr>
        <td style="width: 500px;">
          <img src="{{asset('img/log.jpg')}}" width="180px" height="70px">
        </td>
        <td valign="bottom">
          <span>{{$diahoy}} DE {{strtoupper($meshoy)}} DE {{$aniohoy}}</span>
        </td>
      </tr>
    </table>
  </div>
  <br>
  <div><span>CLIENTE: &nbsp;&nbsp;{{strtoupper($cliente->nombre)}} {{strtoupper($cliente->apellido)}}</span></div>
  <div><span>NEGOCIO: &nbsp;&nbsp;{{strtoupper($cliente->nombreNegocio)}} </span></div>
  <div><span>DUI: &nbsp;&nbsp;{{$cliente->dui}}</span></div>
  <div><span>NIT: &nbsp;&nbsp;{{$cliente->nit}}</span></div>
  <div><span>DIRECCION: &nbsp;&nbsp;{{strtoupper($cliente->direccion)}}</span></div>
  <div><span>TELEFONO: &nbsp;&nbsp;{{$cliente->telefonocel}}</span></div>
  <br>
  <div><span>DEPARTAMENTO DE COBRO</span></div>
  
  <div align="center" style="width: 100%"><span>ESTADO DE CUENTA VENCIDA</span></div>
  <br>
  <div><span>DETALLE DE DEUDA</span></div>
  <br>
  <div>
    <table align="center" style="border-collapse: collapse; width: 99%;" >
      <thead>
        <tr>
          <th style="border: 1px solid #333; width: 30px; height: 20px; text-align: center;"rowspan="2"><span style="font-size: 9px;">N</span></th>
          <th style="border: 1px solid #333; width: 200px; text-align: center;" rowspan="2"><span style="font-size: 9px;">DESCRIPCIÓN</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2"><span style="font-size: 10px;">DIAS</span></th>
          <th style="border: 1px solid #333; text-align: center;" colspan="2"><span style="font-size: 10px;">DETALLES</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2" colspan="2"><span style="font-size: 10px;">MORA POR RETRASO/<br>O<br>INCUMPLIMIENTO</span></th>
          <th style="border: 1px solid #333;text-align: center;" rowspan="2" colspan="2"><span style="font-size: 10px;">COBROS DE<br>ADMINISTRACION<br></span></th>
          <th style="border: 1px solid #333; text-align: center;"rowspan="2" colspan="2"><span style="font-size: 10px;">TOTAL</span></th>
          <th style="border: 1px solid #333; text-align: center;" rowspan="2"><span style="font-size: 10px;">DETALLE</span></th>
        </tr>
        <tr>
          <th style="border: 1px solid #333; text-align: center;" colspan="2"><span style="font-size: 10px;">CUOTA DIARIA<br>$&nbsp;{{$cliente->cuotadiaria}}</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 11px;">1</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">SALDO PENDIENTE DE {{$estadoc->diaspendientes}} CUOTA DE {{$estadoc->totalpendiente}} </span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">{{$estadoc->diaspendientes}}</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->totalpendiente,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->totalpendiente,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">CUOTAS<br>VENCIDAS</span></td>  
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 11px;">2</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 11px;"> {{$estadoc->cuotadeuda}} CUOTAS DE ${{$cliente->cuotadiaria}}. C/U</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">{{$estadoc->cuotadeuda}}</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->totalcuotasdeuda,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->totalcuotasdeuda,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">CUOTAS<br>VENCIDAS</span></td>  
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 11px;">3</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 11px;"> 1 CUOTA {{$diafe}} DE {{strtoupper($mesfe)}} DE {{$aniofe}}</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">1</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->ultimacuota,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->ultimacuota,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">CUOTAS<br>VENCIDAS</span></td>  
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 11px;">4</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">Mora por incumplimiento de contrato<br>de un capital ${{$estadoc->montoactual}}*1%*{{$estadoc->diasexpirados}}*Dias<br>atrasados. Del</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 12px;">{{$estadoc->diasexpirados}}</span></td>
          
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->mora,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->mora,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">MORA POR<br>INCUMPLI<br>MIENTO</span></td>  
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 11px;">5</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">Gasto por gestion de<br>cobro / notariales</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
          
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->gastosadmon,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->gastosadmon,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">ADMON</span></td> 
        </tr>
        <tr>
          <td style="border: 1px solid #333; height: 30px;" align="center"><span style="font-size: 11px;">6</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 11px;">Gastos Administrativos por Notificación</span></td>
          <td style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></td>
          
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="center"><span style="font-size: 10px;"></span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->gastosnotariales,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{
            number_format($estadoc->gastosnotariales,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;">ADMON</span></td> 
        </tr>
        <tr style="font-weight: bold;">
          <th style="border: 1px solid #333; height: 30px; text-align: center;" colspan="2"><span style="font-size: 9px;">TOTAL</span></th>
          <th style="border: 1px solid #333" align="center"><span style="font-size: 10px;"></span></th>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->totalpendiente+$estadoc->totalcuotasdeuda+$estadoc->ultimacuota,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->mora,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{number_format($estadoc->gastosadmon+$estadoc->gastosnotariales,2)}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333; border-right: 0px;"><span style="font-size: 13px;">&nbsp;&nbsp;$</span></td>
          <td style="border: 1px solid #333; border-left: 0px;" align="right"><span style="font-size: 13px;">{{$estadoc->total}}&nbsp;&nbsp;</span></td>
          <td style="border: 1px solid #333;" align="center"><span style="font-size: 10px;"></span></td>  
        </tr>
      </tbody>
    </table>
  </div>
  <br><br>
  <div><span>Por cada llamada que le empresa realice a su número de contacto después de a ver vencido el contrato se cargan $5.00 por llamada aun cuando esta no fuere correspondida. números de la empresa asignados: Tel: 2300-8288; Cel. 7333-9200</span></div>
  <br>
  <div><span>&nbsp;&nbsp;&nbsp;&nbsp;1. por visita ténica cuando el contrato ya este vencido se cargaran a su cuenta $10.00 aun cuando no sea atendida,</span></div><br>
  <div><span>- su credito vencio el <b>{{$liquidacion->fechadiaria->format('l j')}} de {{$liquidacion->fechadiaria->format('F')}} de {{$liquidacion->fechadiaria->format('Y')}}</b> de no estar solvente a la fecha de vencimiento. Se cargaran mora por el incumplimiento de 1% diario sobre saldo deudor a la fecha.</span></div>
  <br><br><br>
  <div align="center"><b><span>Email: afimid@yahoo.com</span></b></div>
</div>

<div style="padding: 10px 100px;">
  <a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}" class="btn btn-danger btn-lg"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>

  <a class="btn btn-danger btn-lg pull-right" data-title="Imprimir" href="{{URL::action('ComprobanteController@estadoPDF',$estadoc->idcomprobante)}}" data-toggle="modal" target="_blank"><i class="fa fa-print" aria-hidden="true"> Imprimir</i></a>
</div>
  

{!!Form::close()!!}


@endsection 