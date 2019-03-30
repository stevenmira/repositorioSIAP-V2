<div class="modal modal-info fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-help">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">NUEVO CRÉDITO COMPLETO</h4>
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
			                              <b> Tabla de Tasas de Interés</b>
			                              </h3>
			                          </th>
			                      </tr>
			                        <tr class="info">
			                        	<th style="text-align: center;">TIPO CRÉDITO</th>
			                            <th style="text-align: center;">CONDICIÓN</th>
			                            <th style="text-align: center;">MONTO</th>
			                            <th style="text-align: center;">INTERÉS</th>
			                        </tr>
			                    </thead>
			                      @foreach($interesList as $interes)
			                      <tr>
			                      	  	<td>{{$interes->nombre}}</td>
			                          	<td>{{$interes->condicion}}</td>
			                          @if($interes->monto!=0)
			                          	<td>{{$interes->monto}}</td>
			                          @else
			                          	<td>No Aplica</td>
			                          @endif
			                          <?php  $interex = $interes->interes * 100;?>
			                          	<td>{{$interex}}%</td>
			                      </tr>
			                    @endforeach
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
				<p style="font-family:  Times New Roman, sans-serif; color: black;  text-align: left;">
					** En el campo tipo de Desembolso tienes la opcion de escoger el desembolso del crédito.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>