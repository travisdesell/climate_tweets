$(document).ready(function() {
	var selected = [];

	$('#render_doc').click(function() {
		for(var x=0; x<selected.length; x++) {
			selected[x] = selected[x] + "\r\n\r\n";
		}
		var data = new Blob(selected,{type: "text/plain;charset=utf-8"});
		saveAs(data, 'tweets.txt');
	});//click function

//when this button is pushed, an ajax call is made to get_more_tweets.php, which queries the database for 20 more tweets. 
	$(document).on("click", "#more_tweets", function() {
		//ajax call for php script for new html, then append
		$.ajax({
			type : 'POST',
			url : './get_more_tweets.php',
			data : JSON,
		
			success : function(data) {
				//console.log("More tweets were received!");
				//console.log("php returned '" + JSON.stringify(data) + "'");
				var new_tweets = data.split("****");
				for(var x=0; x<20; x++) 
				{
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
