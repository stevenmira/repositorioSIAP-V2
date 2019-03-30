<?php $__env->startSection('contenido'); ?>

<style>
  .errors{
    background-color: #fcc;
    border: 1px solid #966;
  }
</style>

<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo e(url('home')); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active"> Nuevo</li>
     <li class="active"> Refinanciamiento</li>
  </ol>
</section>

<br>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">ASESORES FINANCIEROS MICRO IMPULSADORES DE NEGOCIOS</h4>
<h4 style="text-align: center; font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333;">AFIMID, S.A DE C.V</h4>
  
<h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 40px 0px 25px 0px;"><b>NUEVO REFINANCIAMIENTO</b></h4>

<?php echo Form::open(array('url'=>'refinanciamiento','method'=>'POST','autocomplete'=>'off')); ?>

            <?php echo e(Form::token()); ?>


<div class="container">

    <div class="row">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if(count($errors) > 0): ?>
        <div class="errors">
          <ul>
            <p><b>Por favor, corrige lo siguiente:</b></p>
            <?php $cont = 1; ?>
          <?php foreach($errors->all() as $error): ?>
            <li><?php echo e($cont); ?>. <?php echo e($error); ?></li>
            <?php $cont=$cont+1; ?>
          <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      </div>
    </div>

    <div class = "row">
      <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <label for="edad">Fecha del Crédito</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </div>
          <?php echo Form::date('fechacredito', null, ['class' => 'form-control' , 'required' => 'required', 'autofocus'=>'on', 'id'=>'pfechacredito']); ?>

        </div>
      </div>
      <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <label>Comienzo de la cartera de pagos</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </div>
          <?php echo Form::date('fechacomienzo', null, ['class' => 'form-control' , 'required' => 'required', 'id'=>'pfechacomienzo']); ?>

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
          <?php echo Form::text('numcheque', null, ['class' => 'form-control', 'disabled'=>'disabled', 'placeholder'=>' . . .', 'maxlength'=>'50', 'id'=>'pnumcheque']); ?>

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
            <?php foreach($clientes as $cliente): ?>
            <option value="<?php echo e($cliente->idcliente); ?>"><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label>Negocio/s del cliente</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-briefcase" aria-hidden="true"></i>
          </div>
          <?php echo Form::select('idnegocio',['placeholder'=>'---------------------'],null,['id'=>'negocioItem','class'=>'form-control','required' => 'required']); ?>

        </div>
      </div> 

      <div class="form-group col-lg-4  col-md-4 col-sm-12 col-xs-12">
        <label>Codeudor/s del cliente</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
          <?php echo Form::select('idcodeudor',['placeholder'=>'---------------------'],null,['id'=>'codeudorItem','class'=>'form-control']); ?>

        </div>
      </div> 
    </div>

    <div class="row">
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="nombre">Tasa de Interés</label>
          <select name="idtipocredito"  class="form-control selectpicker" data-Live-search="true" title="Seleccione o Busque la tasa que desar aplicar" required>
            <?php foreach($interesList as $interes): ?>
              <option value="<?php echo e($interes->idtipocredito); ?>"><?php echo e($interes->interes*100); ?>%</option>
            <?php endforeach; ?>
          </select>
      </div> 
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="monto">Monto a Otorgar</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
         </div>
          <?php echo Form::number('monto', null, ['class' => 'form-control' , 'required' => 'required','max'=>'10000','min'=>'50','step'=>'0.01', 'placeholder'=>'Escriba el Monto a ser Otorgado', 'id'=>'pmonto']); ?>

        </div>
      </div>
      <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <label for="direccionCliente">Cuota del Cliente (en dolares)</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-money" aria-hidden="true"></i>
          </div>
          <?php echo Form::number('cuota', null, ['class' => 'form-control' , 'required' => 'required','min'=>'0','step'=>'0.01',  'placeholder'=>'Introduzca la cuota del cliente', 'id'=>'pcuota']); ?>

        </div>
      </div>        
    </div>

    <div style="text-align: center;" class="row">
      <a data-target="#modal-help" data-toggle="modal">
        <i class="fa fa-info-circle" aria-hidden="true">¿Ayuda sobre las tasas aplicables?</i>
      </a>
      <?php echo $__env->make('tipoCredito.refinanciamiento.modalAyuda', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="row">
      <h4 style="text-align: center;font-family:  'Trebuchet MS', Helvetica, sans-serif; color: #333333; padding: 30px 0px 20px 0px;"><b>VERIFIQUE LOS ESTADO DEL PRÉSTAMO ANTERIOR</b></h4>
      <p id="pres"></p>
      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <label>Estado Cuenta</label>
        <div class="input-group">
          <?php echo Form::text('estadocuenta', null, ['class' => 'form-control', 'id'=>'estadocuenta', 'disabled' => 'on']); ?>

        </div>
      </div>
      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <label>Estado Préstamo</label>
        <div class="input-group">
          <?php echo Form::text('estadoprestamo', null, ['class' => 'form-control', 'id'=>'estadoprestamo', 'disabled' => 'on']); ?>

        </div>
      </div>
      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <label>Saldo Capital Anterior</label>
        <div class="input-group">
          <?php echo Form::number('capitalanterior', null, ['class' => 'form-control','required' => 'required', 'min'=>'0','step'=>'0.01', 'id'=>'capitalanterior']); ?>

        </div>  
      </div> 
      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <label>Cuotas atrasadas</label>
        <div class="input-group">
          <?php echo Form::number('cuotaatrasada', null, ['class' => 'form-control','required' => 'required','min'=>'0','step'=>'0.01', 'id'=>'cuotaatrasada']); ?>

        </div>
      </div>
      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <label>Mora</label>
        <div class="input-group">
          <?php echo Form::number('mora', null, ['class' => 'form-control','required' => 'required','min'=>'0','step'=>'0.01', 'id'=>'mora']); ?>

        </div>
      </div>
      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <label> Cancelar con Ref.</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
          </div>
          <input type="radio" name="tipo3"  value="SI" checked> SI<br>
          <input type="radio" name="tipo3"  value="NO"> NO
        </div>
      </div>
      
    </div>
</div>



<div class="row">
  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="guardar">
    <a href="<?php echo e(URL::action('ClienteController@index')); ?>" class="btn btn-danger btn-lg pull-left"><i class="fa fa-times" aria-hidden="true"></i>   Cancelar</a>
    <div class="form-group btn-md-2 pull-right">
        <a class="btn btn-success btn-lg pull-right" data-target="#modal-verificar" data-toggle="modal" id="bt_add">Siguiente</a>
        <?php echo $__env->make('tipoCredito.refinanciamiento.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
  </div> 
</div>


<?php echo Form::close(); ?>


<?php $__env->startPush('scripts'); ?>

<!--Autocomplete-->
<script src="<?php echo e(asset('js/search/autocomplete.js')); ?>"></script>
<script src="<?php echo e(asset('js/search/autocompleteCodeudor.js')); ?>"></script>
<script src="<?php echo e(asset('js/search/saldos.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>

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

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>