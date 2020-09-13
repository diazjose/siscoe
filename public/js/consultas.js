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

	$("#fechaTarea").click(function(){
		var fecha = $("#fecha").val();		
		var	id = $("#puestId").val();
		var url = 'http://localhost/SISCOE/public/puesto/ver/'+id+'/'+fecha;
		$(location).attr('href',url);
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

function tarea(id,apellidos,nombre){
	$("#Title").html('');
	$("#boton").text('');
	$("#persona_id").val('');
	$('#lugar').val('');
	$("#horaEntrada").val('');
	$("#horaSalida").val('');	
	$('#tarea').val("");
	$("#formTarea").attr("action",'');
	$("#formTarea").attr("action",'http://localhost/SISCOE/public/personal/asignarTarea');
	$("#Title").append('Agregar Tarea');
	$("#persona_id").val(id);
	$("#nombre").html('');
	$("#nombre").append(apellidos+' '+nombre);
	$("#boton").text('Agregar Tarea');
	$("#boton").removeClass('btn-success');
	$("#boton").addClass('btn-primary');
	
}

function editTarea(idTarea,id,apellidos, nombre, lugar, horaE, horaS, tarea){
	console.log(idTarea);
	$("#Title").html('');
	$("#boton").text('');
	$("#persona_id").val('');
	$("#horaEntrada").val('');
	$("#horaSalida").val('');	
	$("#formTarea").attr("action",'');
	$("#formTarea").attr("action",'http://localhost/SISCOE/public/personal/editarTarea');
	$("#Title").append('Actualizar Tarea');
	$("#nombre").html('');
	$("#tarea_id").val(idTarea);
	$("#nombre").append(apellidos+' '+nombre);
	$("#persona_id").val(id);
	$('#lugar option[value="'+ lugar +'"]').attr("selected",true);
	$("#horaEntrada").val(horaE);
	$("#horaSalida").val(horaS);	
	$('#tarea option[value="'+ tarea +'"]').attr("selected",true);
	$("#boton").text('Actualizar Tarea');
	$("#boton").removeClass('btn-primary');
	$("#boton").addClass('btn-success');
	
}

function eliminarTarea(id,nombre){
	$("#nombreTarea").text(nombre);
	$("#tareaName").val(nombre);
	$("#deleteTarea").val(id);
}
      
               