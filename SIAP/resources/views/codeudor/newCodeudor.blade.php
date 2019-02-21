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
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio </a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li><a href="{{ url('codeudores/list', ['id' => $cliente->idcliente ]) }}"> Codeudor </a></li>
    <li class="active"> Nuevo </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVO CODEUDOR</b></h4>


<div class="container">
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 13px 0px 13px;"> {{$cliente->nombre}} {{$cliente->apellido}}</i></span> </p>
</div>

{!!Form::open(array('url'=>'codeudor','method'=>'POST','autocomplete'=>'off', 'onsubmit'=> 'return checkSubmit();'))!!}
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
        <div class="form-group col-md-4">
          <label for="nombre">Nombre</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="apellido">Apellido</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::text('apellido', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el apellido . . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="profesion">Profesion</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::text('profesion', null, ['class' => 'form-control', 'placeholder'=>'Introduzca la profesion del cliente. . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
          </div>
        </div>
      </div>

      <div class="row"> 
        <div class="form-group col-md-4">
          <label for="dui">DUI</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
            </div>
            {!! Form::text('dui', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el DUI . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "99999999-9"',  'data-mask'=>'on']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="lugar">Lugar de Expedición (DUI)</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
            </div>
            {!! Form::text('lugarexpedicion', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el lugar . . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="fecha">Fecha de Expedición (DUI)</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
            </div>
            {!! Form::date('fechaexpedicion', null, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']) !!}
          </div>
        </div>
      </div>

      <div class="row"> 
        <div class="form-group col-md-4">
          <label for="nit">NIT</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-list-alt" aria-hidden="true"></i>
            </div>
            {!! Form::text('nit', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el NIT . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-999999-999-9"',  'data-mask'=>'on']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="edad">Fecha de Nacimiento</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            {!! Form::date('fechanacimiento', null, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="nombre">Domicilio</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::text('domicilio', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el domicilio . . .', 'autofocus'=>'on', 'maxlength'=>'45']) !!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-4">
          <label for="direccionCliente">Dirección</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::textarea('direccion', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca la dirección del cliente . . .', 'autofocus'=>'on', 'rows'=>'1']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="telefonocel">Teléfono celular</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-android" aria-hidden="true"></i>
            </div>
            {!! Form::text('telefonocel', null, ['class' => 'form-control' , 'placeholder'=>'Tel. Celular  . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']) !!}
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="telefonofijo">Teléfono fijo</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-phone" aria-hidden="true"></i>
            </div>
            {!! Form::text('telefonofijo', null, ['class' => 'form-control' ,'placeholder'=>'Tel. Fijo . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']) !!}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
          <div class="form-group">
          <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
              <a href="{{ url('codeudores/list', ['id' => $cliente->idcliente ]) }}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
              <button id="btsubmit" class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
            </div>
        </div>
      </div>
  </div>
</div>


  <input type="hidden" name="idcliente" value="{{ $cliente->idcliente }}">

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

@push('scripts')


<!-- InputMask -->
<script src="{{asset('js/inputmask/jquery3.js')}}"></script>  
<script src="{{asset('js/inputmask/input-mask.js')}}"></script>
<script src="{{asset('js/inputmask/input-mask-date.js')}}"></script>

<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>
@endpush


@endsection