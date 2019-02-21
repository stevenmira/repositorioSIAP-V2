@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('EjecutivoController@index')}}"> Ejecutivo</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 40px 0px;"><b>PERFIL DEL EJECUTIVO</b></h4>

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
              <img alt="User Pic" src="{{asset('imagenes/ejecutivo/'.$ejecutivo->fotografia)}}" class="img-circle img-responsive"> 
            </div>

            <div class=" col-md-9 col-lg-9 "> 
              <table class="table table-user-information">
                <tbody>

                  <tr>
                    <td>NOMBRES Y APELLIDOS:</td>
                    <td>{{ $ejecutivo->nombre}} {{ $ejecutivo->apellido }}</td>
                  </tr>

                  <tr>
                    <td>DUI:</td>
                    <td>{{ $ejecutivo->dui }}</td>
                  </tr>

                  <tr>
                    <td>FECHA DE NACIMIENTO:</td>
                    <td>{{ $ejecutivo->fechanacimiento}} ({{ $edad }} años)</td>
                  </tr>

                  <tr>
                    <td>DIRECCIÓN:</td>
                    <td>{{ $ejecutivo->direccion}}</td>
                  </tr>

                  <tr>
                    <td>SEXO:</td>
                    <td>{{ $ejecutivo->sexo }}</td>
                  </tr>

                  <tr>
                    <td>NÚMERO TELEFONICO:</td>
                    <td>{{ $ejecutivo->telefono}}</td>
                  </tr>

                  <tr>
                    <td>CORREO:</td>
                    <td>{{ $ejecutivo->correo}}</td>
                  </tr>

                  <tr>
                    <td>COMENTARIO:</td>
                    <td>{{ $ejecutivo->comentario}}</td>
                  </tr>

                </tbody>
              </table>
              <a href="{{URL::action('EjecutivoController@edit',$ejecutivo->idejecutivo)}}" class="btn btn-primary btn-lg  pull-right">Actualizar</a>
            </div>
          </div>
        </div>
      </div>


@endsection