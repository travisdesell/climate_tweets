<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");

$results = query_boinc_db("SELECT text FROM climate_tweets where lang='en' and prof=0 order by rand() LIMIT 20"); 

$pass_me = array();

for($x=0;$x<20; $x++) {
	$row = $results->fetch_assoc();
	echo $row["text"];
	echo "****";
	array_push($pass_me, $row["text"]);
}

//print_r($pass_me);

//echo json_encode($pass_me);
//
//echo json_encode($row["text"]);
?>
