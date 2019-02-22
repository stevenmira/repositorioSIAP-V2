{!! Form::open(array('url'=>'supervisor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
	<div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-0">
		<div class="form-group">
			<label for="matricula">Selecciona el supervisor</label>
			<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="-- Introduzca el criterio de búsqueda --">
				@foreach($consulta as $supervisor)
				<option value="{{ $supervisor->apellido }}">{{$supervisor->nombre}} {{$supervisor->apellido}}</option>
				@endforeach
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
{{Form::close()}}