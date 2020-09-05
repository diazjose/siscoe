window.addEventListener("load", function(){
	
	
	$('#dataTable').DataTable({
		"language" : {
			"info" : "<strong class='title'>_TOTAL_ Registros </strong>",
			"search" : "<strong class='title'>Buscar</strong>",
			"paginate" : {
				"next" : "Siguiente",
				"previous" : "Anterior",
			},
			"lengthMenu" : '<strong class="title">Mostrar</strong> <select>'+
							'<option value="10">10</option>'+
							'<option value="20">20</option>'+
							'<option value="30">30</option>'+
							'<option value="-1">Todos</option>'+
							'</select> <strong class="title">registros</strong>',
			"loadingRecords" : "Cargando...",
			"processing" : "Procesando..",
			"emptyTable" : "No hay datos",
			"zeroRecords" : "No hay coincidencias",
			"infoEmpty" : "",
			"infoFiltered" : "",
		}
	});

	$('#dni').keyup(function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	    validDNI();
	});

});

function validDNI(){
	var valid = $("#dni").val();
	if (valid.length == 8) {
		if (valid > 6000000 && valid < 50000000) {
			$("#dnilHelp").show();
		}else{
			$("#dni").addClass('is-invalid');
			$("#dnilHelp").hide();
			$("#mess").show();
		}
	}else{
		$("#mess").hide();
		$("#btn").addClass('disabled');
	}
}

