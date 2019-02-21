
$("#searchItem").change(event => {
	$.get(`/search2/${event.target.value}`, function(res, sta){
		$("#codeudorItem").empty();
		$("#codeudorItem").append(`<option value=0> ¿Desea Seleccionar Codeudor? </option>`);
		res.forEach(element => {
			$("#codeudorItem").append(`<option value=${element.idcodeudor}> ${element.nombre} ${element.apellido} </option>`);
		});
	});
});