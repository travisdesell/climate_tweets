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
			type : 'POST',
			url : './get_more_tweets.php',
			data : JSON,
		
			success : function(data) {
				console.log("More tweets were received!");
				console.log("php returned '" + data + "'");
				//for(var x=0; x<10; x++) {
					$("#mytable").append("<tr><td><center><div class='checkbox'><label><input type='checkbox' class='selection box'></label></div></center></td><td>new</td></tr>");	
					//$("td").append("this is da text"); //appends that text 10 times in each checkbox and after each tweets text
					//$("td").append("<td><div class='checkbox'><label><input type='checkbox' class='selection_box'></label></div></td><td>data[x]</td>");//appends a ton of disorganized checkboxes.		
				//}
			}
		});
	});
});
