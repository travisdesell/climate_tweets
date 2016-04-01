<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");
/*
$user = csg_get_user();
$user_id = $user['id'];
*/
$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Download Curriculum", "$css_header", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");


echo "
<div class='container'>
    <div class='row'>
	<div class='col-sm-8'>
        <h1>Climate Tweets - Lesson Plans</h1>
        	<div class='well'>
				<a href='docs/K-2.docx'>
				<button type='button' class='btn btn-default'>
					Lesson Plan
				</button>
				</a>
			</div><!--well-->
		</div><!--col-->
    </div><!--row-->
</div><!--container-->
";

?>
