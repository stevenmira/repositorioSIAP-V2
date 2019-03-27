@extends ('layouts.inicio')
@section ('contenido')

<style type="text/css">
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
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>

<div style="text-align:center">
  <img src="../img/logo.png"  width="200" height="200">
</div>

<div class="container">
  <div class="row">

    @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('ReportesController@carteraPagos')}}">
          <span class="fa fa-file fa-3x"></span><i class="fab fa-cuttlefish"></i>
          <h3>Cartera de Pagos</h3>
        </a>
      </div>
    @endif

    @if($usuarioactual->idtipousuario==1)
      <div class="col-md-3" align="center">
        <a href="{{URL::action('ReportesController@controlCreditos')}}">
          <span class="fa fa-file fa-3x"></span><i class="fab fa-cuttlefish"></i>
          <h3>Control de Créditos</h3>
        </a>
      </div>
    @endif

  </div>
</div>
<br><br>
<div class="row">
  <a href="{{ url('home')}}" class="btn btn-danger btn-lg col-md-offset-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás</a>
</div>

@endsection
