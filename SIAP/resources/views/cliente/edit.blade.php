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
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente</a></li>
    <li class="active">Editar</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>EDITAR CLIENTE</b></h4>

{!!Form::model($cliente,['method'=>'PATCH','route'=>['cliente.update',$cliente->idcliente]])!!}
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
              <label for="cartera">Carteras</label>
              <select name="idcartera" class="form-control">
                @foreach ($carteras as $gr)
                  @if ($gr->idcartera == $cartera->idcartera)
                  <option value="{{$gr->idcartera}}" selected>{{$gr->nombre}}</option>
                  @else
                  <option value="{{$gr->idcartera}}">{{$gr->nombre}}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="nombre">Nombres del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::text('nombre', $cliente->nombre, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el nombre . . .', 'autofocus'=>'on', 'maxlength'=>'30']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="apellido">Apellidos del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::text('apellido', $cliente->apellido, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el apellido . . .', 'autofocus'=>'on', 'maxlength'=>'30']) !!}
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
                {!! Form::text('dui', $cliente->dui, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el DUI . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "99999999-9"',  'data-mask'=>'on']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="lugar">Lugar de Expedición (DUI)</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                {!! Form::text('lugarexpedicion', $cliente->lugarexpedicion, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el lugar . . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="fecha">Fecha de Expedición (DUI)</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                </div>
                {!! Form::date('fechaexpedicion', $cliente->fechaexpedicion, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']) !!}
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
                {!! Form::text('nit', $cliente->nit, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el NIT . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-999999-999-9"',  'data-mask'=>'on']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="edad">Fecha de Nacimiento</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                {!! Form::date('fechanacimiento', $cliente->fechanacimiento, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="nombre">Domicilio</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::text('domicilio', $cliente->domicilio, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca el domicilio . . .', 'autofocus'=>'on', 'maxlength'=>'45']) !!}
              </div>
            </div>

          </div>

          <div class="row">
            <div class="form-group col-md-8">
              <label for="direccionCliente">Dirección del cliente</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::textarea('direccionCliente', $cliente->direccion, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>'Introduzca la dirección del cliente . . .', 'autofocus'=>'on', 'rows'=>'1']) !!}
              </div>
            </div>

            <div class="form-group col-md-2">
              <label for="categoria">Categorias</label>
              <select name="idcategoria" class="form-control">
                @foreach ($categorias as $gr)
                  @if ($gr->idcategoria == $categoria->idcategoria)
                  <option value="{{$gr->idcategoria}}" selected>{{$gr->letra}}</option>
                  @else
                  <option value="{{$gr->idcategoria}}">{{$gr->letra}}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-1 col-lg-1 col-sm-1">
              <a href="" data-target="#modal-help" data-toggle="modal"><i class="fa fa-info-circle"> AYUDA</i></a>
              @include('cliente.modal2')
            </div>

          </div>

          <div class="row"> 

            <div class="form-group col-md-4">
              <label for="apellido">Profesion</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                {!! Form::text('profesion', $cliente->profesion, ['class' => 'form-control' , 'placeholder'=>'Introduzca la profesion . . .', 'autofocus'=>'on', 'maxlength'=>'50']) !!}
              </div>
            </div>

            <div class="form-group col-md-4">
              <label for="telefonocel">Teléfono celular</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-android" aria-hidden="true"></i>
                </div>
                {!! Form::text('telefonocel', $cliente->telefonocel, ['class' => 'form-control' , 'placeholder'=>'Tel. Celular  . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']) !!}
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="telefonofijo">Teléfono fijo</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                {!! Form::text('telefonofijo', $cliente->telefonofijo, ['class' => 'form-control' ,'placeholder'=>'Tel. Fijo . . .', 'autofocus'=>'on', 'data-inputmask'=>'"mask": "9999-9999"',  'data-mask'=>'on']) !!}
              </div>
            </div>
          </div>         
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
    <div class="form-group">
    <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
        <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"> Cancelar</a>
        <button class="btn btn-primary btn-lg col-md-offset-6" type="submit"> Actualizar</button>
      </div>
  </div>
</div>
{!!Form::close()!!}

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">{{$fecha_actual}}</h4>
  </div>
</div>

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