<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalCategoria-delete-{{$cliente->idcliente}}">
	{!!Form::open(array('url'=>'ingresarPago','method'=>'POST','autocomplete'=>'off', 'onsubmit'=> 'return checkSubmit();'))!!}
            {{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #3F729B; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Modificar Categoria</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; font-family:'Trebuchet MS', Helvetica, sans-serif;text-shadow: 0 0 0.2em #cfd8dc;">

				<h4 style="padding: 0px 25px 15px 10px; text-align: center;">
					Seleccione la categoria
				</h4>
				<table>
					<tr>
						<td style="width: 100px; padding: 0px 25px 15px 10px;">Cliente:</td>
						<td style="padding: 0px 25px 15px 10px;">{{ $cliente->nombre }} {{$cliente->apellido}}</td>
					</tr>
					<tr>
						<td style="width: 100px; padding: 0px 25px 15px 10px;">Categoria:</td>
						<td style="padding: 0px 25px 15px 10px;">
			              <select name="idcategoria" class="form-control">
			                @foreach ($categorias as $gr)
			                  @if ($gr->idcategoria == $categoria->idcategoria)
			                  <option value="{{$gr->idcategoria}}" selected>{{$gr->letra}}</option>
			                  @else
			                  <option value="{{$gr->idcategoria}}">{{$gr->letra}}</option>
			                  @endif
			                @endforeach
			              </select>
			              <input type="text" name="idcliente" hidden="on" value="{{$cliente->idcliente}}">
			              <input type="text" name="idcuenta" hidden="on" value="{{$cuenta->idcuenta}}">
						</td>
					</tr>
				</table>

				<div style="border-color:#212121; border-style:dashed; border-width:2px; padding: 10px 10px 10px 25px;">
					<p style="font-weight: bold;" align="center">Tabla de Categorías</p>
					<table>
						<tr>
							<td style="width: 80px; font-weight: bold;">Letra</td>
							<td style="width: 120px; font-weight: bold;">Calificación</td>
							<td style="width: 200px; font-weight: bold;">Descripción</td>
						</tr>
						@foreach ($categorias as $cat)
						<tr>						
							<td style="width: 80px;">{{$cat->letra}}</td>
							<td style="width: 120px;">{{$cat->calificacion}}</td>
							<td style="width: 200px;">{{$cat->descripcion}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
			<div class="modal-footer" style="background: #3F729B;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Actualizar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>