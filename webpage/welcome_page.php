<?php

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
			<p>Welcome! In collaboration with the local school district, we have developed and implemented several lesson plans involving Climate Change. We have made these available to the public here. You and your students may create accounts to gain access to all the resources available.  

			</div><!--well-->
		</div><!--col-->
	</div><!--row-->
</div><!--container-->

";

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
