<?php
//Something to do with the validator.
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");
require_once($cwd[__FILE__] . "/get_languages.php");
require_once($cwd[__FILE__] . "/get_next_tweet.php");

$user = csg_get_user();
$user_id = $user['id'];

//$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";
//$js_header = "<script type='text/javascript' src='js/climate_tweets.js'></script><script type='text/javascript' src='js/discuss.js'></script>";

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Reviewing Your Climate Tweets", "$css_header $js_header", "climate");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");


$filter = 'none';
if (array_key_exists('filter', $_GET)) {
    $filter = $boinc_db->real_escape_string($_GET['filter']);
    if ($filter == '') $filter = 'none';
}


$min = 0;
if (array_key_exists('min', $_GET)) {
    $min = $boinc_db->real_escape_string($_GET['min']);
    if ($min == '') $min = 0;
}

$prev_min = $min - 20;
if ($prev_min < 0) $prev_min = 0;
$next_min = $min + 20;

echo "<div id='filter_div' filter='$filter'></div>";

echo "
    <div class='container' style='margin-bottom:10px;'>
        <div class='row'>
            <div class='col-sm-9'></div>";

echo "            <div class='col-sm-2' style='padding-left:0px; padding-right:0px';>";

echo "  <a class='btn btn-default pull-right' href=\"./review_tweets.php?filter=$filter&min=$next_min\">
            Next <span class='glyphicon glyphicon-chevron-right'></span>
        </a>";

if ($min > 0) {
    echo "<a class='btn btn-default pull-right' href=\"./review_tweets.php?filter=$filter&min=$prev_min\">
            <span class='glyphicon glyphicon-chevron-left'></span> Previous 
          </a>";
}

echo "</div> <!-- col-sm-2 -->";

echo "<div class='col-sm-1' style='padding-left:0px; padding-right:0px';>
        <div class='dropdown pull-right'>
            <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                Filter
                <span class='caret'></span>
            </button>
            <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                <li><a href=\"./review_tweets.php?filter=none&min=$prev_min\">None</a></li>
                <li><a href=\"./review_tweets.php?filter=valid&min=$prev_min\">Valid</a></li>
                <li><a href=\"./review_tweets.php?filter=invalid&min=$prev_min\">Invalid</a></li>
                <li><a href=\"./review_tweets.php?filter=inconclusive&min=$prev_min\">Inconclusive</a></li>
                <li><a href=\"./review_tweets.php?filter=too_many&min=$prev_min\">Too Many</a></li>
            </ul>
        </div>
    </div> <!-- col-sm-1 -->";

echo "
        </div> <!-- row -->
     </div> <!-- container -->";


function get_classification_row($classification_row) {
    $user_result = query_boinc_db("SELECT name FROM user WHERE id = " . $classification_row['user_id']);
    $user_row = $user_result->fetch_assoc();

    $status = '';
    if ($classification_row['status'] == 'INCONCLUSIVE') $status = 'inconclusive';
    if ($classification_row['status'] == 'VALID') $status = 'valid';
    if ($classification_row['status'] == 'INVALID') $status = 'invalid';
    if ($classification_row['status'] == 'TOO_MANY') $status = 'too many';

    $status_class = '';
    if ($status == 'valid') $status_class = "class='success'";
    if ($status == 'invalid') $status_class = "class='danger'";
    if ($status == 'too_many') $status_class = "class='warning'";

    $phenomenon = '';
    if ($classification_row['phenomenon_drivers'] == 1) $phenomenon .= "drivers ";
    if ($classification_row['phenomenon_science'] == 1) $phenomenon .= "science ";
    if ($classification_row['phenomenon_denial'] == 1) $phenomenon .= "denial ";

    $impacts = '';
    if ($classification_row['impacts_extreme'] == 1) $impacts .= "extreme ";
    if ($classification_row['impacts_weather'] == 1) $impacts .= "weather ";
    if ($classification_row['impacts_environment'] == 1) $impacts .= "environment ";
    if ($classification_row['impacts_society'] == 1) $impacts .= "society ";

    $adaptation = '';
    if ($classification_row['adaptation_politics'] == 1) $adaptation .= "politics ";
    if ($classification_row['adaptation_ethics'] == 1) $adaptation .= "ethics ";

    $unknown = '';
    if ($classification_row['unknown'] == 1) $unknown .= "unknown";

    $attitude = '';
    if ($classification_row['attitude'] == -2) $attitude = "strong denial";
    if ($classification_row['attitude'] == -1) $attitude = "denial";
    if ($classification_row['attitude'] ==  0) $attitude = "inconclusive";
    if ($classification_row['attitude'] ==  1) $attitude = "acknowledgement";
    if ($classification_row['attitude'] ==  2) $attitude = "strong acknowledgement";

    /*
    return "
        <div class='row'>
            <div class='col-sm-1'></div>
            <div class='col-sm-11'>
                <div class='row'>
                    <div class='col-sm-2'>" . $user_row['name'] . "</div>
                    <div class='col-sm-2'>" . $classification_row['attitude'] . "</div>
                    <div class='col-sm-2'>" . $phenomenon . "</div>
                    <div class='col-sm-2'>" . $impacts . "</div>
                    <div class='col-sm-2'>" . $adaptation . "</div>
                    <div class='col-sm-2'>" . $unknown. "</div>
                </div> <!-- row -->
            </div>  <!-- col-sm-11'-->
        </div>  <!-- row -->
    ";
     */

    return "
        <tr $status_class>
            <td>" . $status . "</td>
            <td>" . $user_row['name'] . "</td>
            <td>" . $classification_row['attitude'] . "</td>
            <td>" . $phenomenon . "</td>
            <td>" . $impacts . "</td>
            <td>" . $adaptation . "</td>
            <td>" . $unknown. "</td>
        </tr>
    ";
}

