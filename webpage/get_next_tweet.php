<?php
//This script is called when a tweet has been classified on classify_tweets and a new one is required. This page pulls tweets based on how many are classified and the validator, which Travis maintains.
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

/*
require_once($cwd[__FILE__] . '/../../citizen_science_grid/my_query.php');
require_once($cwd[__FILE__] . '/../../citizen_science_grid/user.php');
require_once($cwd[__FILE__] . '/get_languages.php');
 */

function get_next_tweet($user_id) {
    $langArray = get_languages($user_id);
    $langArrayResult = implode(',',$langArray);

    error_log("lang array is: '" . json_encode($langArray). "'");
    error_log("langArrayResult is: '" . $langArrayResult . "'");

    //echo "LANG ARRAY RESULT: '" . $langArrayResult . "'<br>";

    $langArrayQuery = ''; 
    if ($langArrayResult != '') {
        $langArrayQuery = "lang IN ($langArrayResult) AND ";
    }


    $query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE $langArrayQuery required_views = 10 AND number_views > 0 AND number_views < required_views AND NOT EXISTS(SELECT * FROM tweet_classifications tc WHERE tc.tweet_id = ct.id AND tc.user_id = $user_id) ORDER BY RAND() LIMIT 1";
    error_log($query);

    $result = query_boinc_db($query);

    $row = $result->fetch_assoc();

    if ($row == NULL) {

        $query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE $langArrayQuery required_views = 10 AND number_views < required_views AND NOT EXISTS(SELECT * FROM tweet_classifications tc WHERE tc.tweet_id = ct.id AND tc.user_id = $user_id) ORDER BY RAND() LIMIT 1";
        error_log($query);

        $result = query_boinc_db($query);

        $row = $result->fetch_assoc();


        if ($row == NULL) {
            $query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE $langArrayQuery number_views > 0 AND number_views < required_views AND NOT EXISTS(SELECT * FROM tweet_classifications tc WHERE tc.tweet_id = ct.id AND tc.user_id = $user_id) ORDER BY RAND() LIMIT 1";
            error_log($query);

            $result = query_boinc_db($query);

            $row = $result->fetch_assoc();


            if ($row == NULL) {
                echo "attempt to find tweet with number_views > 0 failed, trying with any number of views.\n";

                $query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE lang IN ( ".implode(',', $langArray).") AND number_views < required_views AND NOT EXISTS(SELECT * FROM tweet_classifications tc WHERE tc.tweet_id = ct.id AND tc.user_id = $user_id) ORDER BY RAND() LIMIT 1";
                error_log($query);

                $result = query_boinc_db($query);

                $row = $result->fetch_assoc();

                if ($row == NULL) {
                    echo "attempt to find tweet with any number of views failed, no unviewed tweets left for user.\n";
                }
            }
        }
    }

    return $row;
}


/*
$tweet = get_next_tweet(1);

if ($tweet == NULL) {
    echo "TWEET: NULL\n";
} else {
    echo "TWEET: id: " . $tweet['id'] . ", tweet_id: " . $tweet['tweet_id'] . ", text: '" . $tweet['text'] . "', lang: " . $tweet['lang'] . ", datetime: " . $tweet['datetime'] . "\n";
}
 */

?>
