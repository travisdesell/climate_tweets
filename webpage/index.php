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

print_header("Climate Tweets", "", "climate");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo "
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12'>
";


//these lines will add images
$carousel_info['items'][] = array(
    'active' => 'true',
    'image' => 'https://g.twimg.com/Twitter_logo_blue.png',
    'caption' => '',
    'text' => "The Climate Tweets project is focused on personal opinions about climate change or global warming. The goal is to sort tweets and view the different views in various countries, how the discussion has changed over time, and how opinions change with political orientation.");
$carousel_info['items'][] = array(
    'image' => 'http://solarviews.com/raw/earth/bluemarblewest.jpg',
    'caption' => '',
    'text' => "Classifying tweets allows us to discover patterns and coorelations in people's opinions about our world. It also helps us understand what people know about climate change.");

$projects_template = file_get_contents($cwd[__FILE__] . "/../../citizen_science_grid/templates/carousel.html");

$m = new Mustache_Engine;
echo $m->render($projects_template, $carousel_info);


echo "
            <div class='btn-group btn-group-justified' style='margin-top:20px;'>
                <a class='btn btn-primary' role='button' href='./classify_tweets.php'><h4>Help us understand the Tweets! <font color='red'>18+</font></h4></a>
            </div>

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
