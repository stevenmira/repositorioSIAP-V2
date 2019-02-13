@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>PERFIL DEL CLIENTES</b></h4>

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
                    <td>CARTERA:</td>
                    <td>{{ $cartera->nombre}}</td>
                  </tr>

                  <tr>
                    <td>NOMBRES Y APELLIDOS:</td>
                    <td>{{ $cliente->nombre}} {{ $cliente->apellido }}</td>
                  </tr>

                  <tr>
                    <td>PROFESION:</td>
                    <td>{{ $cliente->profesion}}</td>
                  </tr>

                  <tr>
                    <td>NIT:</td>
                    <td>{{ $cliente->nit }}</td>
                  </tr>

                  <tr>
                    <td>DUI:</td>
                    <td>{{ $cliente->dui }}</td>
                  </tr>

                  <tr>
                    <td>LUGAR DE EXPEDICION (DUI)</td>
                    <td>{{ $cliente->lugarexpedicion }}</td>
                  </tr>

                  <tr>
                    <td>FECHA DE EXPEDICION (DUI)</td>
                    <td>{{ $cliente->fechaexpedicion }}</td>
                  </tr>

                  <tr>
                    <td>FECHA DE NACIMIENTO:</td>
                    <td>{{ $cliente->fechanacimiento}} ({{ $edad }} años)</td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN:</td>
                    <td>{{ $cliente->direccion}}</td>
                  </tr>

                  <tr>
                    <td>DOMICILIO:</td>
                    <td>{{ $cliente->domicilio}}</td>
                  </tr>

                  <tr>
                    <td>NÚMERO TELEFONICO:</td>
                    <td>{{ $cliente->telefonofijo}} - {{ $cliente->telefonocel}}</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{URL::action('ClienteController@edit',$cliente->idcliente)}}" class="btn btn-primary btn-lg  pull-right">Actualizar</a>
            </div>
          </div>
        </div>
      </div>

      @foreach($negocios as $ma)
      <div class="panel panel-danger">

        <div class="panel-heading">
          <h3 class="panel-title">INFORMACIÓN DE NEGOCIO</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3 col-lg-3 " align="center"> 
              <img alt="User Pic" src="{{asset('img/logos/ubicacion.png')}}" class="img-circle img-responsive"> 
            </div>

            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>NOMBRE:</td>
                    <td>{{ $ma->nombre}}</td>
                  </tr>

                  <tr>
                    <td>ACTIVIDAD ECONOMICA:</td>
                    <td>{{ $ma->actividadeconomica}}</td>
                  </tr>

                  <tr>
                    <td>DIRECCION:</td>
                    <td>{{ $ma->direccionnegocio }}</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{URL::action('NegocioController@edit',$ma->idnegocio)}}" class="btn btn-primary btn-lg  pull-right">Actualizar</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>

  <div class="row">
    <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>

    
</section>


@endsection