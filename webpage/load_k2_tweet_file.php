<?php
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$data = $_POST['selected'];
$file = fopen("/docs/tweets.txt", "w");
fwrite("TESTING LLLLLLLL");
foreach($data as $d) 
	echo fwrite($file, "hi");
fclose($file);

?>
