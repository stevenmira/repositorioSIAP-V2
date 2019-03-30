@if($ma->estado == 'ACTIVO')
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->idnegocio}}">
@else
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ma->idnegocio}}">
@endif
	{{Form::Open(array('action'=>array('NegocioController@destroy',$ma->idnegocio),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			@if($ma->estado == 'ACTIVO')
				<div class="modal-header" style="background: #b71c1c; color:#fff;">
			@else
				<div class="modal-header" style="background: #3F729B; color: #fff;">
			@endif
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                @if($ma->estado == 'ACTIVO')
                	<h4 class="modal-title">INACTIVAR &nbsp; NEGOCIO</h4>
                @else
                <h4 class="modal-title">ACTIVAR &nbsp; NEGOCIO</h4>
                @endif
				</div>
			@if($ma->estado == 'ACTIVO')
				<div class="modal-body" style="color: #000; background: #ff8a80; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">
			@else
				<div class="modal-body" style="color: #000; background: #fff; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">
			@endif
			@if($ma->estado == 'ACTIVO')
				<p>confirme si desea inactivar el negocio</p>
				<p style="text-align: center;">-- {{ $ma->nombre }} --</p>
			@else
				<p>confirme si desea activar el negocio</p>
				<p style="text-align: center;">-- {{ $ma->nombre }} --</p>
			@endif
				</div>
			@if($ma->estado == 'ACTIVO')
				<div class="modal-footer" style="background: #b71c1c;">
			@else
				<div class="modal-footer" style="background: #3F729B;">
			@endif
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>