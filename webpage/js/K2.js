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
		for(var x=0; x<selected.length; x++) {
			selected[x] = selected[x] + "\r\n\r\n";
		}
		var data = new Blob(selected,{type: "text/plain;charset=utf-8"});
		saveAs(data, 'tweets.txt');
	});//click function

	$('#more_tweets').click(function() {
		//ajax call for php script for new html, then append
		$.ajax({
			type : 'GET',
			url : './get_more_tweets.php',
			datatype : 'text',
		
			success : function(return_array) {
				console.log("More tweets were received!");
				for(var x=0; x<return_array.length; x++) {
					$("p").append(return_array[x]);		
		//$("button").append("<button type='button' class='btn btn-default");	
				}
			}
		});
	});
});
