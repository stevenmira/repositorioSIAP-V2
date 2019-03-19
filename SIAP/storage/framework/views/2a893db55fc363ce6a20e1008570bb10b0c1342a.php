<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-verificar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #558b2f; color: #fff; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" 
                aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h2 class="modal-title"><i class="fa fa-info-circle"></i> Verifique los siguientes datos </h2>
            </div>
            <div class="modal-body" style="color: #000; background:#ccff90; text-align: left; font-family:'Trebuchet MS', Helvetica, sans-serif;text-shadow: 0 0 0.2em #cfd8dc;">

                <div class="row">
                    <p style="text-align: center;">Revise que de los datos del <strong>Cliente</strong>, <strong>Negocio</strong>, <strong>Codeudor</strong> y la <strong>Tasa de interés</strong> sean correctos, luego verifique los siguientes campos:</p>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive" style="padding: 5px 5px;">
                            <table  class="table " style="color: black;">
                                  <tr>
                                      <td>Fecha del crédito</td>
                                      <td id="rfechacredito" style="text-align: center;"></td>
                                  </tr>
                                  <tr>
                                      <td>Comienzo de la cartera de pagos</td>
                                      <td id="rfechacomienzo" style="text-align: center;"></td>
                                  </tr>
                                  <tr>
                                      <td>Cobro de comisión</td>
                                      <td id="rtipo1" style="text-align: center;"></td>
                                  </tr>
                                  <tr>
                                      <td>Tipo de desembolso</td>
                                      <td id="rtipo2" style="text-align: center;"></td>
                                  </tr>
                                  <tr>
                                      <td>No. Cheque</td>
                                      <td id="rnumcheque" style="text-align: center;"></td>
                                  </tr>
                                  <tr>
                                      <td>Monto a otorgar</td>
                                      <td id="rmonto" style="text-align: center;"></td>
                                  </tr>

                                  <tr>
                                      <td>Cuota diaria</td>
                                      <td id="rcuota" style="text-align: center;"   ></td>
                                  </tr>
                            </table>
                        </div>
                    </div>

                    <p style="text-align: center;">Si los campos son correctos puede dar clic en <strong>Guardar</strong>  para continuar</p>

                </div>
            </div>
            <div class="modal-footer" style="background: #558b2f;">
                    <input name="_token" value="<?php echo e(csrf_token()); ?>" type="hidden"></input> 
                    <a data-dismiss="modal" class="btn btn-outline btn-lg pull-left">Atras</a>
                    <button class="btn btn-outline btn-lg" type="submit">Guardar</button> 
            </div>
        </div>
    </div>
</div>


