
$("#searchItem").change(event => {
	$.get(`/search/${event.target.value}`, function(res, sta){
		$("#negocioItem").empty();
		$("#negocioItem").append(`<option value=0> Seleccione un Negocio </option>`);
		res.forEach(element => {
			$("#negocioItem").append(`<option value=${element.idnegocio}> ${element.nombre} </option>`);
		});
	});
});