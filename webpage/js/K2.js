$(document).ready(function() {
	var selected = [];

	$('.selection_box').click(function() {
		if($(this).prop('checked')) { 
			console.log($(this).attr('id') + ' is checked');
			selected.push($(this).attr('id'));
		}
		else {
			console.log($(this).attr('id') + ' is not checked');
			for(var y=0; y<selected.length; y++) {
				if(selected[y] == $(this).attr('id')) {
					selected.splice(y, 1);
				}
			}
		}
	});

	$('#render_doc').click(function() {
		$.ajax({
			type: 'POST',
			url: './load_k2_tweet_file.php',
			data: {selected : selected},
			dataType: 'text',
 
			success : function() {
				console.log('File data sent successfully. '+selected);
			
   		 	// Uncheck all checkboxes on page load    
			}

		});	//ajax call:
	});//click function

	var selected = [];
});//
