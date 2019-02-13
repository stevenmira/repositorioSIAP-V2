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
    <li><a href="{{ url('negocios/list', ['id' => $cliente->idcliente ]) }}"> Negocio </a></li>
    <li class="active">Editar</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>EDITAR NEGOCIO</b></h4>


<div class="container">
  <p class="a"> <span><i class="fa fa-user" style="padding: 0px 13px 0px 13px;"> Juan Antonio Perez Gomez</i></span> </p>
</div>

{!!Form::model($negocio, ['method'=>'PATCH','route'=>['negocio.update',$negocio->idnegocio]])!!}
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
          <label for="nombreNegocio">Nombre del Negocio</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::textarea('nombreNegocio', $negocio->nombre, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite el nombre del negocio . . .', 'autofocus'=>'on', 'rows'=>'3']) !!}
          </div>
        </div>

        <div class="form-group col-md-4">
          <label for="actividadEconomica">Actividad Economica</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::textarea('actividadEconomica', $negocio->actividadeconomica, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite la actividad economica del negocio . . . ', 'autofocus'=>'on', 'rows'=>'3']) !!}
          </div>
        </div>

        <div class="form-group col-md-4">
          <label for="direccionNegocio">Dirección del Negocio</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </div>
            {!! Form::textarea('direccionNegocio', $negocio->direccionnegocio, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Digite la dirección del negocio . . .', 'autofocus'=>'on', 'rows'=>'3']) !!}
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
          <div class="form-group">
          <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
              <a href="{{ url('negocios/list', ['id' => $cliente->idcliente ]) }}" class="btn btn-danger btn-lg col-md-offset-2">Cancelar</a>
              <button class="btn btn-primary btn-lg col-md-offset-6" type="submit">Actualizar</button>
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

@endsection