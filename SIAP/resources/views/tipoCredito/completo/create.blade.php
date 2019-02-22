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
    <li class="active">Nuevo Financiamiento</li>
  </ol>
</section>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVO CRÉDITO COMPLETO</b></h4>

{!!Form::open(array('url'=>'credito','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

<div class="container">

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

    <div class = "row">
      <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <label for="edad">Fecha del Crédito</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </div>
          {!! Form::date('fechacredito', null, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on', 'id'=>'pfechacredito']) !!}
        </div>
      </div>
      <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <label>Comienzo de la cartera de pagos</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </div>
          {!! Form::date('fechacomienzo', null, ['class' => 'form-control' , 'required' => 'required', 'id'=>'pfechacomienzo']) !!}
        </div>
      </div>

      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <label for="nit">Cobro de Comisión</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
          </div>
          <input type="radio" name="tipo1" id="ptipo1" value="SI" checked> SÍ<br>
          <input type="radio" name="tipo1" value="NO"> NO<br>
        </div>
      </div>

      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <label for="nit">Tipo de Desembolso</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
          </div>
          <input type="radio" name="tipo2" id="ptipo2" value="SI" onclick="numcheque.disabled = true; numcheque.value ='';" checked> Efectivo<br>
          <input type="radio" name="tipo2"  value="NO" onclick="numcheque.disabled = false;"> Cheque
        </div>
      </div>

      <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <label for="lugar">Número de Cheque</label>
        <div class="input-group">
          {!! Form::text('numcheque', null, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder'=>' . . .', 'maxlength'=>'50', 'id'=>'pnumcheque']) !!}
        </div>
      </div>
    </div>

    <div class="row"> 
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="nombre">Nombres del cliente</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
           <select name="searchItem"  class="form-control selectpicker" id="searchItem" data-Live-search="true" title="Seleccione o Busque un Cliente" required>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->idcliente }}">{{$cliente->nombre}} {{$cliente->apellido}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label>Negocio/s del cliente</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-briefcase" aria-hidden="true"></i>
          </div>
          {!!Form::select('idnegocio',['placeholder'=>'---------------------'],null,['id'=>'negocioItem','class'=>'form-control','required' => 'required'])!!}
        </div>
      </div> 

      <div class="form-group col-lg-4  col-md-4 col-sm-12 col-xs-12">
        <label>Codeudor/s del cliente</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
          {!!Form::select('idcodeudor',['placeholder'=>'---------------------'],null,['id'=>'codeudorItem','class'=>'form-control'])!!}
        </div>
      </div> 
    </div>

    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="nombre">Tasa de Interés</label>
          <select name="idtipocredito"  class="form-control selectpicker" data-Live-search="true" title="Seleccione o Busque la tasa que desar aplicar" required>
            @foreach($interesList as $interes)
              <option value="{{ $interes->idtipocredito }}">{{$interes->interes*100}}%</option>
            @endforeach
          </select>
      </div> 
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="monto">Monto a Otorgar</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
         </div>
          {!! Form::number('monto', null, ['class' => 'form-control' , 'required' => 'required','max'=>'10000','min'=>'50','step'=>'0.01', 'placeholder'=>'Escriba el Monto a ser Otorgado', 'id'=>'pmonto']) !!}
        </div>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="direccionCliente">Cuota del Cliente (en dolares)</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-money" aria-hidden="true"></i>
          </div>
          {!! Form::number('cuota', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0','step'=>'0.01',  'placeholder'=>'Introduzca la cuota del cliente', 'id'=>'pcuota']) !!}
        </div>
      </div>        
    </div>

    <div style="text-align: center;" class="row">
      <a data-target="#modal-help" data-toggle="modal">
        <i class="fa fa-info-circle" aria-hidden="true">¿Ayuda sobre las tasas aplicables?</i>
      </a>
      @include('tipoCredito.completo.modalAyuda')
    </div>
       

</div>

<div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
    <a href="{{URL::action('ClienteController@index')}}" class="btn btn-danger btn-lg pull-left"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
    <div class="form-group btn-md-2 pull-right">
        <a class="btn btn-success btn-lg pull-right" data-target="#modal-verificar" data-toggle="modal" id="bt_add">Siguiente</a>
        @include('tipoCredito.completo.modal')
      </div>
  </div> 
</div>


{!!Form::close()!!}

@push('scripts')

<!--Autocomplete-->
<script src="{{asset('js/search/autocomplete.js')}}"></script>
<script src="{{asset('js/search/autocompleteCodeudor.js')}}"></script>
@endpush

@push('scripts')

<script>
  $(document).ready(function(){
        $('#bt_add').click(function(){
            review();
        });
    });

  function review(){
    fechacredito = String(document.getElementById("pfechacredito").value);
    fechacomienzo = String(document.getElementById("pfechacomienzo").value);
    tipo1 = document.getElementById("ptipo1");
    tipo2 = document.getElementById("ptipo2");
    numcheque = String(document.getElementById("pnumcheque").value);
    monto = parseFloat(document.getElementById("pmonto").value);
    cuota = parseFloat(document.getElementById("pcuota").value);

    if (fechacredito == "") {
    fechacredito = " -- VACIO  --";
    }else{
      fechacredito = formato(fechacredito);
    }

    if (fechacomienzo == "") {
    fechacomienzo = " -- VACIO  --";
    }else{
      fechacomienzo = formato(fechacomienzo);
    }

    if (tipo1.checked){
      tipo1 = "SI";
    }else{
      tipo1 = "NO";
    }

    if (tipo2.checked){
      tipo2 = "Efectivo";
    }else{
      tipo2 = "Cheque";
    }

    if (numcheque == "") {
    numcheque = " -- VACIO  --";
    }    

    if (isNaN(monto)) {
    monto = " -- VACIO  --";
    }

    if (isNaN(cuota)) {
    cuota = " -- VACIO  --";
    }

    document.getElementById("rfechacredito").innerHTML = fechacredito;
    document.getElementById("rfechacomienzo").innerHTML = fechacomienzo;
    document.getElementById("rtipo1").innerHTML = tipo1;
    document.getElementById("rtipo2").innerHTML = tipo2;
    document.getElementById("rnumcheque").innerHTML = numcheque;
    document.getElementById("rmonto").innerHTML = monto;
    document.getElementById("rcuota").innerHTML = cuota;
      
    //document.getElementById("new_montocapital").innerHTML = new_montocapital;

  }

  function formato(texto){
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
  }

</script>

@endpush

@endsection