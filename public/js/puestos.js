window.addEventListener("load", function(){
	
	var status = $("#status").val();
	var zone = $("#zone").val();

	$('#estado option[value="'+ status +'"]').attr("selected",true);
	$('#zona option[value="'+ zone +'"]').attr("selected",true);

	

});



