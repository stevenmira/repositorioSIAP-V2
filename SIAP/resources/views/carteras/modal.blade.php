<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$cartera->idcartera}}">
	{{Form::Open(array('action'=>array('CarteraController@destroy',$cartera->idcartera),'method'=>'delete'))}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">INACTIVAR &nbsp; CARTERA</h4>
				
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">
				<p>confirme si desea inactivar la cartera</p>
				<p style="text-align: center;">-- {{ $cartera->nombre }} --</p>
			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
				
			</div>
			
		</div>
		
	</div>
	{{Form::Close()}}
	
</div>