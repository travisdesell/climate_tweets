<?php
//This is the page the teachers will see. It has the graphs for a visual of the classification results.
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Teacher Page", "$css_header", "");


//modal for instructions
echo "
<div class='container'>
	<div class = 'col-sm-12'>
	<div class = 'row row-centered'>
		<p>  </p>
		<p>  </p>		
		<h1><center>Tweet Classification Results</center></h1>	
	
	</div>
	</div>
    <div class='col-sm-12'>
        <div class='row row-centered'>
";

echo "<br>";
echo "</div><!--row-->";
echo "</div><!--col-->";

//section for barchart 
echo "<div class = 'row row-centered'>";
echo "<div class='col-sm-6'>";
echo "<div class='well well-sm'>";
    echo "<p><h3>Categories</h3></p>";
		echo" <div id='barchart'></div>";
			echo "<br>";
			echo "</div>";//well
echo "</div><!--col-->";

//section for pie chart
echo "<div class ='col-sm-6'>";
echo "<div class = 'well well-sm'>";

echo "<p><h3>Attitudes towards Climate Change</h3></p>";
echo "<form role='form'>
		
   		<div id='piechart' style='width: 450px; height: 300px;' display: inline-block'></div>  
	</form>";
echo "</div><!-- well -->";
echo "</div><!-- col -->";
echo "</div><!-- row -->";

//javascript for graphs being drawn
echo"
<script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      
	google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(drawBarChart);
    google.setOnLoadCallback(drawPieChart);

//BARCHART  
	function drawBarChart() { 
		var jsonData2 = [];
		jsonData2 = $.ajax({
			url: 'get_bar_chart_data.php',
			dataType: 'json',
			async: false
			}).responseText;

		console.log('jsonData2: \'' + jsonData2 + '\'');

		jsonData2 = JSON.parse(jsonData2);

		var data = new google.visualization.arrayToDataTable([
        	['Number of Tweets', 'Classifications', {role: 'style'} ],
        	['Drivers', jsonData2[0], '#00C957'],
        	['Science', jsonData2[1], '#3D9140'],
        	['Denial',  jsonData2[2], '#006400'],
        	['Politics', jsonData2[3],'#00C957'],
        	['Ethics',  jsonData2[4], '#3D9140'],
			['Extreme', jsonData2[5], '#006400'],
			['Weather', jsonData2[6], '#00C957'],
			['Environment', jsonData2[7],'#3D9140'],
			['Society', jsonData2[8], '#006400'],
			['Unknown', jsonData2[9], '#00C957'], 
        ]);
	    
		var options = {
     		title: 'Tweet Categories',
			width: 400,
			height: 300,
			//bar: {groupWidth: '48%'},
			legend: { position: 'none'},
			backgroundColor: 'transparent'			
		};
        
		var barchart = new google.visualization.BarChart(document.getElementById('barchart'));
		barchart.draw(data, options);
 	}

//PIECHART
	function drawPieChart() {
		var jsonData = [];
		jsonData = $.ajax({
			url: 'get_pie_chart_data.php',
			dataType: 'json',
			async: false
			}).responseText;

		console.log('jsonData: \'' + jsonData + '\'');

		jsonData = JSON.parse(jsonData);
/*
		console.log('jsonData[-2]: \'' + jsonData[-2] + '\'');
		console.log('jsonData[-1]: \'' + jsonData[-1] + '\'');
		console.log('jsonData[0]: \'' + jsonData[0] + '\'');
		console.log('jsonData[1]: \'' + jsonData[1] + '\'');
		console.log('jsonData[2]: \'' + jsonData[2] + '\'');
*/		
	var data = new google.visualization.arrayToDataTable([
			['Attitude', 'Number of Tweets Classified'],
        	['Strongly Denies', jsonData[-2]],
        	['Denies', jsonData[-1]],
        	['Neutral', jsonData[0]],
        	['Acknowledges', jsonData[1]],
        	['Strongly Acknowledges',jsonData[2]],
        ]);

        var options = {
            title: 'Overall Attitudes of Tweets',
		    colors: ['#3BB9FF', '#3574E7', '#1569C7', '#153E7E', '#151B8D'],
	 	    backgroundColor: 'transparent'
		};

        var piechart = new google.visualization.PieChart(document.getElementById('piechart'));
        piechart.draw(data, options);  
	}
    </script>
  	</head>
";

echo"</div> <!-- /container -->";
print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
