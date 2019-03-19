{!! Form::open(array('url'=>'ingresarPago','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">
	<div class="col-md-5 col-sm-5 col-xs-5 col-md-offset-0">
		<div class="form-group">
			<label for="matricula">Selecciona el cliente</label>
			<select name="searchText"  class="form-control selectpicker" id="searchText" data-Live-search="true" title="-- Introduzca el criterio de búsqueda --">
				@foreach($consulta as $cliente)
				<option value="{{ $cliente->dui }}">{{$cliente->nombre}} {{$cliente->apellido}} DUI:  {{$cliente->dui}}</option>
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

	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="form-group col-md-2 col-lg-2 col-sm-2">
          <a href="" data-target="#modal-help" data-toggle="modal"><i class="fa fa-info-circle"> AYUDA</i></a>
          @include('cliente.modal3')
        </div>
	</div>
	
</div>
{{Form::close()}}