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
					K-2 Lesson Plan
				</button>
				</a>

				<a href='docs/3-5.docx'>
				<button type='button' class='btn btn-default'>
					3-5 Lesson Plan
				</button>
				</a>

				<a href='docs/6-8.docx'>
				<button type='button' class='btn btn-default'>
					6-8 Lesson Plan
				</button>
				</a>

				<a href='docs/9-10.docx'>
				<button type='button' class='btn btn-default'>
					9-10 Lesson Plan
				</button>
				</a>

				<a href='11-12.doc'>
				<button type='button' class='btn btn-default'>
					11-12 Lesson Plan
				</button>
				</a>
			</div><!--well-->
		</div><!--col-->
    </div><!--row-->
</div><!--container-->
";

?>
