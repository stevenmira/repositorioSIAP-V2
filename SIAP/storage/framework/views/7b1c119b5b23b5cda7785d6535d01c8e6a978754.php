<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalEsta2-delete-<?php echo e($ma->iddetalleliquidacion); ?>">
	<?php echo e(Form::Open(['action'=>'LiquidacionController@updateEstado'])); ?>

	    	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #3F729B; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Modificar Estado de Cuota</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<h4 style="padding: 0px 25px 15px 10px; text-align: center;">
					Seleccione el estado de la cuota
				</h4>
				<div class="row" style="padding: 0px 25px 15px 25px;">
				<aside class="col-md-5 col-lg-5">
					<p>DIA: </p>
					<p>FECHA:</p>
					<p>MONTO: </p>
					<p>INTERES: </p>
					<p>CUOTA CAPITAL:</p>
					<p>TOTAL DIARIO:</p>
					<?php if( $ma->fechaefectiva != null): ?>
					<p>FECHA EFECTIVA DE PAGO: </p>
					<?php else: ?>
					<p>FECHA EFECTIVA DE PAGO: </p>
					<?php endif; ?>
					<p>ESTADO DE LA CUOTA: </p>
				</aside>
				<aside class="col-md-5 col-lg-5">
					<p> <?php echo e($ma->contador); ?> </p>
					<p> <?php echo e($ma->fechadiaria->format('l j  F Y ')); ?> </p>
					<p> $ <?php echo e($ma->monto); ?> </p>
					<p> $ <?php echo e($ma->interes); ?> </p>
					<p> $ <?php echo e($ma->cuotacapital); ?> </p>
					<p> $ <?php echo e($ma->totaldiario); ?> </p>
					<?php if( $ma->fechaefectiva != null): ?>
					<p> <?php echo e($ma->fechaefectiva->format('l j  F Y ')); ?> </p>
					<?php else: ?>
					<p> -- VACIO --</p>
					<?php endif; ?>
					<select name="nombre" class="form-control">
		                <?php foreach($estadosCuota as $gr): ?>
		                  <?php if($gr->nombre == $ma->estado): ?>
		                  <option value="<?php echo e($gr->nombre); ?>" selected><?php echo e($gr->nombre); ?></option>
		                  <?php else: ?>
		                  <option value="<?php echo e($gr->nombre); ?>"><?php echo e($gr->nombre); ?></option>
		                  <?php endif; ?>
		                <?php endforeach; ?>
		             </select>
				</aside>
				</div>
			</div>
			<div class="modal-footer" style="background: #3F729B;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Actualizar</button>
			</div>
		</div>
	</div>

	<input type="text" name="iddetalleliquidacion" hidden="on" value="<?php echo e($ma->iddetalleliquidacion); ?>">
	<?php echo e(Form::Close()); ?>

</div>