<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/news.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/csg_uotd.php");

//$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Climate Tweets", "$css_header", "climate");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo "
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12'>
";


//these lines will add images
$carousel_info['items'][] = array(
    'active' => 'true',
    'image' => './images/improvement1twitterlogo.psd',
    'caption' => '',
    'text' => "The Climate Tweets Project studies public opinions about climate change by analyzing tweets. The goal is to discover patterns of opinions on climate change in different parts of our planet. We ask for your help in understanding content of the tweets!"); 
$carousel_info['items'][] = array(
    'image' => './images/bluemarblewest.png',
    'caption' => '',
    'text' => "Please classify each tweet into no more than three categories following the instructions. You will be asked about the attitude that the tweets express. Before starting the survey, please read the instructions carefully.");



$projects_template = file_get_contents($cwd[__FILE__] . "/../../citizen_science_grid/templates/carousel.html");

$m = new Mustache_Engine;
echo $m->render($projects_template, $carousel_info);



echo "
    <div class='btn-group btn-group-justified pull-center' style='margin-top:20px; padding-left:30px; padding-right:30px;'>
        <a class='btn btn-primary' role='button' href='./classify_tweets.php'><h4>Help us understand the Tweets! <font color='red'>18+</font></h4></a>
    </div>
";


/*echo "
            <div class='btn-group btn-group-justified' style='margin-top:20px;'>
                <a class='btn btn-primary' role='button' href='./classify_tweets.php'><h4>Help us understand the Tweets! <font color='red'>18+</font></h4></a>
            </div>*/

echo "
            </div> <!-- col-sm-12 -->
        </div> <!-- row -->

        <div class='row'>
            <div class='col-sm-6'>";

show_uotd(2, 10, "style='margin-top:20px;'", false);
csg_show_news();

echo "
            </div> <!-- col-sm-6 -->

            <div class='col-sm-6'>";

include $cwd[__FILE__] . "/templates/climate_info.html";

echo "
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
    </div> <!-- /container -->";


print_footer('Travis Desell and the DNA@Home Team', 'Travis Desell, Archana Dhasarathy, Sergei Nechaev');

echo "</body></html>";

?>
