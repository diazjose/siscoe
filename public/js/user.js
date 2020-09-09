
function edit(id, role){
	$('#user_id').val(id);
	console.log(id);
	$('#user option[value="'+ role +'"]').attr("selected",true);
}