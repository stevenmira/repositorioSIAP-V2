<div class="modal modal-info fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-help">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">AYUDA</h4>
			</div>
			<div class="modal-body" style="font-family:  Times New Roman, sans-serif;">
				<div style="padding: 10px 10px 10px 25px;">
					<p style="font-weight: bold; color: #000;" align="center">Tabla de Categorías</p>
					<table>
						<tr style="color: #000;"> 
							<td style="width: 80px; font-weight: bold;">Letra</td>
							<td style="width: 120px; font-weight: bold;">Calificación</td>
							<td style="width: 200px; font-weight: bold;">Descripción</td>
						</tr>
						@foreach ($categorias as $cat)
						<tr style="color: #000;">						
							<td style="width: 80px;">{{$cat->letra}}</td>
							<td style="width: 120px;">{{$cat->calificacion}}</td>
							<td style="width: 200px;">{{$cat->descripcion}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>