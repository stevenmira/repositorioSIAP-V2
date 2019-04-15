<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->idcodeudor}}">
	{{Form::Open(array('action'=>array('CodeudorController@destroy',$ma->idcodeudor),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">ELIMINAR &nbsp; CODEUDOR</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<p style="padding: 0px 25px 15px 10px; text-align: center;">
					confirme si desea eliminar el codeudor
				</p>

				<p style="text-align: center;">-- {{ $ma->nombre }} {{$ma->apellido}}--</p>

			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>