if ($filter == 'none') {
    $result = query_boinc_db("SELECT * FROM tweet_classifications WHERE user_id = $user_id LIMIT $min, 20");
} else if ($filter == 'valid') {
    $result = query_boinc_db("SELECT * FROM tweet_classifications WHERE user_id = $user_id AND status = 'VALID' LIMIT $min, 20");
} else if ($filter == 'invalid') {
    $result = query_boinc_db("SELECT * FROM tweet_classifications WHERE user_id = $user_id AND status = 'INVALID' LIMIT $min, 20");
} else if ($filter == 'inconclusive') {
    $result = query_boinc_db("SELECT * FROM tweet_classifications WHERE user_id = $user_id AND status = 'INCONCLUSIVE' LIMIT $min, 20");
} else if ($filter == 'too_many') {
    $result = query_boinc_db("SELECT * FROM tweet_classifications WHERE user_id = $user_id AND status = 'TOO_MANY' LIMIT $min, 20");
} else {
    $result = query_boinc_db("SELECT * FROM tweet_classifications WHERE user_id = $user_id LIMIT $min, 20");
}


while (($classification_row = $result->fetch_assoc()) != NULL) {
    echo "<div class='container'>
            <div class='row row-centered'>
                    <div class='well well-sm'>";

    $tweet_result = query_boinc_db("SELECT * FROM climate_tweets WHERE id = " . $classification_row['tweet_id']);
    $tweet_row = $tweet_result->fetch_assoc();

    echo "
        <div class='row'>
            <div class='col-sm-1'>
            <h4>" . $tweet_row['id'] . "</h4>
            </div>
            <div class='col-sm-11'>
            <h4>" . $tweet_row['text'] . "</h4>
            <hr>
            <table class='table table-striped table-condensed'>
                <thead>
                    <th style='width:100px;'>Status</th>
                    <th style='width:200px;'>User</th>
                    <th style='width:75px;'>Attitude</th>
                    <th style='width:200px;'>Phenomenon</th>
                    <th style='width:200px;'>Impact</th>
                    <th style='width:200px;'>Adaptation</th>
                    <th style='width:100px;'>Other</th>
                </thead>";

    echo get_classification_row($classification_row);

    $other_query = "SELECT * FROM tweet_classifications WHERE tweet_id = '" . $classification_row['tweet_id'] . "' AND user_id != " . $user_id;
    //echo "<tr> $other_query </tr>";
    $other_classifications_result = query_boinc_db($other_query);
    while (($other_classification_row = $other_classifications_result->fetch_assoc()) != NULL) {
        //echo "<tr>" . json_encode($other_classification_row) . "</tr>";
        echo get_classification_row($other_classification_row);
    }

    echo "
                </table>
            </div> <!-- col-sm-11 -->
        </div> <!-- row -->
        ";

    echo "          </div><!-- well -->
            </div><!-- row -->
        </div><!-- container -->";

}


print_footer('<strong>Travis Desell and the Climate Tweets Team</strong>', '<strong>Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko</strong>');
echo "</body></html>";
?>
