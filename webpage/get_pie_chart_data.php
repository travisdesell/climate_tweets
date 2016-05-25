<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$user = csg_get_user(false);
$user_id = $user['id'];

$att = -2;

$newArray = array();

for ($count = 0; $count < 5; $count++)
{
	$query = "SELECT attitude from tweet_classifications WHERE attitude = $att";
	$results = query_boinc_db($query);

	while($attitude[] = mysqli_fetch_assoc($results));
	array_pop($attitude);
	//print_r($attitude);

	$num = count($attitude);
	//echo " $num /";
	
	$newArray[$att] = $num;
	$att = $att + 1;
	
	//echo "$num";

}

//print_r($newArray);
echo json_encode($newArray);

?>
