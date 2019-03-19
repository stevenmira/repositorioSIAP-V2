<?php echo Form::open(array('url'=>'ejecutivo','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="row">
	<div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-0">
		<div class="form-group">
			<label for="matricula">Selecciona el ejecutivo</label>
			<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="-- Introduzca el criterio de búsqueda --">
				<?php foreach($consulta as $ejecutivo): ?>
				<option value="<?php echo e($ejecutivo->apellido); ?>"><?php echo e($ejecutivo->nombre); ?> <?php echo e($ejecutivo->apellido); ?></option>
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


	
</div>
<?php echo e(Form::close()); ?>

