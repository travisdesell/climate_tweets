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
require_once($cwd[__FILE__] . "/get_next_tweet.php");
/*require_once($cwd[__FILE__] . "/../mustache.php/src/Mustache/Autoloader.php";
Mustache_Autoloader::register();
*/
$user = csg_get_user();
$user_id = $user['id'];

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Tweet Selection", "$css_header <script type='text/javascript' src='js/climate_tweets.js'></script><script type='text/javascript' src='js/discuss.js'></script>", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

class testing {
	public $text = "blah blah blah!!!!!!";
	
	public function test() {
		return $this->text;
		//return $this->checkbox;
	}
}

$tweet_selection = file_get_contents($cwd[__FILE__] . "/templates/tweet_selection.html");

$m = new Mustache_Engine;
$testing = new testing;
echo $m->render($tweet_selection, $testing);

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
