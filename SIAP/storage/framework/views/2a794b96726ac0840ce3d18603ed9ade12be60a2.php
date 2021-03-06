<?php echo Form::open(array('url'=>'ingresarPago','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="row">
	<div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-0">
		<div class="form-group">
			<label for="matricula">Selecciona el cliente</label>
			<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="-- Introduzca el criterio de búsqueda --">
				<?php foreach($consulta as $cliente): ?>
				<option value="<?php echo e($cliente->dui); ?>"><?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?> DUI:  <?php echo e($cliente->dui); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="col-md-1 col-sm-1 col-xs-1">
		<label>Acción</label>
		<div class="input-group">
			<span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar</button></span>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="form-group col-md-2 col-lg-2 col-sm-2">
          <a href="" data-target="#modal-help" data-toggle="modal"><i class="fa fa-info-circle"> AYUDA</i></a>
          <?php echo $__env->make('cliente.modal3', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
	</div>
	
</div>
<?php echo e(Form::close()); ?>