<?php
//This script is called when the classify_tweets page first loads to verify whether or not the user has seen the profanity-warning. It is only shown once to each user
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$user = csg_get_user(false);
$user_id = $user['id'];

$query = "SELECT seen_modal FROM update_profanity WHERE user_id = $user_id";

$result = query_boinc_db($query);

$row = $result->fetch_assoc();
$seen_modal = $row['seen_modal'];

if($seen_modal == 1) {
    $pass = 1;        
}
else {
    $pass = 0;
}
echo ($pass);

?>
