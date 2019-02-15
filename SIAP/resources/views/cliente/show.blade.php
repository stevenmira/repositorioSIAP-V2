@extends ('layouts.inicio')
@section('contenido')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{URL::action('ClienteController@index')}}"> Cliente</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>

<style type="text/css">
    
  /* Tabs panel */
  .tabbable-panel {
    border:1px solid #d0d6e2;
    padding: 10px;
  }

  /* Default mode */
  .tabbable-line > .nav-tabs {
    border: none;
    margin: 0px;
  }
  .tabbable-line > .nav-tabs > li {
    margin-right: 2px;
  }
  .tabbable-line > .nav-tabs > li > a {
    border: 0;
    margin-right: 0;
    color: #737373;
  }
  .tabbable-line > .nav-tabs > li > a > i {
    color: #a6a6a6;
  }
  .tabbable-line > .nav-tabs > li.open, .tabbable-line > .nav-tabs > li:hover {
    border-bottom: 4px solid #fbcdcf;
  }
  .tabbable-line > .nav-tabs > li.open > a, .tabbable-line > .nav-tabs > li:hover > a {
    border: 0;
    background: none !important;
    color: #333333;
  }
  .tabbable-line > .nav-tabs > li.open > a > i, .tabbable-line > .nav-tabs > li:hover > a > i {
    color: #a6a6a6;
  }
  .tabbable-line > .nav-tabs > li.open .dropdown-menu, .tabbable-line > .nav-tabs > li:hover .dropdown-menu {
    margin-top: 0px;
  }
  .tabbable-line > .nav-tabs > li.active {
    border-bottom: 4px solid #f3565d;
    position: relative;
  }
  .tabbable-line > .nav-tabs > li.active > a {
    border: 0 !important;
    color: #333333;
  }
  .tabbable-line > .nav-tabs > li.active > a > i {
    color: #404040;
  }
  .tabbable-line > .tab-content {
    margin-top: -3px;
    background-color: #fff;
    border: 0;
    border-top: 1px solid #d0d6e2;
    padding: 15px 0;
  }
  .portlet .tabbable-line > .tab-content {
    padding-bottom: 0;
  }

  /* Below tabs mode */

  .tabbable-line.tabs-below > .nav-tabs > li {
    border-top: 4px solid transparent;
  }
  .tabbable-line.tabs-below > .nav-tabs > li > a {
    margin-top: 0;
  }
  .tabbable-line.tabs-below > .nav-tabs > li:hover {
    border-bottom: 0;
    border-top: 4px solid #fbcdcf;
  }
  .tabbable-line.tabs-below > .nav-tabs > li.active {
    margin-bottom: -2px;
    border-bottom: 0;
    border-top: 4px solid #f3565d;
  }
  .tabbable-line.tabs-below > .tab-content {
    margin-top: -10px;
    border-top: 0;
    border-bottom: 1px solid #d0d6e2;
    padding-bottom: 15px;
  }

  .menu_title {
      padding: 15px 10px;
      border-bottom: 1px solid #d0d6e2;
      margin: 0 5px;
  }
</style>

<style type="text/css">
  /*** Profile: Recent activity ***/
  .profile-comments__item {
    position: relative;
    padding: 5px 5px;
    margin: 0px;
    border-bottom: 1px solid #d0d6e2;
  }
  .profile-comments__item:last-child {
    border-bottom: 0;
  }
  .profile-comments__item:hover,
  .profile-comments__item:focus {
    background-color: #eceff1;
  }

  .tipografia{
    font-family:  'Trebuchet MS', Helvetica, sans-serif; 
    color: #333333;
  }
</style>

