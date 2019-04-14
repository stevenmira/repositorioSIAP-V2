<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalEstado-delete-<?php echo e($es->idcomprobante); ?>">
	<?php echo e(Form::Open(['action'=>'ComprobanteController@updateEstado'])); ?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #3F729B; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">MODIFICAR &nbsp; ESTADO &nbsp; DE &nbsp; CUENTAS</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<p style="padding: 0px 25px 15px 10px; text-align: center;">
					Editar Estado
				</p>
				<table>
					<tr>
						<td style="width: 200px;"><p>Seleccione el estado del pago</p></td>
						<td style="padding: 0px 100px 15px 10px;">
							<select class="form-control" name="estadodos">
								<option value="CANCELADO">CANCELADO</option>
								<option value="NO CANCELADO">NO CANCELADO</option>
							</select>
						</td>
					</tr>
				</table>

			</div>
			<div class="modal-footer" style="background: #3F729B;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Actualizar</button>
			</div>
		</div>
	</div>
	<input type="text" name="idcomprobante" hidden="on" value="<?php echo e($es->idcomprobante); ?>">
	<?php echo e(Form::Close()); ?>

</div>