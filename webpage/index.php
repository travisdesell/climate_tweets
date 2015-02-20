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

print_header("Climate Tweets", "", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo "
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12'>
";


//these lines will add images
$carousel_info['items'][] = array(
    'active' => 'true',
    'image' => './images/dna_image_2.png',
    'caption' => 'can put captions here.',
    'text' => "Need a blurb here for the climate change twitter project. Need cool images too.");

$carousel_info['items'][] = array(
    'image' => './images/e-cadherin_after_snail_expression.png',
    'caption' => 'This image shows what happens to the E-cadherin protein (stained in red) after Snail expression.',
    'text' => "Need a blurb here for the climate change twitter project. Need cool images too.");

$projects_template = file_get_contents($cwd[__FILE__] . "/../../citizen_science_grid/templates/carousel.html");

$m = new Mustache_Engine;
echo $m->render($projects_template, $carousel_info);


echo "
            <div class='btn-group btn-group-justified' style='margin-top:20px;'>
                <a class='btn btn-primary' role='button' href='../instructions.php'><h4>Volunteer Your Computer</h4></a>
            </div>

            </div> <!-- col-sm-12 -->
        </div> <!-- row -->

        <div class='row'>
            <div class='col-sm-6'>";

show_uotd(2, 10, "style='margin-top:20px;'");
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
