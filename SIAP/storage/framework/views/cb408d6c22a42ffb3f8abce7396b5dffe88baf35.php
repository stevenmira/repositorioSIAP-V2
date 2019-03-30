<?php echo Form::open(array('url'=>'supervisores/inactivos','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="row">
	<div class="col-md-8 col-sm-8 col-xs-6 col-md-offset-0">
		<div class="form-group">
			<label for="supervisor">Selecciona el supervisor</label>
			<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="-- Introduzca el criterio de búsqueda --">
				<?php foreach($consulta as $supervisor): ?>
				<option value=""><?php echo e($supervisor->nombre); ?> <?php echo e($supervisor->apellido); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="col-md-2 col-sm-6 col-xs-6">
		<label>Acción</label>
		<div class="input-group">
			<span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar</button></span>
		</div>
	</div>	
	
</div>

<?php echo e(Form::close()); ?>