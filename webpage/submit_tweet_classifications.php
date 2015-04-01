<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . '/../../citizen_science_grid/my_query.php');
require_once($cwd[__FILE__] . '/../../citizen_science_grid/user.php');

$user = csg_get_user(false);
$user_id = $user['id'];

error_log("user with id: $user_id submitted tweet classifications!");

$tweet_id = mysql_real_escape_string($_POST['tweet_id']);
$attitude = mysql_real_escape_string($_POST['attitude']);
//$user_id = mysql_real_escape_string($_POST['user_id']);

$checked_boxes = $_POST['checked_boxes'];
$fixed_checked_boxes = array();

$phen_science = 0;
$phen_drivers = 0;
$phen_denial = 0;
$imp_extreme = 0;
$imp_weather = 0;
$imp_environment = 0;
$imp_society = 0;
$adapt_politics = 0;
$adapt_ethics = 0;
$unknown = 0;

foreach ($checked_boxes as $checked_box) {
    error_log("checked box was: '$checked_box'");

    if ($checked_box == 'phenomenon-drivers') {
        $phen_drivers = 1;
    } else if ($checked_box == 'phenomenon-science') {
        $phen_science = 1;
    } else if ($checked_box == 'phenomenon-denial') {
        $phen_denial = 1;
    } else if ($checked_box == 'impacts-weather') {
        $imp_weather = 1;
    } else if ($checked_box == 'impacts-environment') {
        $imp_environment = 1;
    } else if ($checked_box == 'impacts-society') {
        $imp_society= 1;
    } else if ($checked_box == 'impacts-extreme') {
        $imp_extreme = 1;
    } else if ($checked_box == 'adaptation-politics') {
        $adapt_politics = 1;
    } else if ($checked_box == 'adaptation-ethics') {
        $adapt_ethics = 1;
    } else if ($checked_box == 'unknown') {
        $unknown = 1;
    }
}
/*
set language preferences to pass
$english = 0;
$portuguese = 0;
$spanish = 0;
$german = 0;
$russian = 0;
$french = 0;

foreach ($languages as $lang) {
    error_log("checked box was: '$lang'");
    if ($lang == 'english') {
        $english = 1;
    } else if ($lang = 'portuguese') {
        $portuguese = 1;
    } else if ($lang = 'spanish') {
        $spanish = 1;
    } else if ($lang = 'german') {
        $german = 1;
    } else if ($lang = 'russian') {
        $russian = 1;
    } else if ($lang = 'french') {
        $french = 1;
    }
}

$query = "INSERT INTO tweet_preferences SET user_id = $user_id, english = $english, portuguese = $portuguese, spanish = $spanish, german = $german, russian = $russian, french = $french"; 
 */
$query = "INSERT INTO tweet_classifications SET user_id = $user_id, tweet_id = $tweet_id, insert_time = now(), attitude = $attitude, phenomenon_science = $phen_science, phenomenon_drivers = $phen_drivers, phenomenon_denial = $phen_denial, impacts_extreme = $imp_extreme, impacts_weather = $imp_weather, impacts_environment = $imp_environment, impacts_society = $imp_society, adaptation_politics = $adapt_politics, adaptation_ethics = $adapt_ethics, unknown = $unknown";

query_boinc_db($query);

error_log($query);

$result = query_boinc_db("SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE NOT EXISTS(SELECT * FROM tweet_classifications tc WHERE tc.tweet_id = ct.id AND tc.user_id != $user_id) ORDER BY RAND() LIMIT 1");
$row = $result->fetch_assoc();
$id = $row['id'];
$text = $row['text'];

$response['success'] = true;
$response['new_id' ] = $id;
$response['tweet_text'] = $text;

echo json_encode($response);



?>

