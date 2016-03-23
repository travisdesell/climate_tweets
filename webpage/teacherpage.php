
<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");
require_once($cwd[__FILE__] . "/get_languages.php");

$user = csg_get_user();
$user_id = $user['id'];

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Teacher Page", "$css_header <script type='text/javascript' src='js/climate_tweets.js'></script><script type='text/javascript' src='js/discuss.js'></script>", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo"<http://pietervanklinken.nl/wp-content/uploads/2010/10/twitter-creative-commons-2.jpg>";

//modal for instructions
echo "
<div class='container'>
	<div class = 'col-sm-12'>
	<div class = 'row row-centered'>
		
		<h1><center>Tweet Classification Results</center></h1>	
	
	</div>
	</div>
    <div class='col-sm-12'>
        <div class='row row-centered'>

    <!-- Button trigger modal -->
    <div class = 'span6' style = 'text-align:center'>
    <button type='button' id = 'button1' class='btn btn-success btn-lg' data-toggle='modal' data-target='#myModal'>
      Instructions
    </button>


    <!-- Modal -->
    <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <div class='modal-body' style = 'text-align: left'>
          <font size = '4'><b>Classifications</b><br></font>
          <i>Assume that \"global warming\" and \"climate change\" are synonyms. Classify each tweet using no more than three categories listed below. If you cannot find any suitable category, select Other and the Unknown attitude and submit.</i><br>
			<br>		
			<b>Attitudes</b><br>
				-2: Strongly Negative: Denial, skepticism with strong emotional component. \"Man made GLOBAL WARMING HOAX EXPOSED\"<br>
				-1: Negative: <i>\"Sunny on my porch in December. Global Warming ain't so bad\"</i><br>
				0: Neutral: <i>\"A new article on climate change is published in a newspaper.\"</i><br>
				1. Positive: <i>\"How's planet Earth doing? Take a look at the signs of climate change here\"</i><br>
				2. Strongly Positive: Very supportive, with strong emotional component.<i>\"Global warming? It's like earth having a Sauna!\"</i><br>
				<br>
				<table class = 'table table-striped' id = 'tblGrid'>
					<thead>
						<tr>
							<th width = '35%'>Categories</th>
							<th width = '65%'>Explanation and <i>Examples</i></th>
						</tr>
					</thead>							
					<tbody>
						<tr>
							<td><b>Drivers of Climate Change</b></td>
							<td>Greenhouse gases mentioned such as Carbon Monoxide, Methane, or Nitrous Oxide 
								<i>\"Oil, gas, and coal!\"</i></td>	
						</tr>
						<tr>
							<td><b>Science of Climate Change</b></td>
							<td><i>\"The Scientists found that the climate is in fact cooling.\"
								\"IPCC said that the temperature will be up by 4 degrees C.\"</i><br>
						</tr>	
						<tr>
							<td><b>Denial of Climate Change</b></td>
							<td>skepticism, conspiracy theory
								<i>\"Scientists are lying to the public\"</i><br>
						</tr>	
						<tr>
							<td><b>Politics</b></td>
							<td>Mentions conservatives, liberals, elections, carbon tax, etc..
									<i>\"It is too expensive to control CC\"
									\"Treaties\"</i>
							</td>
						</tr>
						<tr>
							<td><b>Ethics and Moral Responsibility</b></td>
							<td><i>\"We need to fight for global warming!\"
									\"We need to give this planet to the next generation\"
									\"God gave us the planet to take care of\"</i>
							</td>
						</tr>
						<tr>
							<td><b>Extreme Events</b></td>
							<td><i>\"Hurricane Sandy, flooding, snowstorm\"</i></td>
						</tr>
