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
$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style2.css' />";

print_header("Download Curriculum", "$css_header", "dna");

echo "
<div class='container'>
    <div class='row'>
		<div class='col-sm-12'>
			<div class='well'>
        		<h1>Climate Tweets Lesson Plans</h1>
			</div><!--well-->
		</div><!--col-->
	</div><!--row-->
	<div class='row'>
		<div class='col-sm-6'>
        	<div class='well'>
				<h4>K-2 Lesson Plan</h4>
					<p>Develop understanding of the difference between climate and weather.</p>
				<a href='docs/K-2.docx'>
				<button type='button' class='btn btn-default btn-sm'>
					Download Word Doc
				</button>
				</a>
				<a href='docs/K-2.pdf'>
				<button type='button' class='btn btn-default btn-sm'>
					Download PDF 
				</button>
				</a>

			</div><!--div-->
		</div><!--col-->
		<div class='col-sm-6'>
			<div class='well'>
				<h4>3-5 Lesson Plan</h4>
					<p>Develop an understanding of why climate change is considered a problem and encourage students to take action.</p>	
				<a href='docs/3-5.docx'>
				<button type='button' class='btn btn-default btn-sm'>
					Download Word Doc
				</button>
				</a>
				<a href='docs/3-5.pdf'>
				<button type='button' class='btn btn-default btn-sm'>
					Download PDF 
				</button>
				</a>

			</div><!--well-->		
		</div><!--col-->
	</div><!--row-->
	<div class='row'>
		<div class='col-sm-6'>
			<div class='well'>
				<h4>6-8 Lesson Plan</h4>
					<p>Develop data analysis skills and critically evaluate opinion vs. fact.</p>
				<a href='docs/6-8.docx'>
				<button type='button' class='btn btn-default btn-sm'>
					Download Word Doc 
				</button>
				</a>	
				<a href='docs/6-8.pdf'>
				<button type='button' class='btn btn-default btn-sm'>
					Download PDF 
				</button>
				</a>

			</div><!--well-->
		</div><!--col-->

		<div class='col-sm-6'>
			<div class='well'>
				<h4>9-10 Lesson Plan</h4>
					<p>Critically interpret public opinion of climate change and provide an accurate analysis for review by researchers.</p>
				<a href='docs/9-10.docx'>
				<button type='button' class='btn btn-default btn-sm'>
					Download Word Doc 
				</button>
				</a>
				<a href='docs/9-10.pdf'>
				<button type='button' class='btn btn-default btn-sm'>
					Download PDF 
				</button>
				</a>

			</div><!--well-->
		</div><!--col-->
	</div><!--row-->	
	<div class='row'>
		<div class='col-sm-6'>
			<div class='well'>
				<h4>11-12 Lesson Plan</h4>
					<p>Develop data analysis skills and critically evaluate opinion vs. fact.</p>
				<a href='docs/11-12.docx'>
				<button type='button' class='btn btn-default btn-sm'>
					Download Word Doc
				</button>
				</a>
				<a href='docs/11-12.pdf'>
				<button type='button' class='btn btn-default btn-sm'>
					Download PDF
				</button>
				</a>

			</div><!--well-->
		</div><!--col-->
    </div><!--row-->
</div><!--container-->
";
print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko</strong>');
?>
