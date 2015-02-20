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

print_header("Classifying Climate Tweets", "", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo "
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12'>
";

echo "Put stuff here for classifying climate tweets!";


echo "
            </div> <!-- col-sm-6 -->
        </div> <!-- row -->
    </div> <!-- /container -->";


print_footer('Travis Desell and the Climate Tweets Team', 'Aaron Bergstrom, Travis Desell, Andrei Kirilenko');

echo "</body></html>";

?>
