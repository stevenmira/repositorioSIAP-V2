<div class="modal modal-info fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-help">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">CÁLCULO DE CRÉDITO</h4>
			</div>
			<div class="modal-body">
				<p style="font-family:  Times New Roman, sans-serif; color: black; text-align: center;"> 
					La presente tabla contiene solamente los tipos de créditos básicos para el cálculo de crédito
				</p>

				<div class="row">
			        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			            <div class="table-responsive" style="padding: 5px 5px;">
			                <table class="table table-striped table-bordered table-condensed table-hover" style="color: black;">
			                    <thead>
			                        <tr class="success">
			                          <th colspan="12">
			                              <h3 style="text-align: center;font-family:  Times New Roman, sans-serif; color: #1C2331;">
			                              <b> Tabla de Cálculo de Crédito</b>
			                              </h3>
			                          </th>
			                      </tr>
			                        <tr class="info">
			                        	<th>TIPO CRÉDITO</th>
			                            <th>CONDICIÓN</th>
			                            <th>MONTO</th>
			                            <th>INTERÉS</th>
			                        </tr>
			                    </thead>
			                      <tr>
			                      	  <td>Normal</td>
			                          <td>Menor o Igual a</td>
			                          <td>$80</td>
			                          <td>1.7%</td>
			                      </tr>
			                      <tr>
			                      	  <td>Normal</td>
			                          <td>Menor o Igual a</td>
			                          <td>$105</td>
			                          <td>1.1%</td>
			                      </tr>
			                      <tr>
			                      	  <td>Normal</td>
			                          <td>Mayor a</td>
			                          <td>$105</td>
			                          <td>1%</td>
			                      </tr>
			                      <tr>
			                          <td>Preferencial</td>
			                          <td>No Aplica</td>
			                          <td>No Aplica</td>
			                          <td>0.8%</td>
			                      </tr>
			                      <tr>
			                          <td>Oro</td>
			                          <td>No Aplica</td>
			                          <td>No Aplica</td>
			                          <td>0.7%</td>
			                      </tr>
			                </table>
			            </div>
			        </div>
				</div>
				<p style="font-family:  Times New Roman, sans-serif; color: black;  text-align: left;">
					** Para registrar una nueva tasa de interés haz clic <a href="{{URL::action('TasaInteresController@index')}}" style="color: white;">AQUÍ</a>´.
				</p>
				<p style="font-family:  Times New Roman, sans-serif; color: black;  text-align: left;">
					** La cartera de pagos puedes empezarla a partir de la fecha de selección ó al siguiente día.
				</p>
				<p style="font-family:  Times New Roman, sans-serif; color: black;  text-align: left;">
					** En el campo Cobro de Comisión tienes la opción de agregar o no la comisión al crédito.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>