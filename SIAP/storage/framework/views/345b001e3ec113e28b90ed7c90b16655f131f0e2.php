<?php echo Form::open(array('url'=>'categorias','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="form-group">
	<div class="input-group">
		

		

		  <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-0">
			<div class="form-group">
				<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="Seleccione o Busque una Categoria">
					<?php foreach($categorias as $categoria): ?>
					<option value="<?php echo e($categoria->letra); ?>"><?php echo e($categoria->letra); ?></option>
					<?php endforeach; ?>
				  </select>
			</div>
		</div>
		  
		  

		  <div class="col-md-2 col-sm-6 col-xs-6">
			
			<div class="input-group">
				<span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar</button></span>
			</div>
		</div>	
	</div>
</div>

<?php echo e(Form::close()); ?>