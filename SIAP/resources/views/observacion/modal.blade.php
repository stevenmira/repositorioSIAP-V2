<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->idobservacion}}">
	{{Form::Open(array('action'=>array('ObservacionController@destroy',$ma->idobservacion),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content" style="color: #000;">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
	                 <span aria-hidden="true">×</span>
	            </button>
	            <h4 class="modal-title">Eliminar Comentario</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; font-family:'Trebuchet MS', Helvetica, sans-serif;text-shadow: 0 0 0.2em #cfd8dc;">
				<h4 style="padding: 0px 25px 15px 10px; text-align: center;">
					Confirme si desea eliminar el comentario
				</h4>

				<p style="font-size: 14px;">
					Responsable: <span style="padding: 10px 25px 0px 10px;">{{ $ma->responsable }}</span>
				</p>

				<p style="font-size: 14px;">
					 Comentario: 
				</p><span style="padding: 5px 0px 0px 0px;">{{ $ma->comentario }}</span>


			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>