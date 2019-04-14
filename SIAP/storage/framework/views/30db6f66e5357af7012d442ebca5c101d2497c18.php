<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-deleteP-<?php echo e($cuenta->idcuenta); ?>">
	<?php echo e(Form::Open(array('action'=>array('PrestamoController@destroy',$cuenta->idcuenta),'method'=>'delete'))); ?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"  style="background: #b71c1c; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">CONFIGURACIÓN &nbsp; DE &nbsp; PRÉSTAMO</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #ff8a80; text-align: center; font-family:'Trebuchet MS', Helvetica, sans-serif;">

                <p>confirme si desea cambiar el estado del préstamo del cliente</p>
                <p style="text-align: center;">-- <?php echo e($cliente->nombre); ?> <?php echo e($cliente->apellido); ?> --</p>

                <p>asociada al negocio</p>
                <p style="text-align: center;">-- <?php echo e($negocio->nombre); ?> --</p>

                <br>

                <p>el estado del préstamo actual es</p>
                <?php if($prestamo->estadodos == "ACTIVO"): ?>
                <h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>ACTIVO</b></h2>
                <?php endif; ?>
                <?php if($prestamo->estadodos == "VENCIDO"): ?>
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>VENCIDO</b></h2>
                <?php endif; ?>
                <?php if($prestamo->estadodos=="CERRADO"): ?>
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>CERRADO</b></h2>
                <?php endif; ?>
                
                <p>seleccione el nuevo estado</p>

                <?php if($prestamo->estadodos == "ACTIVO"): ?>
                <?php echo e(Form::radio('state','CERRADO',true)); ?><i> CERRADO</i><br>
                <?php echo e(Form::radio('state','VENCIDO')); ?><i> VENCIDO</i><br>
                <?php endif; ?>

                <?php if($prestamo->estadodos == "VENCIDO"): ?>
				<?php echo e(Form::radio('state','ACTIVO',true)); ?><i> ACTIVO</i><br>
                <?php echo e(Form::radio('state','CERRADO')); ?><i> CERRADO</i><br>
                <?php endif; ?>

                <?php if($prestamo->estadodos=="CERRADO"): ?>
				<?php echo e(Form::radio('state','ACTIVO',true)); ?><i> ACTIVO</i><br>
                
                <?php echo e(Form::radio('state','VENCIDO')); ?><i> VENCIDO</i><br>
                <?php endif; ?>

                        
			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	<?php echo e(Form::Close()); ?>

</div>