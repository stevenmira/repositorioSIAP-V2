<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-<?php echo e($ma->idgarantia); ?>">
	<?php echo e(Form::Open(array('action'=>array('GarantiaController@destroy',$ma->idgarantia),'method'=>'delete'))); ?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Garantiía</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<h4 style="padding: 0px 25px 15px 10px; text-align: center;">
					Confirme si desea eliminar la garantía
				</h4>

				<p style="font-size: 14px;">
					Marca: <span style="padding: 10px 25px 0px 10px;"><?php echo e($ma->marca); ?></span>
				</p>
				<p style="font-size: 14px;">
					Serie: <span style="padding: 10px 25px 0px 10px;"><?php echo e($ma->serie); ?></span>
				</p>
				<p style="font-size: 14px;">
					Valor: <span style="padding: 10px 25px 0px 10px;"><?php echo e($ma->valor); ?></span>
				</p>

				<p style="font-size: 14px;">
					 Descripción: 
				</p><span style="padding: 5px 0px 0px 0px;"><?php echo e($ma->descripcion); ?></span>

			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	<?php echo e(Form::Close()); ?>

</div>