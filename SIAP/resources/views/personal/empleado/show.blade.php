@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('EmpleadoController@index')}}"> Empleado</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>PERFIL DEL EMPLEADO</b></h4>

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
              <img alt="User Pic" src="{{asset('imagenes/empleado/'.$empleado->fotografia)}}" class="img-rounded img-responsive"> 
            </div>

            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>

                  <tr>
                    <td>NOMBRES Y APELLIDOS:</td>
                    <td>{{ $empleado->nombre}} {{ $empleado->apellido }}</td>
                  </tr>

                  <tr>
                    <td>DUI:</td>
                    <td>{{ $empleado->dui }}</td>
                  </tr>

                  <tr>
                    <td>FECHA DE NACIMIENTO:</td>
                    <td>{{ $empleado->fechanacimiento}} ({{ $edad }} años)</td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN:</td>
                    <td>{{ $empleado->direccion}}</td>
                  </tr>

                  <tr>
                    <td>SEXO:</td>
                    <td>{{ $empleado->sexo }}</td>
                  </tr>

                  <tr>
                    <td>NÚMERO TELEFONICO:</td>
                    <td>{{ $empleado->telefono}}</td>
                  </tr>

                  <tr>
                    <td>CARGO:</td>
                    <td>{{ $empleado->correo}}</td>
                  </tr>

                  <tr>
                    <td>CORREO:</td>
                    <td>{{ $empleado->correo}}</td>
                  </tr>

                  <tr>
                    <td>COMENTARIO:</td>
                    <td>{{ $empleado->comentario}}</td>
                  </tr>

                </tbody>
              </table>
              <a href="{{URL::action('EmpleadoController@edit',$empleado->idempleado)}}" class="btn btn-primary btn-lg  pull-right">Actualizar</a>
            </div>
          </div>
        </div>
      </div>


@endsection