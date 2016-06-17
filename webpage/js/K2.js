//This javascript is associated with K2.php and tweet_selection.html
$(document).ready(function() {
	var selected = [];
//when the "download tweet file" is selected, the API is used to create a downloadable text document
	$('#render_doc').click(function() {
		for(var x=0; x<selected.length; x++) {
			selected[x] = selected[x] + "\r\n\r\n";
		}
		var data = new Blob(selected,{type: "text/plain;charset=utf-8"});
		saveAs(data, 'tweets.txt');
	});//click function

//when more tweets is pushed, checked boxes remain while unchecked disappear for new tweets. . 
	$('#more_tweets').click(function() {
		//ajax call for php script for new html, then append
		$("tr").remove();
		for(var x=0; x<selected.length; x++) {
			$("#mytable").append("<tr><td><center><div class='checkbox'><label><input type='checkbox' class='selection_box' id="+selected[x]+" checked></label></div></center></td><td>"+selected[x]+"</td></tr>");	
		}
		$.ajax({
		type : 'POST',
		url : './get_more_tweets.php',
		data : JSON,
		
			success : function(data) {
				//for(var x=0; x<selected.length; x++) {
								//}
				//add more tweets to page list
				var new_tweets = data.split("****");
				for(var x=0; x<20; x++) {
					$("#mytable").append("<tr><td><center><div class='checkbox'><label><input type='checkbox' class='selection_box' id="+new_tweets[x]+"></label></div></center></td><td>"+new_tweets[x]+"</td></tr>");	
				}
			}	
		});		
	});

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
});
