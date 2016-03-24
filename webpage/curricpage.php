<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");


$user = csg_get_user();
$user_id = $user['id'];

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Download Curriculum", "$css_header <script type='text/javascript' src='js/climate_tweets.js'></script><script type='text/javascript' src='js/discuss.js'></script>", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");


echo "
<div class='container'>
    <div class='row'>
	<div class='col-sm-8'>
    
        <h1>Curriculum Download</h1>
        </div><!--col-->
    </div><!--row-->


<p>Please double check your information. Click to submit and begin download.</p>
<div class='btn btn-success'>Submit and Download</div>
</div>

</div><!--container-->
";


