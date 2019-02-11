@extends ('layouts.inicio')
@section('contenido')

<!-- Select CSS -->



<section class="content-header">
  <h1 style="color: #333333; ">
    CÁLCULO DE CRÉDITO
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
   
    <li class="active">Calcular Crédito Completo</li>
  </ol>
</section>
<br>
<section class="content-header">
 @if (Session::has('negativo'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>{{ Session::get('negativo')}}</h4>
      </div>
  @endif

  @if (Session::has('negativo1'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>{{ Session::get('negativo1')}}</h4>
      </div>
  @endif

  @if (Session::has('negativo2'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>{{ Session::get('negativo2')}}</h4>
      </div>
  @endif

  @if (Session::has('negativo3'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>{{ Session::get('negativo3')}}</h4>
      </div>
  @endif

  @if (Session::has('mayor'))
       <div class="alert  fade in" style="background: #ff6666;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4>{{ Session::get('mayor')}}</h4>
      </div>
  @endif
</section>

{!!Form::open(array('url'=>'calcular-credito','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
	 
   
  <div class="row"> 
    <div class="form-group col-md-4 col-lg-4 col-sm-4">
      <label for="date">Fecha</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </div>
        {!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control' , 'required' => 'required']) !!}
      </div>
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3">
      <label for="nit">Comienzo de la cartera de pagos</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-list-alt" aria-hidden="true"></i>
        </div>
          <input type="radio" name="inicio"  value="NEXT" checked> MAÑANA<br>
          <input type="radio" name="inicio"  value="HOY"> HOY<br>
      </div>
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3">
      <label for="nit">Cobro de Comisión</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-list-alt" aria-hidden="true"></i>
        </div>
        <input type="radio" name="tipo"  value="SI" checked> SÍ<br>
        <input type="radio" name="tipo"  value="NO"> NO<br>
      </div>
    </div>

    <div class="form-group col-md-1 col-lg-1 col-sm-1">
      <label>__________</label>
      <a href="" data-target="#modal-help" data-toggle="modal"><i class="fa fa-info-circle"> AYUDA</i></a>
      @include('calcularCredito.modal')
    </div>
  </div>

  

  <div class="row">

    <div class="form-group col-md-4 col-lg-4 col-sm-4">
      <label for="nombre">Seleccione la tasa de interés a aplicar</label>
        <select name="idtipocredito"  class="form-control selectpicker" data-Live-search="true" title="Seleccione o Busque la tasa que desar aplicar" required>
          @foreach($interesList as $interes)
            <option value="{{ $interes->idtipocredito }}">{{$interes->interes*100}}%</option>
          @endforeach
        </select>
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3">
      <label for="monto">Monto a Otorgar</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </div>
        {!! Form::number('monto', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Ingresar monto a Otorgar', 'step'=>'0.01']) !!}
      </div>
    </div>

    <div class="form-group col-md-3 col-lg-3 col-sm-3">
      <label>Cuota Diaria</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </div>
          {!! Form::number('cuota', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Ingresar cuota', 'step'=>'0.01']) !!}
        </div>
    </div>
  </div>
    
  

  <div class="row">
    <br>
    <div class="form-group  col-md-offset-4 col-lg-offset-4 col-sm-offset-4">
      <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
      <a class=" btn btn-danger btn-lg" type="reset"  href="/">Cancelar</a>
      <button type="submit" class="btn btn-success btn-lg col-md-offset-3 col-lg-offset-3 col-sm-offset-3">Calcular</button>
    </div>
  </div>
    

{!!Form::close()!!}

@endsection