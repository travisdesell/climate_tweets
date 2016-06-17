<?php
//This is the guide the teacher will see when they first log in
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/curriculum_style.css' />";

print_header("Download Curriculum", "$css_header", "");
//insert javascript <script> in print_header above

echo "
<div class='container'>
	<div class='row'>
		<div class='col-sm-12'>
			<center><h1>Teacher's Guide</h1></center>				
		</div><!--col-->
	</div><!--row-->
	<div class='row'>
		<div class='col-sm-12'>
			<div class='well'>
				K-2	
			</div><!--well-->
			<div class='well'>
				3-5
			</div>
			<div class='well'>
				6-8
			</div>
			<div class='well'>
				9-12
			</div>
		</div><!--col-->
	</div><!--row-->
</div><!--container-->
";

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko</strong>');

