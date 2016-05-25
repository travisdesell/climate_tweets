<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");


function match_classifications($c1, $c2, &$accuracy_difference, &$category_matches, &$category_mismatches) {
    $accuracy_difference = abs($c1['attitude'] - $c2['attitude']);

    $category_matches = 0;
    $category_mismatches = 0;

    if      ($c1['phenomenon_drivers'] + $c2['phenomenon_drivers'] == 2)        $category_matches++;
    else if ($c1['phenomenon_drivers'] + $c2['phenomenon_drivers'] == 1)        $category_mismatches++;
    if      ($c1['phenomenon_denial'] + $c2['phenomenon_denial'] == 2)          $category_matches++;
    else if ($c1['phenomenon_denial'] + $c2['phenomenon_denial'] == 1)          $category_mismatches++;
    if      ($c1['phenomenon_science'] + $c2['phenomenon_science'] == 2)        $category_matches++;
    else if ($c1['phenomenon_science'] + $c2['phenomenon_science'] == 1)        $category_mismatches++;

    if      ($c1['impacts_extreme'] + $c2['impacts_extreme'] == 2)              $category_matches++;
    else if ($c1['impacts_extreme'] + $c2['impacts_extreme'] == 1)              $category_mismatches++;
    if      ($c1['impacts_weather'] + $c2['impacts_weather'] == 2)              $category_matches++;
    else if ($c1['impacts_weather'] + $c2['impacts_weather'] == 1)              $category_mismatches++;
    if      ($c1['impacts_environment'] + $c2['impacts_environment'] == 2)      $category_matches++;
    else if ($c1['impacts_environment'] + $c2['impacts_environment'] == 1)      $category_mismatches++;
    if      ($c1['impacts_society'] + $c2['impacts_society'] == 2)              $category_matches++;
    else if ($c1['impacts_society'] + $c2['impacts_society'] == 1)              $category_mismatches++;

    if      ($c1['adaptation_politics'] + $c2['adaptation_politics'] == 2)      $category_matches++;
    else if ($c1['adaptation_politics'] + $c2['adaptation_politics'] == 1)      $category_mismatches++;
    if      ($c1['adaptation_ethics'] + $c2['adaptation_ethics'] == 2)          $category_matches++;
    else if ($c1['adaptation_ethics'] + $c2['adaptation_ethics'] == 1)          $category_mismatches++;

    if      ($c1['unknown'] + $c2['unknown'] == 2)                              $category_matches++;
    else if ($c1['unknown'] + $c2['unknown'] == 1)                              $category_mismatches++;
}

//$query = "SELECT id, tweet_id FROM climate_tweets WHERE number_views > 1";
//$query = "SELECT id, tweet_id FROM climate_tweets WHERE number_views = required_views AND status = 'IN_PROGRESS'";
$query = "SELECT id, tweet_id, number_views, required_views FROM climate_tweets WHERE number_views > 1 AND status = 'IN_PROGRESS'";
echo $query . "\n";

$result = query_boinc_db($query);

$count = 0;

$full_matches = 0;
$close_matches = 0;
$far_matches = 0;
$exact_accuracy = 0;
$close_accuracy = 0;

$mismatches = array();
$matches = array();

$number_valid = 0;
$tweets_finished = 0;
$number_classifications = 0;

