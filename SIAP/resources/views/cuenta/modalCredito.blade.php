<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modalCredito-delete-{{$prestamo->idprestamo}}">
	{{Form::Open(['action'=>'CuentaController@updateCredito'])}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #3F729B; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">MODIFICAR &nbsp; CRÉDITO</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<p style="padding: 0px 25px 15px 10px; text-align: center;">
					Editar Crédito
				</p>
				<table>
					<tr>
						<td style="width: 200px;"><p>Cheque:</p></td>
						<td style="padding: 0px 100px 15px 10px;">
							{!! Form::text('numerocheque', $prestamo->numerocheque, ['class' => 'form-control', 'maxlength'=>'50']) !!}
						</td>
					</tr>
					<tr>
						<td style="width: 100px;"><p>Saldo capital:</p> </td>
						<td  style="padding: 0px 100px 15px 10px;">
							{!! Form::number('saldo', $cuenta->capitalanterior, ['class' => 'form-control', 'maxlength'=>'30', 'step'=>'0.01']) !!}
						</td>
					</tr>
					<tr>
						<td style="width: 100px;"><p>Cuotas atrasadas:</p></td>
						<td  style="padding: 0px 100px 15px 10px;">
							{!! Form::number('cuotas', $cuenta->cuotaatrasada, ['class' => 'form-control', 'step'=>'1']) !!}
						</td>
					</tr>
					<tr>
						<td style="width: 100px;"><p>Mora:</p></td>
						<td  style="padding: 0px 100px 15px 10px;">
							{!! Form::number('mora', $cuenta->mora, ['class' => 'form-control', 'step'=>'0.01']) !!}
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
	<input type="text" name="idprestamo" hidden="on" value="{{$prestamo->idprestamo}}">
	{{Form::Close()}}
</div>