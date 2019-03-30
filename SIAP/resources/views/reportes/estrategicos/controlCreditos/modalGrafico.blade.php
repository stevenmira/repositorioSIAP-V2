<!-- ChartJS -->
<script src="{{asset('js/Chart.min.js')}}"></script>


<div class="modal  fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-2">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #007E33; color: #fff;">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">GRÁFICO -- CONTROL DE CRÉDITOS</h4>
			</div>
			<div class="modal-body" style="color: #000; background: #fff; font-family:'Trebuchet MS', Helvetica, sans-serif;">

				<canvas id="pie-chart" width="800" height="450"></canvas>

				<script type="text/javascript">
					new Chart(document.getElementById("pie-chart"), 
					{
					    type: 'pie',
					    data: {
					      labels: ["Financiamiento", "Refinanciamiento"],
					      datasets: [{
					        label: "Population (millions)",
					        backgroundColor: ["#e8c3b9","#c45850"],
					        data: [{{$p1}},{{$p2}}]
					      }]
					    },
					    options: {
					      title: {
					        display: true,
					        text: 'Distribución del desembolso en porcentaje'
					      }
					    }
					});
				</script>
				<br>
				<table style="border: 0px solid #fff;">
					<tr style="border: 0px solid #fff; border-color:#e8c3b9; border-style:dashed; border-width:2px;">
						<td style="border: 0px solid #fff; width: 50%;">No. créditos con financiamiento:</td>
						<td style="border: 0px solid #fff; width: 10%;">{{$c1}}</td>
						<td style="border: 0px solid #fff; width: 20%;">Desembolso:</td>
						<td style="border: 0px solid #fff; width: 20%; text-align: right; padding: 0px 15px;"><span class="pull-left">$</span> {{ number_format($sumMontoCompleto,2) }}</td>
					</tr>
					<tr style="border: 0px solid #fff; border-color:#c45850; border-style:dashed; border-width:2px;">
						<td style="border: 0px solid #fff; width: 50%;">No. créditos con refinanciamiento:</td>
						<td style="border: 0px solid #fff; width: 10%;">{{$c2}}</td>
						<td style="border: 0px solid #fff; width: 20%;">Desembolso:</td>
						<td style="border: 0px solid #fff; width: 20%; text-align: right; padding: 0px 15px;"><span class="pull-left">$</span> {{ number_format($sumMontoRefinanciamiento,2) }}</td>
					</tr>
					<tr style="border: 0px solid #fff; border-color:#fff; border-style:dashed; border-width:2px; font-weight: bold;">
						<td style="border: 0px solid #fff; width: 50%;"></td>
						<td style="border: 0px solid #fff; width: 10%;"></td>
						<td style="border: 0px solid #fff; width: 20%;">Total:</td>
						<?php $total = $sumMontoCompleto + $sumMontoRefinanciamiento; ?>
						<td style="border: 0px solid #fff; width: 20%; text-align: right; padding: 0px 15px;"><span class="pull-left">$</span> {{ number_format($total,2) }}</td>
					</tr>
				</table>
				
			</div>
			<div class="modal-footer" style="background: #007E33;">
				<button type="button" class="btn btn-outline" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>

	