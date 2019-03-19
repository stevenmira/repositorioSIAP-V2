<?php if($ma->estado == 'ACTIVO'): ?>
<div class="modal modal-danger fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-<?php echo e($ma->idnegocio); ?>">
<?php else: ?>
<div class="modal modal-primary fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-<?php echo e($ma->idnegocio); ?>">
<?php endif; ?>
	<?php echo e(Form::Open(array('action'=>array('NegocioController@destroy',$ma->idnegocio),'method'=>'delete'))); ?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <?php if($ma->estado == 'ACTIVO'): ?>
                <h4 class="modal-title">Inhabilitar Registro</h4>
                <?php else: ?>
                <h4 class="modal-title">Habilitar Registro</h4>
                <?php endif; ?>
			</div>
			<div class="modal-body">
				<?php if($ma->estado == 'ACTIVO'): ?>
				<h4 style="font-family: bold;">Confirme si desea <b>dar de baja</b> el negocio: </h4>
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;">
					<b><?php echo e($ma->nombre); ?></b></h2>
				<?php else: ?>
				<h4 style="font-family: bold;">Confirme si desea cambiar al estado <b>ACTIVO</b> el negocio: </h4>
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;">
					<b><?php echo e($ma->nombre); ?></b></h2>
				<?php endif; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	<?php echo e(Form::Close()); ?>

</div>