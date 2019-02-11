@extends ('layouts.inicio')
@section('contenido')

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <h1 style="color: #333333; font-family: 'Times New Roman', Times, serif;">
    NUEVA TASA DE INTERÉS
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('TasaInteresController@index')}}"> Tasa de Interés</a></li>
    <li class="active">Nuevo</li>
  </ol>
</section>
<br>

{!!Form::open(array('url'=>'tasa-interes','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

  <div class="col-md-12"> 
    <div class="panel panel-success">
      <div class="panel-body">
          <h4 style="color: #333333; font-family: 'Times New Roman', Times, serif;"><b> Datos</b></h4>
          <hr>

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

            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
              <label for="nombre">Tipo Crédito</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Normal, Prefencial, Oro, Otros  . . .', 'autofocus'=>'on', 'maxlength'=>'30']) !!}
              </div>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2">
              <label for="interes">Interés</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-percent" aria-hidden="true"><b>%</b></i>
                </div>
                {!! Form::number('interes', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'En Porcentaje', 'step'=>'0.01']) !!}
              </div>
            </div>

          </div>

          <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
              <label for="condicion">Condición</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::text('condicion', null, ['class' => 'form-control', 'placeholder'=>'Mayor, Menor, Igual . . .', 'maxlength'=>'90']) !!}
              </div>
            </div>

            <div class="form-group col-lg-2 col-md-2 col-sm-2">
              <label for="monto">Monto</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-dollar" aria-hidden="true"></i>
                </div>
                {!! Form::number('monto', null, ['class' => 'form-control' , 'placeholder'=>'Monto . . .', 'step'=>'0.01']) !!}
              </div>
            </div>
          </div>

          <br>
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
              <div class="form-group">
              <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                  <a href="{{URL::action('TasaInteresController@index')}}" class="btn btn-danger btn-lg col-lg-offset-3 col-md-offset-3 col-sm-offset-3"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
                  <button class="btn btn-primary btn-lg col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Guardar</button>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>

{!!Form::close()!!}
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3 style="text-align:center; font-family:  Times New Roman, sans-serif; color: #1C2331; float: right;"><b>{{$fecha_actual}}</b></h3>
  </div>
</div>

@endsection