while ($row = $result->fetch_assoc()) {
    echo "\nprocessing: '" . $row['id'] . "'\n";
    $tweet_id = $row['id'];

    $query = "SELECT * FROM tweet_classifications WHERE tweet_id = $tweet_id";
    echo $query . "\n";
    $classified_tweets_result = query_boinc_db($query);

    $tweets = array();
    while ($classified_tweets_row = $classified_tweets_result->fetch_assoc()) {

        $tweets[] = $classified_tweets_row;

        $number_classifications++;
    }

    $valids = array();
    for ($i = 0; $i < count($tweets); $i++) {
        $valids[$i] = false;
    }

    $i = 0;
    while ($i < count($tweets)) {
        echo "\t\t" . json_encode($tweets[$i]) . "\n";

        $j = $i + 1;

        while ($j < count($tweets)) {
            match_classifications($tweets[$i], $tweets[$j], $accuracy_difference, $category_matches, $category_mismatches);

            if ($accuracy_difference == 0 && $category_mismatches == 0) {
                echo "$i x $j = FULL MATCH!\n";
                $full_matches++;
            }
            
            if ($accuracy_difference == 1 && $category_matches > $category_mismatches) {
                echo "$i x $j = CLOSE MATCH!\n";
                $close_matches++;
            }
            
            if ($accuracy_difference == 1 && ($category_matches == 1 || $category_mismatches == 0)) {
                echo "$i x $j = FAR MATCH!\n";
                $far_matches++;
            }

            if ($accuracy_difference == 0) {
                $exact_accuracy++;
                $close_accuracy++;
            }

            if ($accuracy_difference == 1) {
                $close_accuracy++;
            }

            if (array_key_exists($category_mismatches, $mismatches)) {
                $mismatches[$category_mismatches]++;
            } else {
                $mismatches[$category_mismatches] = 1;
            }

            if (array_key_exists($category_matches, $matches)) {
                $matches[$category_matches]++;
            } else {
                $matches[$category_matches] = 1;
            }

            if (($accuracy_difference == 0 || $accuracy_difference == 1 || $accuracy_difference == -1) && $category_matches >= 1) {
            //if (($accuracy_difference == 0 || $accuracy_difference == 1 || $accuracy_difference == -1) && $category_mismatches <= 1) {
                $valids[$i] = true;
                $valids[$j] = true;
            }

            $j++;
        }
        $i++;
    }

    $valid_for_tweet = 0;
    for ($i = 0; $i < count($tweets); $i++) {
        if ($valids[$i] == true) {
            $valid_for_tweet++;
            $number_valid++;

            echo json_encode($tweets[$i]) . "\n";

            if ($tweets[$i]['status'] != 'VALID') {
                $query = "UPDATE tweet_classifications SET status = 'VALID' WHERE id = " . $tweets[$i]['id'];
                echo $query . "\n";
                query_boinc_db($query);

                $query = "UPDATE user SET valid_tweets = valid_tweets + 1 WHERE id = " . $tweets[$i]['user_id'];
                echo $query . "\n";
                query_boinc_db($query);

                $query = "SELECT teamid FROM user WHERE id = " . $tweets[$i]['user_id'];
                echo $query . "\n";
                $teamid_result = query_boinc_db($query);

                if (($teamid_row = $teamid_result->fetch_assoc()) != NULL) {
                    $teamid = $teamid_row['teamid'];
                    echo "TEAMID: $teamid";

                    if ($teamid > 0) {
                        $query = "UPDATE team SET valid_tweets = valid_tweets + 1 WHERE id = $teamid";
                        echo $query . "\n";
                        query_boinc_db($query);
                    }
                }
            }
        }

    }

    if ($valid_for_tweet == count($tweets) || count($tweets) >= 5) {
        $tweets_finished++;

        //UPDATE TWEET SUCH THAT 
        if ($row['number_views'] == $row['required_views']) {
            $query = "UPDATE climate_tweets SET status = 'OVER' WHERE id = $tweet_id";
            echo $query . "\n";

            query_boinc_db($query);
        }
    } else {
        $query = "UPDATE climate_tweets SET required_views = required_views + 1 WHERE id = $tweet_id";
        echo $query . "\n";

        query_boinc_db($query);
    }

    //attitudes need to either match as neutral/inconclusive, denial (either -2 or - 1) or ackowledgement (either 1 or 2) or unknown
    //should match at least one category

    $count++;

}

echo "$count tweets met required views\n";
echo "$tweets_finished tweets all valid\n";

echo "\ntotal classifications: $number_classifications\n";
echo "\nnumber valid: $number_valid\n\n";

echo "$full_matches full matches\n";
echo "$close_matches close matches\n";
echo "$far_matches far matches\n";
echo "$exact_accuracy had same accuracy\n";
echo "$close_accuracy had close accuracy\n";


/*
print_r($matches);
echo "\n";

print_r($mismatches);
echo "\n";
 */

$keys = array_keys($matches);
sort($keys);
/*
echo "matches keys:\n";
print_r($keys);
echo "\n";
 */

foreach ($keys as $key) {
    echo "matches[$key]: " . $matches[$key] . "\n";
}

$keys = array_keys($mismatches);
sort($keys);
/*
echo "mismatches keys:\n";
print_r($keys);
echo "\n";
 */

foreach ($keys as $key) {
    echo "mismatches[$key]: " . $mismatches[$key] . "\n";
}


?>