<style type="text/css">
  /* -- color classes -- */
  .coralbg1 {
      background-color: #1C2331;
  } 

  .coralbg2 {
      background-color: rgba(244, 67, 54, 0.7);
  } 

  .coralbg3 {
      background-color: #FA396F;
  } 

  .white {
      color: #fff!important;
  }

  div.user-menu-container {
    z-index: 10;
    background-color: #fff;
    background-clip: padding-box;
    opacity: 0.97;
  }

  div.user-menu-container h4 {
      font-weight: 300;
      color: #8b8b8b;
  }

  
  /* -- The btn stylings for the btn icons -- */
  .btn-label {
    position: relative;
    left: -12px;
    display: inline-block;
    padding: 6px 12px;
    background: rgba(0,0,0,0.15);
    border-radius: 3px 0 0 3px;
  }

  .btn-labeled {
    padding-top: 0;
    padding-bottom: 0;
  }

  /* -- Custom classes for the snippet, won't effect any existing bootstrap classes of your site, but can be reused. -- */

  .user-pad {
      padding: 15px 25px;
  }

  .no-pad {
      padding-right: 0;
      padding-left: 0;
      padding-bottom: 0;
  }

  .user-details {
      background: #eee;
      min-height: 333px;
  }

 

  .overview h3 {
      font-weight: 300;
      margin-top: 15px;
      margin: 10px 0 0 0;
      font-size: 15px;
  }

  .overview h4 {
      font-weight: bold!important;
      font-size: 20px;
      margin-top: 0;
  }
