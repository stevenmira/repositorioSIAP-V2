@extends ('layouts.inicio')
@section('contenido')
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<section class="content-header">
  <div class="row" style="padding: 20px 20px 20px 20px;">
    <p class="pull-left"><b>Usuario:</b>&nbsp;&nbsp;&nbsp; {{$usuarioactual->nombre}} </p>
    <p class="pull-right"><b>Fecha de Emisión:</b>&nbsp;&nbsp;&nbsp; {{$fecha_actual}}</p>
  </div>
  <br>

  <h1 align="center">REPORTE  DE CARTERA DE PAGOS</h1>
  <br>

  {{Form::Open(['action'=>'ReportesController@carteraPagosReview'])}}
    
  @if (Session::has('msj'))
    <div class="row">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="errors">
          <ul>
            <p><b>Por favor, corrige lo siguiente:</b></p>
            <li>{{ Session::get('msj')}}</li>
          </ul>
        </div>
      </div>
    </div>
  @endif

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
  <br>

  <div class="row" style="padding: 0px 20px 0px 20px;">
    <div class="form-group col-md-3">
        <div class="form-group">
        <label>CARTERA</label>
            <select name="idcartera"  class="form-control selectpicker" id="idcliente" data-Live-search="true">
            @foreach($carteras as $cartera)
            <option value="{{ $cartera->idcartera }}">{{$cartera->nombre}}</option>
            @endforeach
          </select>
        </div>
    </div>
    <div class="form-group col-md-3">
      <label for="fecha">FECHA</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </div>
        {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
      </div>
    </div>
  </div>

  <br>
  <div class="row">
    <a href="{{URL::action('ReportesController@lista')}}" class="btn btn-primary btn-md col-md-offset-1"> REGRESAR</a>
    
    <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
    <button type="submit" class="btn btn-danger btn-md col-md-offset-3">GENERAR REPORTE</button>

    <a href="" class="btn btn-success btn-md col-md-offset-3" data-target="#modal-delete-1" data-toggle="modal">AYUDA</a>
    @include('reportes.estrategicos.modal')
  </div>
  <br><br>
  {!!Form::close()!!}

</section>
@endsection