<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-deleteP-{{$cuenta->idcuenta}}">
	{{Form::Open(array('action'=>array('PrestamoController@destroy',$cuenta->idcuenta),'method'=>'delete'))}}
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
                <p style="text-align: center;">-- {{ $cliente->nombre }} {{$cliente->apellido}} --</p>

                <p>asociada al negocio</p>
                <p style="text-align: center;">-- {{ $negocio->nombre }} --</p>

                <br>

                <p>el estado del préstamo actual es</p>
                @if($prestamo->estadodos == "ACTIVO")
                <h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>ACTIVO</b></h2>
                @endif
                @if($prestamo->estadodos == "VENCIDO")
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>VENCIDO</b></h2>
                @endif
                @if($prestamo->estadodos=="CERRADO")
				<h2 style="font-family:  Times New Roman, sans-serif; color: #e3f2fd;  text-align: center;"><b>CERRADO</b></h2>
                @endif
                
                <p>seleccione el nuevo estado</p>

                @if($prestamo->estadodos == "ACTIVO")
                {{Form::radio('state','CERRADO',true)}}<i> CERRADO</i><br>
                {{Form::radio('state','VENCIDO')}}<i> VENCIDO</i><br>
                @endif

                @if($prestamo->estadodos == "VENCIDO")
				{{Form::radio('state','ACTIVO',true)}}<i> ACTIVO</i><br>
                {{Form::radio('state','CERRADO')}}<i> CERRADO</i><br>
                @endif

                @if($prestamo->estadodos=="CERRADO")
				{{Form::radio('state','ACTIVO',true)}}<i> ACTIVO</i><br>
                
                {{Form::radio('state','VENCIDO')}}<i> VENCIDO</i><br>
                @endif

                        
			</div>
			<div class="modal-footer" style="background: #b71c1c;">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>