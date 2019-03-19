
$("#negocioItem").change(event => {
	$.get(`/search3/${event.target.value}`, function(resultado, sta){
		
		$("#pres").empty();
		$("#estadocuenta").val('');
		$("#estadoprestamo").val('');
		$("#capitalanterior").val('');
		$("#cuotaatrasada").val('');
		$("#mora").val('');

		if (resultado == "noPoseeCreditoAbierto"){
			document.getElementById("pres").innerHTML = "El cliente no posee un crédito activo en el cual -- refinanciar --";
		}
		else if (resultado == "abonoPendiente"){
			document.getElementById("pres").innerHTML = "El cliente tiene abono pendiente";
		}
		else if (Number(resultado.idcuenta) != ""){
			document.getElementById("pres").innerHTML = "Los saldos de la cuenta anterior son:";
			$("#estadocuenta").val(resultado.estadocuenta);			//estado de la cuenta
			$("#estadoprestamo").val(resultado.estado);				//estado del prestamo
			$("#capitalanterior").val(resultado.capitalanterior);
			$("#cuotaatrasada").val(resultado.cuotaatrasada);
			$("#mora").val(resultado.mora); 	
		}
		else{
			document.getElementById("pres").innerHTML = "Verifique los saldos de la cuenta anterior";
		}

		
	});
});