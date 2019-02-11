@extends ('layouts.inicio')
@section ('contenido')
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('CarteraController@index')}}"> Carteras</a></li>
    <li class="active">Editar</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 50px 0px 25px 0px;"><b>EDITAR CARTERA</b></h4>

{!!Form::model($cartera,['method'=>'PATCH','route'=>['carteras.update',$cartera->idcartera]])!!}
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

    <div class="form-group col-md-4">
      <label for="nombre">Nombre</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-pencil" aria-hidden="true"></i>
        </div>
        {!! Form::text('nombre', $cartera->nombre, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
      </div>
    </div>

    <div class="form-group col-md-4">
      <label for="cartera">Ejecutivo</label>
      <select name="idejecutivo" class="form-control">
        @foreach ($ejecutivos as $ejecutivo)
          @if ($ejecutivo->idejecutivo == $cartera->idejecutivo)
          <option value="{{$ejecutivo->idejecutivo}}" selected>{{$ejecutivo->nombre}} {{$ejecutivo->apellido}}</option>
          @else
          <option value="{{$ejecutivo->idejecutivo}}">{{$ejecutivo->nombre}}</option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="cartera">Supervisor</label>
      <select name="idsupervisor" class="form-control">
        @foreach ($supervisores as $supervisor)
          @if ($supervisor->idsupervisor == $cartera->idsupervisor)
          <option value="{{$supervisor->idsupervisor}}" selected>{{$supervisor->nombre}} {{$supervisor->apellido}}</option>
          @else
          <option value="{{$supervisor->idsupervisor}}">{{$supervisor->nombre}}</option>
          @endif
        @endforeach
      </select>
    </div>

      <div style="padding: 100px 0px 0px 0px;" class="row">
        <div class="form-group">
          <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
          <a href="{{URL::action('CarteraController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
          <button class="btn btn-primary btn-lg col-md-offset-6" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Guardar</button>
        </div>
      </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">{{$fecha_actual}}</h4>
    </div>

  </div>
</div>  

{!!Form::close()!!}
@endsection