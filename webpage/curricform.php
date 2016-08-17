<?php
//This page is used for gathering the teachers information and creating an account. 
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
    
    <h1>Curriculum Download</h1>
	<p>We use your information for ... To use all available resources, please create an account.</p>

			<form>
				<fieldset class='form-group'>
					<label for='example'>First Name</label>
					<input type='email' class='form-control' id='first_name' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Last Name</label>
					<input type='email' class='form-control' id='last_name' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Username</label>
					<input type='email' class='form-control' id='username' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Password</label>
					<input type='email' class='form-control' id='password' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Email</label>
					<input type='email' class='form-control' id='email' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Email (verify)</label>
					<input type='email' class='form-control' id='email_ver' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Cell Phone</label>
					<input type='email' class='form-control' id='cell_phone' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>Work Phone</label>
					<input type='email' class='form-control' id='work_phone' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>School</label>
					<input type='email' class='form-control' id='school' placeholder=''>
				</fieldset>
				<fieldset class='form-group'>
					<label for='example'>School District</label>
					<input type='email' class='form-control' id='school_district' placeholder=''>
				</fieldset>
			</form>
        </div><!--col-->
    </div><!--row-->
<p></p>
	<p><b>Please double check your information.</b></p>

	<a href='http://csgrid.org/csg/climate_lwingate/guide.php'>
		<div class='btn btn-default'>Submit</div>
		</div>
	</a>
</div><!--container-->
";
print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, Rhonda Olson and Andrei Kirilenko</strong>');

