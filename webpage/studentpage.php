<?php
//This is the page for tweet classificationsthe students in high school will see.
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$user = csg_get_user();
$user_id = $user['id'];

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Classifying Climate Tweets", "$css_header <script type='text/javascript' src='js/climate_tweets.js'></script>", "dna");

//query for tweets only within languages selected
$query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE lang='en' AND NOT EXISTS (select * FROM tweet_classifications tc where tc.tweet_id = ct.id and tc.user_id != $user_id) order by rand() limit 1";

error_log("tweet query: '$query'");

$result = query_boinc_db($query);
$row = $result->fetch_assoc();
$id = $row['id'];
$text = $row['text'];
$lang = $row['lang'];
$datetime = $row['datetime'];

//modal for instructions
echo "
<div class='container'>
	<div class = 'col-sm-12'>
	<div class = 'row row-centered' id='test'>
		<p>  </p>
		<p>  </p>
		<h1><center>Climate Tweets</center></h1>	
	</div>
	<div class='col-sm-12'>
		<div class='row row-centered'>

	<!-- Button trigger modal -->
	<div class = 'span6' style = 'text-align:center'>
	<button type='button' id = 'button1' class='btn btn-default btn-lg' data-toggle='modal' data-target='#myModal'>
	  Instructions
	</button>

	<!-- Modal -->
	<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	  <div class='modal-dialog'>
		<div class='modal-content'>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
		  <div class='modal-body' style = 'text-align: left'>
		  <font size = '4'><b>Classifications</b><br></font>
		  <i>Assume that \"global warming\" and \"climate change\" are synonyms. Classify each tweet using no more than three categories listed below. If you cannot find any suitable category, select Other and the Unknown attitude and submit.</i><br>
			<br>		
			<b>Attitudes</b><br>
				-2: Strongly Negative: Denial, skepticism with strong emotional component. \"Man made GLOBAL WARMING HOAX EXPOSED\"<br>
				-1: Negative: <i>\"Sunny on my porch in December. Global Warming ain't so bad\"</i><br>
				0: Neutral: <i>\"A new article on climate change is published in a newspaper.\"</i><br>
				1. Positive: <i>\"How's planet Earth doing? Take a look at the signs of climate change here\"</i><br>
				2. Strongly Positive: Very supportive, with strong emotional component.<i>\"Global warming? It's like earth having a Sauna!\"</i><br>
				<br>
				<table class = 'table table-striped' id = 'tblGrid'>
					<thead>
						<tr>
							<th width = '35%'>Categories</th>
							<th width = '65%'>Explanation and <i>Examples</i></th>
						</tr>
					</thead>							
					<tbody>
						<tr>
							<td><b>Drivers of Climate Change</b></td>
							<td>Greenhouse gases mentioned such as Carbon Monoxide, Methane, or Nitrous Oxide 
								<i>\"Oil, gas, and coal!\"</i></td>	
						</tr>
						<tr>
							<td><b>Science of Climate Change</b></td>
							<td><i>\"The Scientists found that the climate is in fact cooling.\"
								\"IPCC said that the temperature will be up by 4 degrees C.\"</i><br>
						</tr>	
						<tr>
							<td><b>Denial of Climate Change</b></td>
							<td>skepticism, conspiracy theory
								<i>\"Scientists are lying to the public\"</i><br>
						</tr>	
						<tr>
							<td><b>Politics</b></td>
							<td>Mentions conservatives, liberals, elections, carbon tax, etc..
									<i>\"It is too expensive to control CC\"
									\"Treaties\"</i>
							</td>
						</tr>
						<tr>
							<td><b>Ethics and Moral Responsibility</b></td>
							<td><i>\"We need to fight for global warming!\"
									\"We need to give this planet to the next generation\"
									\"God gave us the planet to take care of\"</i>
							</td>
						</tr>
						<tr>
							<td><b>Extreme Events</b></td>
							<td><i>\"Hurricane Sandy, flooding, snowstorm\"</i></td>
						</tr>
						<tr>
							<td><b>Unusual Weather</b></td>
							<td>Mentions unusual types of weather
							<i>\"Heavy snowfall\"
								\"It's too hot\"</i></td>
						</tr>
						<tr>
							<td><b>Threats to the Environment</b></td>
							<td><i>\"Acid raid, smog, polution\"
									\"Deforestation\"
									\"The coral reefs are being bleached\"<br></i></td>
						</tr>
						<tr>
							<td><b>Threats to Society and Economy</b></td>
							<td><i>\"Agriculture is threated...\"
								\"Sea rising will threaten small island nations\"
								\"Property loss and no insurance...\"<br></i></td>
						</tr>
						<tr>
							<td><b>Unknown</b></td>
							<td>Unknown, jokes, irrelevant, hard to classify. 
							<i>\"Global warming is cool OMG a paradox\"
								\"This guy is so hot its global warming\"</i></td>
						</tr>	
			</table>
			</div>
            <button type='button' class='btn btn-default center-block' data-dismiss='modal'>Close</button>
         </div>
      </div>
    </div>
  </div>
