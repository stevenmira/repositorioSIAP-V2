@extends ('layouts.inicio')
@section ('contenido')

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('EmpleadoController@index')}}"> Ajustes</a></li>
    <li><a href="{{URL::action('EmpleadoController@index')}}"> Personal </a></li>
  </ol>
</section>

<br>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>


  <div class="row">
    <a class="button" style="font-size: 15px;" title="" href="">
    <span class="g.glyphicon .glyphicon-user"></span></a>
  </div>

  <div style="text-align:center">
    <img src="../img/logo.png"  width="200" height="200">
    </div>

  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="row col-sm-12">
                <div class="col-sm-4" align="center">
                  <span class="fa fa-users fa-5x"></span>
                  <h3>Ejecutivo</h3>
                  <p><a href="{{URL::action('EjecutivoController@index')}}">Lista de Ejecutivos</a></p>
                </div>
                
                <div class="col-sm-4" align="center">
                  <span class="fa fa-users fa-5x"></span>
                  <h3>Supervisor</h3>
                  <p><a href="{{URL::action('SupervisorController@index')}}">Lista de Supervisores</a></p>
                </div>

                @if($usuarioactual->idtipousuario==1)
                <div class="col-sm-4" align="center">
                  <span class="fa fa-user-plus fa-5x"></span>
                  <h3>Empleados</h3>
                  <p><a href="{{URL::action('EmpleadoController@index')}}">Lista de Empleados</a></p>
                </div>
                @endif

              </div>
          </div>
      </div>
  </div>

<div>
  <br>
</br>
</div>

<div class="row">
  <a href="{{ url('home')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>

@endsection
