<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->idcliente}}">
	{{Form::Open(array('action'=>array('ClienteController@destroy',$ma->idcliente),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Inhabilitar Cliente</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;text-shadow: 0 0 0.2em #cfd8dc;">

				<h4 style="padding: 0px 25px 15px 10px;">
					Confirme si desea dar de baja el cliente
				</h4>

				<p style="font-size: 14px;">
					--  <span style="padding: 10px 0px 10px 0px;"> {{ $ma->nombre }} {{$ma->apellido}} </i></span> --
				</p>
			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>