";

echo "<br>";
echo "</div><!--jumbo-->";
echo "</div><!--row-->";
echo "</div><!--col-->";

//tweets
echo "<div class='row row-centered'>";
echo "<div class='col-sm-12'>";
echo "<div class='well' id='tweet-well'>";

echo "'$text'<br>";
//echo "<br>";
//echo "Tweet ID: '$id'<br>";
//echo "Language: '$lang'<br>";
//echo "Tweeted on: '$datetime'<br>";

echo "</div>"; //well
echo "</div>"; //col
echo "</div>"; //row

//section for checkboxes - classify tweets by categories

echo "<div class = 'row row-centered'>";
echo "<div class='col-sm-6'>";
echo "<div class='well well-sm'>";
    echo "<p><h3>Categories</h3></p>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='phenomenon-drivers' value='0'> Drivers of Climate Change</input><br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='phenomenon-science' value='0'> Science of Climate Change</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='phenomenon-denial' value='0'> Denial of Climate Change</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='adaptation-politics' value='0'> Politics</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='adaptation-ethics' value='0'> Ethics and Moral Responsibility</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-extreme' value='0'> Extreme Events</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-weather' value='0'> Unusual Weather</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-environment' value='0'> Threats to the Environment</input> <br>";
            echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-society' value='0'> Threats to the Society and the Economy</input> <br>";
	        echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='unknown' value='0'> Unknown</input> <br>";
			echo" <!--<div id='barchart'></div>-->";
			echo "<br>";
			echo "</div>";//well
echo "</div><!--col-->";

//section for radio buttons - classify tweets by attitude
echo "<div class ='col-sm-6'>";
echo "<div class = 'well well-sm'>";

echo "<p><h3>Attitudes towards Climate Change</h3></p>";
echo "<form role='form'>
		<div class = 'radio'>
        <label> <input type='radio' class = 'attitude-radio' id = 'radioID' name='optradio' value ='-2'> Strongly Negative </label></div>
        <div class = 'radio'>
        <label> <input type='radio' class= 'attitude-radio' id = 'radioID2' name='optradio' value ='-1'> Negative</label></div>
        <div class = 'radio'>
        <label><input type='radio' class = 'attitude-radio' id = 'radioID3' name='optradio' value= '0'>Neutral</label></div>
        <div class = 'radio'>
        <label><input type = 'radio' class= 'attitude-radio' id = 'radioID4' name = 'optradio' value ='1'> Positive</label></div>
        <div class = 'radio'>
        <label> <input type = 'radio' class = 'attitude-radio' id = 'radioID5' name = 'optradio' value ='2'>Strongly Positive </labe></div>
        <div class = 'radio'>
        <label><input type = 'radio' class = 'attitude-radio' id = 'radioID6' name = 'optradio' value = 'Unknown'>Unknown</label></div>
		<!--<div id='piechart' style='width: 450px; height: 300px;' display: inline-block'></div> --> 
	</form>";
echo "</div><!-- well -->";
echo "</div><!-- col -->";
echo "</div><!-- row -->";

//language stuff
//submit button
echo" <div class = 'col-sm-12 text-center'>";
echo "<button type ='button' class='btn btn-default pull-center' data-toggle='modal' id='submit-button' tweet_id='$id' data-target='.conf-modal'>Submit the classification!</button>";
echo "&nbsp;&nbsp;";
echo "<button type ='button' class='btn btn-default pull-center' data-toggle='modal' id='discuss-tweet-button' tweet_id='$id' >Discuss this tweet!</button>";
echo "<font size = '2'><center><b>An attitude and cateegory are required to submit the tweet</b></font>";
echo "</div><!--col-->";
//tweet classified alert :)
echo "<div class='row'>
          <div class='span12 text-center'>
              <div id='tweet-alert' class='alert alert-success hide-me'>
              Thanks! Your tweet has been classified.
	      </div>
          </div>
      </div>";

//javascript for graphs being drawn
echo"</div> <!-- /container -->";
print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson, and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