</style>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<div class="container">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

    <div class="row user-menu-container square">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 user-details">
          <div class="row  white">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 coralbg2 no-pad">
                  <div class="user-pad">
                      <h3 class="text-uppercase">Perfil de cliente</h3>
                      <h4 class="white"><i class="fa fa-user"></i> {{$cliente->nombre}} {{$cliente->apellido}}</h4>
                      <h4 class="white"><i class="fa fa-briefcase"></i> {{$cliente->profesion}}</h4>
                      <h4 class="white"><i class="fa fa-calendar"></i> {{$cliente->fechanacimiento}} ({{$edad}} años)</h4>
                      <h4 class="white"><i class="fa fa-map-marker"></i>   {{$cliente->direccion}} </h4>
                      <h4 class="white"><i class="fa fa-list-alt"></i> DUI y NIT: {{$cliente->dui}} / {{$cliente->nit}}</h4>
                      <h4 class="white"><i class="fa fa-check-circle-o"></i> Lugar y Fecha de Expedición: {{$cliente->lugarexpedicion}}, {{$cliente->fechaexpedicion}}</h4>
                      <h4 class="white"><i class="fa fa-map-marker"></i> Domicilio: {{$cliente->domicilio}}</h4>
                      <h4 class="white"><i class="fa fa-phone"></i> Teléfonos: {{$cliente->telefonofijo}}, {{$cliente->telefonocel}}</h4>
                      <a type="button" class="btn btn-labeled btn-primary" href="{{URL::action('ClienteController@edit',$cliente->idcliente)}}">
                          <span class="btn-label"><i class="fa fa-pencil"></i></span>Actualizar</a>

                      <button type="button" class="btn btn-labeled btn-danger pull-right" href="#">
                          <span class="btn-label"><i class="fa fa-print"></i></span>Imprimir</button>
                  </div>
              </div>
              
          </div>
          <div class="row overview">
              <div class="col-md-4 user-pad text-center">
                  <h3>CARTERA</h3>
                  <h4 class="text-uppercase">{{$cartera->nombre}}</h4>
              </div>
              <div class="col-md-4 user-pad text-center">
                  <h3>CATEGORIA</h3>
                  <h4 class="text-uppercase">{{$categoria->letra}}</h4>
              </div>
              <div class="col-md-4 user-pad text-center">
                  <h3>ESTADO</h3>
                  <h4 class="text-uppercase">{{$cliente->estado}}</h4>
              </div>
          </div>
      </div>
    </div>

  </div>

  <div class="col-lg-8 col-md-7 col-sm-8 col-xs-12">

      <div data-spy="scroll" class="tabbable-panel">
        <div class="tabbable-line">
          <ul class="nav nav-tabs tipografia">
            <li class="active">
              <a href="#tab_default_1" data-toggle="tab">
              Negocios </a>
            </li>
            <li>
              <a href="#tab_default_2" data-toggle="tab">
              Codeudores </a>
            </li>
            <li>
              <a href="#tab_default_3" data-toggle="tab">
              Garantias </a>
            </li>
             <li>
              <a href="#tab_default_4" data-toggle="tab">
              Comentarios </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_default_1">
              @foreach ($negocios as $ma)
              <div class="row profile-comments__item">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <div class="form-group">
                    <p class="tipografia">Nombre:</p>
                    <p  class="text-muted" > {{ $ma->nombre }}</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                  <div class="form-group">
                    <p class="tipografia">Actividad Económica:</p>
                    <p  class="text-muted"> {{ $ma->actividadeconomica }}</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <div class="form-group">
                    <p class="tipografia">Dirección:</p>
                    <p class="text-muted"> {{ $ma->direccionnegocio }}</p>
                 </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                  <div class="form-group">
                      <p class="tipografia">
                        <a href="{{URL::action('NegocioController@edit',$ma->idnegocio)}}"><i > editar</i></a></p>
                      </p>
                      <p class="text-muted"> <a href="{{URL::action('NegocioController@edit',$ma->idnegocio)}}"><i > eliminar</i></a></p>
                   </div>
                </div>
              </div>
              @endforeach
            </div>

            <div class="tab-pane" id="tab_default_2">
              <div class="tab-pane active" id="tab_default_1">
              @foreach ($codeudores as $codeudor)
                <div class="row profile-comments__item">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="form-group">
                      <p class="tipografia">Nombre:</p>
                      <p  class="text-muted" > {{ $codeudor->nombre }} {{ $codeudor->apellido }}</p>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="form-group">
                      <p class="tipografia">Profesion:</p>
                      <p  class="text-muted"> {{ $codeudor->profesion }}</p>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                      <p class="tipografia">Teléfonos:</p>
                      <p class="text-muted"> {{ $codeudor->telefonocel }}, {{ $codeudor->telefonofijo }}</p>
                   </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                      <p class="tipografia">
                        <a href="{{URL::action('CodeudorController@show',$codeudor->idcodeudor)}}"><i> ver</i></a>
                      </p>
                      <p class="text-muted"> <a href="{{URL::action('CodeudorController@edit',$codeudor->idcodeudor)}}"><i> editar</i></a></p>
                      <p class="text-muted"> <a href="{{URL::action('CodeudorController@edit',$codeudor->idcodeudor)}}"><i > eliminar</i></a></p>
                   </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <div class="tab-pane" id="tab_default_3">
              <p>
                Family Details
              </p>
            </div>

             <div class="tab-pane" id="tab_default_4">
              @foreach ($observaciones as $observacion)
                <div class="row profile-comments__item">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group">
                      <p class="tipografia">Fecha:</p>
                      <p  class="text-muted" > {{ $observacion->fecha }}</p>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group">
                      <p class="tipografia">Responsable:</p>
                      <p  class="text-muted"> {{ $observacion->responsable }}</p>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                      <p class="tipografia">Comentario:</p>
                      <p class="text-muted"> {{ $observacion->comentario }}</p>
                   </div>
                  </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <div class="form-group">
                      <p class="tipografia">
                        <a href="{{URL::action('ObservacionController@edit',$observacion->idobservacion)}}"><i> editar</i></a>
                      </p>
                      <p class="text-muted"> <a href="{{URL::action('ObservacionController@edit',$observacion->idobservacion)}}"><i > eliminar</i></a></p>
                   </div>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
  </div>
  
</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h4 style="text-align:center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #1C2331; float: right;">
      {{$fecha_actual}}</h4>
  </div>
</div>

@endsection