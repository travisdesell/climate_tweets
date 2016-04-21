$(document).ready(function() {
	var selected = [];

	$('.selection_box').click(function() {
		if($(this).prop('checked')) 
			console.log($(this).attr('id') + ' is checked');
		else 
			console.log($(this).attr('id') + ' is not checked');
	
	});
});
