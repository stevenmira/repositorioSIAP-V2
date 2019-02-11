<div class="modal modal-primary fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$cartera->idcartera}}">
	{{Form::Open(array('action'=>array('CarteraController@destroy',$cartera->idcartera),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Habilitar Registro</h4>
			</div>
			<div class="modal-body">
				<h4 style="font-family: bold;">Confirme si desea cambiar al estado <b>ACTIVO</b> a la Cartera: </h4>
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>{{ $cartera->nombre }}</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>