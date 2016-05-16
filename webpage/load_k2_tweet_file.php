<?php
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$data = $_POST["source1"];
$array = explode(",", $data);
$file = fopen("docs/tweets.txt", "w");
//check if incoming data is iterable
if(is_array($data)) {
	foreach($data as &$d) {
		echo fwrite($file, "hi");
	}
}
fclose($file);

?>
