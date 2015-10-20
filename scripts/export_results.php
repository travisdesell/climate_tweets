<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . '/../../citizen_science_grid/my_query.php');
require_once($cwd[__FILE__] . '/../../citizen_science_grid/user.php');



//The 'order by' command sorts the results by climate_tweets.id, this will make it easier to show
//multiple tweet classifications for the same tweet
$query = "SELECT climate_tweets.*, tweet_classifications.* FROM climate_tweets, tweet_classifications WHERE climate_tweets.id = tweet_classifications.id ORDER BY climate_tweets.id";

error_log($query);

$result = query_boinc_db($query);


//this will print out the headers of each column separated by commas so the columns
//in the CSV file will have names
for($i = 0; $i < $result->field_count; $i++) {
    $field_info = $result->fetch_field_direct($i);

    if ($i > 0) echo ", "; //put commas between each column header

    //the first 13 headers are from the climate_tweets table, if more columns are added this
    //will need to be changed
    if ($i < 13) {
        echo "climate_tweets.";
    } else {
        echo "tweet_classifications.";
    }

    echo $field_info->name;
}
echo "\n";



while (($row = $result->fetch_array()) != NULL) { //keep getting more rows until there are no more

    for($i = 0; $i < $result->field_count; $i++) {
        $field_info = $result->fetch_field_direct($i);

        if ($i > 0) echo ", "; //put commas between each column value 


        if ($field_info->type == 253) { //this field is a VARCHAR so we need to print it differently
            //real excape string will put \ before characters like " so it doesn't break the CSV file.
            //The problem is that since the string needs to be wrapped in quotes so that commas don't
            //make the CSV file think there are more columns than there should be, if there are "
            //characters in the tweet anything reading the CSV file will think the string prematurely
            //ended.
            echo "\"" . $boinc_db->real_escape_string($row[$i]) . "\"";
        } else {
            echo $row[$i];
        }
    }
    echo "\n";

}

?>

