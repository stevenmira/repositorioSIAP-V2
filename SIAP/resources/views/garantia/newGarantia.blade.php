@extends('layouts.inicio')
@section('contenido')
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
  p.a {font: oblique; font-size: 20px; text-shadow: 0 0 0.2em #cfd8dc;}
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li><a href="{{ url('cliente/creditos', ['id' => $cliente->idcliente ]) }}"> Créditos </a></li>
    <li><a href="{{ url('cliente/credito/garantias', ['id' => $idprestamo]) }}"> Garantías </a></li>
    <li class="active"> Nuevo </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVA GARANTÍA</b></h4>

<div class="row" align="center" style="font-size: 14px; ">
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>{{$prestamo->estado}}</p>
      <p>  {{$prestamo->fecha->format('d-m-Y')}}, Monto: $ {{$prestamo->monto}}, Cuota: $ {{$prestamo->cuotadiaria}} </p>
    </div>
  </aside>
  @if($negocio != null)
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Negocio</p>
      <p>  {{$negocio->nombre}}</p>
    </div>
  </aside>
  @endif
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Deudor</p>
      <p>  {{$cliente->nombre}} {{$cliente->apellido}}</p>
    </div>
  </aside>
  
  @if($codeudor != null)
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Codeudor</p>
      <p>  {{$codeudor->nombre}} {{$codeudor->apellido}}</p>
    </div>
  </aside>
  @else
  <aside class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="row">
      <p>Codeudor</p>
      <p>El crédito no tiene codeudor asociado</p>
    </div>
  </aside>
  @endif
</div>

{!!Form::open(array('url'=>'garantia','method'=>'POST','autocomplete'=>'off', 'onsubmit'=> 'return checkSubmit();'))!!}
            {{Form::token()}}

<div class="container">
  <div class="col-lg-12 col-md-12 col-sm-12">


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

      <div class="row"> 
        <div class="form-group col-md-2">
          <label>Garante</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            <select class="form-control" name="tipogarante" autofocus="on">
              <option value="Deudor"> Deudor</option>
              @if($codeudor != null)
              <option value="Codeudor"> Codeudor</option>
              @endif
            </select>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label>Marca</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la marca . . .', 'maxlength'=>'50']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label>Serie</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::text('serie', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la serie . . .', 'maxlength'=>'50']) !!}
          </div>
        </div>
        <div class="form-group col-md-2">
          <label>Valor</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::number('valor', null, ['class' => 'form-control', 'step'=>'0.01', 'placeholder'=>'Digite el valor estimado . . .']) !!}
          </div>
        </div>
      </div>
      
      <div class="row"> 
        <div class="form-group col-md-6">
          <label>Descripción</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::textarea('descripcion', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Describa la garantia . . .', 'rows'=>'3']) !!}
          </div>
        </div>
        <div class="form-group col-md-6">
          <label>Otras especificaciones</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::textarea('otros', null, ['class' => 'form-control', 'placeholder'=>'Describa las especificaciones . . .', 'rows'=>'3']) !!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
          <div class="form-group">
          <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
              <a href="{{ url('cliente/credito/garantias', ['id' => $idprestamo]) }}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button id="btsubmit" class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
        </div>
      </div>
  </div>
</div>


<input type="hidden" name="idprestamo" value="{{ $idprestamo }}">

{!!Form::close()!!}

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">{{$fecha_actual}}</h4>
</div>

<script type="text/javascript">
  function checkSubmit() {
    $('#btsubmit').html("Enviando . . .");
    document.getElementById("btsubmit").disabled = true;
    return true;
  }
</script>

@endsection