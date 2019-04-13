<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-<?php echo e($ma->idsupervisor); ?>">
	<?php echo e(Form::Open(array('action'=>array('SupervisorController@destroy',$ma->idsupervisor),'method'=>'delete'))); ?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">INACTIVAR &nbsp; SUPERVISOR</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">
				<p>confirme si desea inactivar al supervisor</p>
				<p style="text-align: center;">-- <?php echo e($ma->nombre); ?> <?php echo e($ma->apellido); ?>--</p>
			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	<?php echo e(Form::Close()); ?>

</div>