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
			<center><h1>Educator's Guide</h1></center>				
		</div><!--col-->
	</div><!--row-->
	<div class='row'>
		<div class='col-sm-6'>
			<div class='well'>
				<h4>Grades K-2</h4>
					<p>Help the students develop an understanding of the difference between climate and weather with this lesson plan.</p>
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
				<br><br>
				<p>Create a list of tweets the students will analyze.</p>
				<a href='http://csgrid.org/csg/climate_lwingate/K2.php'>
				<button type='button' class='btn btn-default btn-sm'>
				Select Tweets
				</button>
				</a>
				<br><br>
				<p>Additional Materials: \nPut books here</p>
			</div><!--well-->
		</div><!--col-->
		<div class='col-sm-6'>
			<div class='well'>
				<h4>Grades 3-5</h4>
					<p>Help the students develop an understanding of why climate change is considered a problem and encourage students to take action.</p>	
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
				<br><br>
				<p>Additional Materials: Put books here</p>
			</div><!--well-->
		</div><!--col-->
	</div><!--row-->
	<div class='row'>
		<div class='col-sm-6'>
			<div class='well'>
				<h4>Grades 6-8</h4>
					<p>Help the students develop data analysis skills and critically evaluate opinion vs. fact.</p>
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
				<br><br>
				<p>Create a list of tweets the students will analyze.</p>
				<a href='http://csgrid.org/csg/climate_lwingate/K2.php'>
				<button type='button' class='btn btn-default btn-sm'>
				Select Tweets
				</button>
				</a>
				<br><br>
				<p>Additional Materials: \nPut books here</p>
			</div><!--well-->
		</div><!--col-->
		<div class='col-sm-6'>
			<div class='well'>
				<h4>Grades 9 and 10</h4>
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
				<h4>Grades 11 and 12</h4>
			</div><!--well-->
		</div><!--col-->
	</div><!--row-->
</div><!--container-->
";

print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko</strong>');

