@extends ('layouts.inicio')
@section('contenido')
<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Anton|Roboto');

  .word {
    font-family: 'Anton', sans-serif;
    perspective: 1000px; 
    perspective-origin: 200px 40px;
  }

  .word span {
    cursor: pointer;
    display: inline-block;
    font-size: 100px;
    user-select: none;
    line-height: .8;
  }

  .word span:nth-child(1).active {
    animation: balance 1.5s ease-out;
    transform-origin: 0% 100% 0px;
  }

  @keyframes balance {
    0%, 100% {
      transform: rotate(0deg);
    }
    
    30%, 60% {
      transform: rotate(-45deg);
    }
  }

  .word span:nth-child(2).active {
    animation: shrinkjump 1s ease-in-out;
    transform-origin: bottom center;
  }

  @keyframes shrinkjump {
    10%, 35% {
      transform: scale(2, .2) translate(0, 0);
    }
    
    45%, 50% {
      transform: scale(1) translate(0, -150px);
    }
    
    80% {
      transform: scale(1) translate(0, 0);
    }
  }

  .word span:nth-child(3).active {
    animation: falling 2s ease-out;
    transform-origin: bottom center;
  }

  @keyframes falling {
    12% {
      transform: rotateX(240deg);
    }
    
    24% {
      transform: rotateX(150deg);
    }
    
    36% {
      transform: rotateX(200deg);
    }
    
    48% {
      transform: rotateX(175deg);
    }
    
    60%, 85% {
      transform: rotateX(180deg);
    }
    
    100% {
      transform: rotateX(0deg);
    }
  }

  .word span:nth-child(4).active {
    animation: rotate 1s ease-out;
  }

  @keyframes rotate {
    20%, 80% {
      transform: rotateY(180deg);
    }
    
    100% {
      transform: rotateY(360deg);
    }
  }

  .word span:nth-child(5).active {
    animation: toplong 1.5s linear;
  }

  @keyframes toplong {
    10%, 40% {
      transform: translateY(-48vh) scaleY(1);
    }
    
    90% {
      transform: translateY(-48vh) scaleY(4);
    }
  }

  /* Other styles */
  .box {
    background-color: #fff;
    color: #212121;
    font-family: 'Roboto', sans-serif;
    
    width:100%;
  }

  h2,h3,h4 {
    text-align: center; 
    font-family:  'Trebuchet MS', Helvetica, sans-serif; 
    color: #000;
  }
  a{
    color: #212121;
  }

  /* mouse over link */
  a:hover {
    color: green;
  }

</style>
<br>
<h4>ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4>AFIMID, S.A DE C.V</h4>

<br><br>
<div class="clearfix" style="text-align:center">
  <div style="text-align: center;" class="word">
    <span>S</span>
    <span>I</span>
    <span>A</span>
    <span>P</span>
  </div>  
    <h5>BIENVENIDO <b> {{$usuarioactual->nombre}} </b>!</h5> 
</div>
<br><br>

<div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" align="center">
        <a href="{{URL::action('calcularCreditoController@create')}}">
          <span class="fa fa-calculator fa-3x"></span>
          <h3>Cálcular Crédito</h3>
        </a>
      </div>

      @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('TipoCreditoController@create')}}">
          <span class="fa fa-money fa-3x"></span><i class="fab fa-cuttlefish"></i>
          <h3>Crédito Completo</h3>
        </a>
      </div>
      @endif

      @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('RefinanciamientoController@create')}}">
          <span class="fa fa-money fa-3x"></span>
          <h3>Refinanciamiento</h3>
        </a>
      </div>
      @endif

      <div class="col-md-3" align="center">
        <a href="{{URL::action('RecordClienteController@index')}}">
          <span class="fa fa-info-circle fa-3x"></span>
          <h3>Record de cliente</h3>
        </a>
      </div>

       @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('CarteraController@index')}}">
          <span class="fa fa-contao fa-3x"></span>
          <h3>Gestión de Carteras</h3>
        </a>
      </div>
      @endif

      @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('ClienteController@index')}}">
          <span class="fa fa-male fa-3x"></span>
          <span class="fa fa-female fa-3x"></span>
          <h3>Gestion de Clientes</h3>
        </a>
      </div>
      @endif


      
      @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('ReportesController@lista')}}">
          <span class="fa fa-file fa-3x"></span><i class="fab fa-cuttlefish"></i>
          <h3>Reportes</h3>
        </a>
      </div>
      @endif

      @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('EmpleadoController@indexPersonal')}}">
          <span class="fa fa-users fa-3x"></span>
          <h3>Gestión de Personal</h3>
        </a>
      </div>
      @endif

      @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('UsuarioController@index')}}">
          <span class="fa fa-user-plus fa-3x"></span>
          <h3>Gestión de Usuarios </h3>
        </a>
      </div>
      @endif
    </div>
</div>

<script type="text/javascript">
  let spans = document.querySelectorAll('.word span');
  spans.forEach((span, idx) => {
    span.addEventListener('click', (e) => {
      e.target.classList.add('active');
    });
    span.addEventListener('animationend', (e) => {
      e.target.classList.remove('active');
    });
    
    // Initial animation
    setTimeout(() => {
      span.classList.add('active');
    }, 750 * (idx+1))
  });

  /* Demo purposes only */
$(".hover").mouseleave(
  function () {
    $(this).removeClass("hover");
  }
);

</script>
@endsection