@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio </a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente </a></li>
    <li><a href="{{ url('codeudores/list', ['id' => $cliente->idcliente ]) }}"> Codeudor </a></li>
    <li class="active"> Perfil </li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>PERFIL DEL CODEUDOR</b></h4>

<section>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
      <div class="panel panel-info">

        <div class="panel-heading">
          <h3 class="panel-title">INFORMACIÓN PERSONAL</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3 col-lg-3 " align="center"> 
              <img alt="User Pic" src="{{asset('img/logos/cliente.png')}}" class="img-circle img-responsive"> 
            </div>

            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>

                  <tr>
                    <td>NOMBRES Y APELLIDOS:</td>
                    <td>{{ $codeudor->nombre}} {{ $codeudor->apellido }}</td>
                  </tr>

                  <tr>
                    <td>PROFESION:</td>
                    <td>{{ $codeudor->profesion}}</td>
                  </tr>

                  <tr>
                    <td>NIT:</td>
                    <td>{{ $codeudor->nit }}</td>
                  </tr>

                  <tr>
                    <td>DUI:</td>
                    <td>{{ $codeudor->dui }}</td>
                  </tr>

                  <tr>
                    <td>LUGAR DE EXPEDICION (DUI)</td>
                    <td>{{ $codeudor->lugarexpedicion }}</td>
                  </tr>

                  <tr>
                    <td>FECHA DE EXPEDICION (DUI)</td>
                    <td>{{ $codeudor->fechaexpedicion }}</td>
                  </tr>

                  <tr>
                    <td>FECHA DE NACIMIENTO:</td>
                    <td>{{ $codeudor->fechanacimiento}} ({{ $edad }} años)</td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN:</td>
                    <td>{{ $codeudor->direccion}}</td>
                  </tr>

                  <tr>
                    <td>DOMICILIO:</td>
                    <td>{{ $codeudor->domicilio}}</td>
                  </tr>

                  <tr>
                    <td>NÚMERO TELEFONICO:</td>
                    <td>{{ $codeudor->telefonofijo}} - {{ $codeudor->telefonocel}}</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{URL::action('CodeudorController@edit',$codeudor->idcodeudor)}}" class="btn btn-primary btn-lg  pull-right">Actualizar</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    <a href="{{ url('codeudores/list', ['id' => $cliente->idcliente ]) }}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>

    
</section>


@endsection