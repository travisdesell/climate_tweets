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

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/curriculum_style.css' />";

print_header("Welcome Page", "$css_header", "");

echo"
<div class='container'>
	<div class='row'>
		<div class='col-sm-12'>

		<h1><center>The Climate Tweets Project</center></h1>	
		<div class='well'>
		<p>Welcome to the Climate Tweet Project. In collaboration with the local school district, we have developed and implemented several lesson plans introducing Climate Change as a lesson. We have made these available to the public here. You and your students may create accounts to gain access to all the resources available.  

		</div><!--well-->
		</div><!--col-->
	</div><!--row-->
</div><!--container-->

";

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
