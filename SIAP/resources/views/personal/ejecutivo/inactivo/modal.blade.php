<div class="modal  fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->idejecutivo}}">
	{{Form::Open(array('action'=>array('EjecutivoController@destroy',$ma->idejecutivo),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #3F729B; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">ACTIVAR &nbsp; EJECUTIVO</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">
				<p>confirme si desea activar al ejecutivo</p>
				<p style="text-align: center;">-- {{ $ma->nombre }} {{$ma->apellido}} --</p>
			</div>
			<div class="modal-footer" style="background: #3F729B; color: #fff;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>