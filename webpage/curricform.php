
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

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/curriculum_style.css' />";

print_header("Download Curriculum", "$css_header", "");
//insert javascript <script> in print_header above

echo "
<div class='container'>
    <div class='row'>
	<div class='col-sm-8'>
    
    <h1>Curriculum Download</h1>
	<p>We use your information for ... To use all available resources, please create an account.</p>
            <div class='input-group'>
	        <input type='text' class='form-control' placeholder='First Name' aria-describedby='basic-addon1'>
	        <input type='text' class='form-control' placeholder='Last Name' aria-describedby='basic-addon1'>
	        <input type='text' class='form-control' placeholder='Email' aria-describedby='basic-addon1'>
	        <input type='text' class='form-control' placeholder='Work Phone' aria-describedby='basic-addon1'>
	        <input type='text' class='form-control' placeholder='School' aria-describedby='basic-addon1'>
	        <input type='text' class='form-control' placeholder='School District' aria-describedby='basic-addon1'>
        	<textarea rows='3' input type='text' class='form-control' placeholder='Comments' aria-describedby='basic-addon1'></textarea>
			</div><!--input-->
        </div><!--col-->
    </div><!--row-->

<p>Please double check your information. Click to submit and view lesson plans.</p>
<a href='http://csgrid.org/csg/climate_lwingate/curricpage.php'>
<div class='btn btn-default'>Submit</div>
</div>
</a>

</div><!--container-->
";
