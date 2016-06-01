<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");

$results = query_boinc_db("SELECT text FROM climate_tweets where lang='en' and prof=0 order by rand() LIMIT 60"); 

echo $test;

?>
