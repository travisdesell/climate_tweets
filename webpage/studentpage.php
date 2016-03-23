<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");
require_once($cwd[__FILE__] . "/get_languages.php");

$user = csg_get_user();
$user_id = $user['id'];

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Classifying Climate Tweets", "$css_header <script type='text/javascript' src='js/climate_tweets.js'></script><script type='text/javascript' src='js/discuss.js'></script>", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo"
<div class='modal fade modal-black' id = 'warning-modal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-body'>
            <center><b><p>&nbsp;The views in these tweets do not reflect the attitudes of the University of North Dakota, the Climate Tweets Team, or the Citizen Science Grid.</p>
            <p>&nbsp;Some tweets included in the Climate Tweets project contain profanity. Continue only if you are 18 or older.</p>
            <p><font color = 'red'>Note: Tweets will be shown in English unless otherwise specified.</font></p></b>
            </div>
            <div class='modal-footer'>
                <button type='button' id = 'button1' class='btn btn-primary' data-dismiss='modal'>Continue</button>
                <button type='button' id = 'button2' class='btn btn-primary'>Go Back</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->";

echo"<http://pietervanklinken.nl/wp-content/uploads/2010/10/twitter-creative-commons-2.jpg>";

$langArray = get_languages($user_id);
$langArrayResult = implode(',',$langArray);

$langArrayQuery = '';
if ($langArrayResult != '') {
    $langArrayQuery = "lang IN ($langArrayResult) AND ";
}

//query for tweets only within languages selected
$query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE $langArrayQuery NOT EXISTS (select * FROM tweet_classifications tc where tc.tweet_id = ct.id and tc.user_id != $user_id) order by rand() limit 1";

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
	<button type='button' id = 'button1' class='btn btn-success btn-lg' data-toggle='modal' data-target='#myModal'>
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
