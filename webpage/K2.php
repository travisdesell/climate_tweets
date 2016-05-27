<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");
//require_once($cwd[__FILE__] . "/get_languages.php");
//require_once($cwd[__FILE__] . "/get_next_tweet.php");
//$user = csg_get_user();
//$user_id = $user['id'];
echo"
<script src='js/FileSaver.js'></script>";
$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css'/>";
$js_header = "<script type='text/javascript' src='js/K2.js'></script>";
//$filesaver_api = "<script src='https://raw.github.com/eligrey/FileSaver.js/master/FileSaver.js'/>";
print_header("Tweet Selection", "$css_header $js_header", "");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

$repeat = array();

$results = query_boinc_db("SELECT text FROM climate_tweets where lang='en' and prof=0 order by rand() LIMIT 60");
while($row=mysqli_fetch_array($results)) {
	$stupid = $row[0];
	$repeat['repeat'][] = array('text'=>$stupid);
}

$tweet_template = file_get_contents($cwd[__FILE__] . "/templates/tweet_selection.html");
$renderme = new Mustache_Engine;
echo $renderme->render($tweet_template, $repeat);

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
