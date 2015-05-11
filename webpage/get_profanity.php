<? php

$csd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . '/../../citizen_science_grid/my_query.php');
require_once($cwd[__FILE__] . '/../../citizen_science_grid/user.php');

$user = csg_get_user(false);
$user_ud = $user['id'];

query_boinc_db($query);

$query = "SELECT seen_modal from update_profanity WHERE user_id = $user_id";

echo json_encode($query);

?>
