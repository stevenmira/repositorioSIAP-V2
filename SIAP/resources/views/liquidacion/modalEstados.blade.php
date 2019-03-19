<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalEsta2-delete-{{$ma->iddetalleliquidacion}}">
	{{Form::Open(['action'=>'LiquidacionController@updateEstado'])}}
	    	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #3F729B; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Modificar Estado de Cuota</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<h4 style="padding: 0px 25px 15px 10px; text-align: center;">
					Seleccione el estado de la cuota
				</h4>
				<div class="row" style="padding: 0px 25px 15px 25px;">
				<aside class="col-md-5 col-lg-5">
					<p>DIA: </p>
					<p>FECHA:</p>
					<p>MONTO: </p>
					<p>INTERES: </p>
					<p>CUOTA CAPITAL:</p>
					<p>TOTAL DIARIO:</p>
					@if( $ma->fechaefectiva != null)
					<p>FECHA EFECTIVA DE PAGO: </p>
					@else
					<p>FECHA EFECTIVA DE PAGO: </p>
					@endif
					<p>ESTADO DE LA CUOTA: </p>
				</aside>
				<aside class="col-md-5 col-lg-5">
					<p> {{ $ma->contador }} </p>
					<p> {{ $ma->fechadiaria->format('l j  F Y ') }} </p>
					<p> $ {{ $ma->monto }} </p>
					<p> $ {{ $ma->interes }} </p>
					<p> $ {{ $ma->cuotacapital }} </p>
					<p> $ {{ $ma->totaldiario }} </p>
					@if( $ma->fechaefectiva != null)
					<p> {{ $ma->fechaefectiva->format('l j  F Y ') }} </p>
					@else
					<p> -- VACIO --</p>
					@endif
					<select name="nombre" class="form-control">
		                @foreach ($estadosCuota as $gr)
		                  @if ($gr->nombre == $ma->estado)
		                  <option value="{{$gr->nombre}}" selected>{{$gr->nombre}}</option>
		                  @else
		                  <option value="{{$gr->nombre}}">{{$gr->nombre}}</option>
		                  @endif
		                @endforeach
		             </select>
				</aside>
				</div>
			</div>
			<div class="modal-footer" style="background: #3F729B;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Actualizar</button>
			</div>
		</div>
	</div>

	<input type="text" name="iddetalleliquidacion" hidden="on" value="{{$ma->iddetalleliquidacion}}">
	{{Form::Close()}}
</div>