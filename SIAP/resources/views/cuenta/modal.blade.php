<div class="modal  fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$cuenta->idcuenta}}">
	{{Form::Open(array('action'=>array('CuentaController@destroy',$cuenta->idcuenta),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">CONFIGURACIÓN &nbsp; DE &nbsp; CUENTA</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<p>
					Confirme si desea cambiar al estado

					@if($cuenta->estado == "ACTIVO")
					INACTIVO 
					@else
					ACTIVO
					@endif

					la cuenta del cliente
				</p>
                <p style="text-align: center;">-- {{ $cliente->nombre }} {{$cliente->apellido}} --</p>

                <p>asociada al negocio</p>
                <p style="text-align: center;">-- {{ $negocio->nombre }} --</p>

                <br>

			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>