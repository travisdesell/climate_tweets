<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . '/../../citizen_science_grid/my_query.php');
require_once($cwd[__FILE__] . '/../../citizen_science_grid/user.php');

$user = csg_get_user(false);
$user_id = $user['id'];

error_log("user with id: $user_id update user preferences");

$languages = $_POST['languages'];

//set language preferences to pass
$english = 0;
$portuguese = 0;
$spanish = 0;
$german = 0;
$russian = 0;
$french = 0;

foreach ($languages as $lang) {
    error_log("selected languages: '$lang'");
    if ($lang == 'english') {
        $english = 1;
    } else if ($lang == 'portuguese') {
        $portuguese = 1;
    } else if ($lang == 'spanish') {
        $spanish = 1;
    } else if ($lang == 'german') {
        $german = 1;
    } else if ($lang == 'russian') {
        $russian = 1;
    } else if ($lang ==  'french') {
        $french = 1;
    }
}

$query = "REPLACE INTO tweet_preferences SET user_id = $user_id, english = $english, portuguese = $portuguese, spanish = $spanish, german = $german, russian = $russian, french = $french"; 
query_boinc_db($query);

error_log($query);

?>

