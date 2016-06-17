<?php
//This script sends a 1 to the database, updating it so they user will not see the profanity modal more than once
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$user = csg_get_user(false);
$user_id = $user['id'];  
$seen_modal = 1;

$query = "INSERT INTO update_profanity SET user_id = $user_id, seen_modal = $seen_modal";   

query_boinc_db($query);

echo $query;

?>
