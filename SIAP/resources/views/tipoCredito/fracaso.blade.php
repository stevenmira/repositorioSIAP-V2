@extends ('layouts.inicio')
@section('contenido')

<!-- Select CSS -->
<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{asset('css/table.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"> Nuevo </li>

    @if(Session::has('bandera'))
    <li class="active">Financiamiento</li>
    @endif
    @if(Session::has('ban'))
    <li class="active">Refinanciamiento</li>
    @endif

    <li class="active"> Fracaso </li>
  </ol>
</section>
<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;">
  <b>
    @if(Session::has('bandera'))
        NUEVO CRÉDITO COMPLETO
        @endif
        @if(Session::has('ban'))
        NUEVO REFINANCIAMIENTO
    @endif
  </b>
</h4>
<div class="row text-center">
  <h2><i class="fa fa-info-circle"> Ha Ocurrido un Error  </i></h2>
</div>
<br>
    <!-- Notificación -->
 
<div class="container" style="text-align:center; font-family:'Trebuchet MS', Helvetica, sans-serif; color: #1C2331;">
    
    @if (Session::has('msj1'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj1')}}</b>  </h4>
    </div>
    @endif

    @if (Session::has('msj2'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj2')}}</b>  </h4>
    </div>
    @endif

    @if (Session::has('msj3'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj3')}}</b>  </h4>
    </div>
    @endif

    @if (Session::has('msj4'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj4')}}</b>  </h4>
    </div>
    @endif

    @if (Session::has('msj5'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj5')}}</b>  </h4>
    </div>
    @endif
  
    @if (Session::has('fallo'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('fallo')}}</b>  </h4>
    </div>
    @endif 

    <!-- Redefinir Cuota -->
    @if(Session::has('msj6'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> {{ Session::get('msj6')}}  </h4>
    </div>
    @endif

    <!-- Categoria E -->
    @if(Session::has('msj7'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4> {{ Session::get('msj7')}}  </h4>
    </div>
    @endif

    <!-- No posee credito para refinanciar -->
    @if(Session::has('msj8'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj8')}}</b>. Puede abrir un nuevo credito pulsando 
        <a href="{{url('credito/create')}}">AQUI</a></h4>
    </div>
    @endif

    <!-- Abonos pendientes de pago -->
    @if (Session::has('msj9'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('msj9')}}</b> Puede revisar la 
        <a href="{{url('cuenta/carteraPagos/'.$cuenta)}}">cartera de pago</a>  
      </h4>
    </div>
    @endif
  
    @if (Session::has('error1'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('error1')}}</b>  </h4>
    </div>
    @endif
  
    



    @if(Session::has('error8'))
    <div class="alert  fade in" style="background:  #ff8a80;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>   <b>{{ Session::get('error8')}}</b>. Puede revisar la <a href="{{url('cuenta/carteraPagos/'.$cuenta)}}">cartera de pago</a></h4>
    </div>
    @endif

</div>

    <!-- Fin Notificación -->


  <div class="container">
    <div class="row text-center">
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="pricing-table">
                <div class="panel panel-primary" style="border: none;">
                    <div class="controle-header panel-heading panel-heading-landing">
                        <h1 class="panel-title panel-title-landing">
                          
                        </h1>
                    </div>
                    <div class="controle-panel-heading panel-heading panel-heading-landing-box">
                           Intentelo Nuevamente
                    </div>
                    
                    <div class="panel-footer panel-footer-landing">
                            @if(Session::has('bandera'))
                        <a href="{{URL::action('TipoCreditoController@create')}}"  class="btn btn-price btn-danger btn-lg">Nuevo Credito Completo</a>
                        @endif
                        @if(Session::has('ban'))
                        <a href="{{URL::action('RefinanciamientoController@create')}}"  class="btn btn-price btn-danger btn-lg">Nuevo Refinanciamiento</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')


<!-- InputMask -->
<script src="{{asset('js/inputmask/jquery3.js')}}"></script>  
<script src="{{asset('js/inputmask/input-mask.js')}}"></script>
<script src="{{asset('js/inputmask/input-mask-date.js')}}"></script>


<!-- Select -->
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!--Autocomplete-->
<script src="{{asset('js/search/autocomplete.js')}}"></script>

<script src="{{asset('js/popover.js')}}"></script>

<script>
  $(function () {
    //Money Euro
    $('[data-mask]').inputmask()

  })
</script>


<!--searchphp-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endpush


@endsection