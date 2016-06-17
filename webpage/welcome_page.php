<?php
//This page is where teachers/students will login or create an account.
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/welcome_page_style.css' />";

print_header("Welcome Page", "$css_header", "");

echo"
<div class='container'>
	<div class='row'>
		<div class='col-sm-12'>
		<h1><center>The Climate Tweets Project</center></h1>	
		</div><!--col-->
	</div><!--row-->
	<div class='row'>
		<div class='col-sm-4'>
			<div class='well'>
				<div class='input-group'>
					<input type='text' class='form-control' placeholder='username'>
					<input type='text' class='form-control' placeholder='password'>	
				</div><!--input-->
				<p></p>
				<div class='btn btn-default'>Sign In</div>
				<a href='http://csgrid.org/csg/climate_lwingate/curricform.php'>
					<div class='btn btn-default'>New User</div>
				</a>
			</div><!--well-->
		</div><!--col-->
		<div class='col-sm-8'>	
			<div class='well'>
				<p>
					Welcome to the Climate Tweets project. Climate Tweets measures the public's attitude toward climate change, a subject which can be highly controversial in online discussions. The lesson plans available here seek to educate K-12 students on the nature of climate change, the use of social media as a debate platform, and the need for civil public discourse. The Climate Tweets project developed these lesson plans in collaboration with the Dakota Science Center. We have made our lesson plans available through this online interface in the hope that you and your students will find the educational experience engaging and informative.
				</p>
			</div><!--well-->
		</div><!--col-->
	</div><!--row-->
</div><!--container-->

";

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
