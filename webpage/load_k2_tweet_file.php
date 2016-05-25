<?php
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$data = $_POST["source1"];
$array = explode(",", $data);
$file = fopen($cwd[__FILE__] . "/docs/tweets.txt", "w") or die("Unable to open file!");

//check if incoming data is iterable
$arrlength = count($array);
for($x=0; $x<$arrlength; $x++) {
	fwrite($file, $array[$x]);
	fwrite($file, "\n");
}
fclose($file);

?>
