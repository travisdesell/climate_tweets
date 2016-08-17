<?php
//THis is the page where the teachers will go to select the tweets they want to use and create a text file. It is linked to the template tweet_selection (in the directory templates) and the 
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

//This header allows the js API FileSaver to create a file with the tweets on the user side
echo"
<script src='js/FileSaver.js'></script>";

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css'/>";
$js_header = "<script type='text/javascript' src='js/K2.js'></script>";
//$filesaver_api = "<script src='https://raw.github.com/eligrey/FileSaver.js/master/FileSaver.js'/>";
print_header("Tweet Selection", "$css_header $js_header", "");

$repeat = array();

$results = query_boinc_db("SELECT text FROM climate_tweets where lang='en' and prof=0 order by rand() LIMIT 60");
while($row=mysqli_fetch_array($results)) {
	$stupid = $row[0];
	$repeat['repeat'][] = array('text'=>$stupid);
}

$tweet_template = file_get_contents($cwd[__FILE__] . "/templates/tweet_selection.html");
$renderme = new Mustache_Engine;
echo $renderme->render($tweet_template, $repeat);

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
