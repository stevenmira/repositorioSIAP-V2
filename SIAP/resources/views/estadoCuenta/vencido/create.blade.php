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
    <li><a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}"> Estados de Cuentas</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>
<br>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 5px 0px;"><b>NUEVO ESTADO DE CUENTA</b></h4>
<br><br>
<div class="container">
  <table>
    <thead>
      <tr>
        <td style="width: 10%; font-weight: bold;">CLIENTE:</td>
        <td style="width: 25%;">{{$cliente->nombre}} {{$cliente->apellido}}</td>
        <td style="width: 10%; font-weight: bold;">NEGOCIO:</td>
        <td style="width: 25%;">{{$cliente->nombreNegocio}}</td>
        <td style="width: 7%; font-weight: bold;">CARTERA:</td>
        <td style="width: 18%; font-weight: bold;">"{{$cliente->nombreCartera}}"</td>
        <td style="width: 5%;">
          <a href="{{URL::action('ClienteController@show',$cliente->idcliente)}}">Ver Perfil</a>
        </td>
      </tr>
    </thead>
  </table>
</div>

<div class="row">
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @if(count($errors) > 0)
    <div class="errors">
      <ul>
        <p><b>Por favor, corrige lo siguiente:</b></p>
        <?php $cont = 1; ?>
      @foreach($errors->all() as $error)
        <li>{{$cont}}. {{ $error }}</li>
        <?php $cont=$cont+1; ?>
      @endforeach
      </ul>
    </div>
  @endif
  </div>
</div>



  {!!Form::open(array('action' => array('ComprobanteController@agregarestado',$cliente->idcuenta), 'method'=>'POST','autocomplete'=>'off'))!!}
  <div style="padding: 0px 40px;">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
      <div class="panel panel-success"> 
        <div class="panel-heading">
          <h3 class="panel-title">DETALLE DE LA DEUDA</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 col-sm-12  col-md-12 col-lg-12 "> 
              <table class="table table-user-information">
                <thead>
                  <th>No.</th>
                  <th>FECHAS</th>
                  <th>DÍAS</th>
                  <th>DETALLES</th>                
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Fecha</td>
                    <td></td>
                    <td>
                      {!! Form::date('fechaactual', \Carbon\Carbon::now(), ['class' => 'form-control', 'required' => 'required','autofocus'=>'on']) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      Saldo pendiente de cuota
                    </td>                      
                    <td>
                        {!! Form::number('diaspendiente',$diaspendx, ['id'=>'diaspendiente','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'1']) !!}
                    </td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                        {!! Form::number('totalpendiente',$totalpendx, ['id'=>'totalpendiente','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'0.01']) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      Cuotas atrasadas y/o pendientes de <b><span id="cuotax">$ {{ number_format($cliente->cuotadiaria,2) }}</span></b>
                    </td>                      
                    <td>
                        {!! Form::number('cuotadeuda',$cuotadeux, ['id'=>'cuotadeuda','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'1']) !!}
                    </td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                        {!! Form::number('totalcuotadeuda',$totalcuotadeux, ['id'=>'totalcuotadeuda','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'0.01']) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      Última cuota 
                    </td>                      
                    <td>
                        {!! Form::number('ultimac',1, ['id'=>'ultimac','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'1']) !!}
                    </td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                        {!! Form::number('ultimacuota',$totalultimacuox, ['class' => 'form-control' , 'required' => 'required','step'=>'0.01']) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      Mora por incumplimiento de contrato de un capital 
                    </td>                      
                    <td>
                        {!! Form::number('diasexpirados',$diasexpix, ['id'=>'diasexpirados','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'1']) !!}
                    </td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                        {!! Form::number('mora',$morx, ['id'=>'mora','onkeyup'=>'Multi();Sumar()','class' => 'form-control' , 'required' => 'required','step'=>'0.01']) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                      Saldo capital 
                    </td>                      
                    <td></td>
                    <td class="col-xs-4 col-sm-4  col-md-4 col-lg-4">
                        {!! Form::number('monto',$monto, ['class' => 'form-control' , 'required' => 'required','step'=>'0.01']) !!}
                    </td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Gastos de Administración por gestion de cobros:</td>
                    <td></td>
                    <td>{!! Form::number('gastosadmon', null, ['id'=>'gastosadmon','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca los gastos administrativos. . .', 'step'=>'0.01']) !!}</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Gastos Administrativos por Notificación:</td>
                    <td></td>
                    <td>{!! Form::number('gastosnoti', null, ['id'=>'gastosnoti','onkeyup'=>'Sumar()','class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca los gastos por notificación. . .', 'step'=>'0.01']) !!}</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><b style="color:red">TOTAL A CANCELAR</b></td>
                    <td></td>
                    <td><b>{!! Form::number('total', $totalx, [ 'id'=>'total','class' => 'form-control', 'step'=>'0.01','required' => 'required']) !!}</b></td>
                   
                  </tr>
                </tbody>
              </table>
              <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
              <a href="{{URL::action('ComprobanteController@show',$cliente->idcuenta)}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button class="btn btn-primary btn-lg pull-right" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{!!Form::close()!!}

@push('scripts')




@endpush


@endsection


