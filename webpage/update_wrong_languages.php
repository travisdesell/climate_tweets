<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . '/../../citizen_science_grid/my_query.php');
require_once($cwd[__FILE__] . '/../../citizen_science_grid/user.php');
require_once($cwd[__FILE__] . '/get_languages.php');

$user = csg_get_user(false);
$user_id = $user['id'];

error_log("user with id: $user_id submitted an incorrect language tweet classification!");

$tweet_id = $boinc_db->real_escape_string($_POST['tweet_id']);
$lang = $boinc_db->real_escape_string($_POST['language']);

error_log("user with id: $user_id submitted an incorrect language classification!");

$wrong_lang_query = "insert into wrong_language set user_id = $user_id, tweet_id = $tweet_id, language = $lang";   

$result1 = query_boinc_db($wrong_lang_query);

$new_tweet_query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE lang IN ( ".implode(',', $langArray).") AND NOT EXISTS(SELECT * FROM tweet_classifications tc WHERE tc.tweet_id = ct.id AND tc.user_id != $user_id) ORDER BY RAND() LIMIT 1";

error_log($new_tweet_query);

$result2 = query_boinc_db($new_tweet_query);

//returns new tweet information
$row = $result->fetch_assoc();
$id = $row['id'];
$text = $row['text'];

$response['success'] = true;
$response['new_id' ] = $id;
$response['tweet_text'] = $text;

//returns data to js
echo json_encode($response);

echo $wrong_lang_query;

?>

