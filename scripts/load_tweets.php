<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");

$filename = $argv[1];

echo "opening climate change tweets file: '$filename'\n";

$file = fopen($argv[1],"r");

$headers = fgetcsv($file);
print_r($headers);

$headers = array();
$headers[] = 'tweet_id';
$headers[] = 'text';
$headers[] = 'lang';
$headers[] = 'place';
$headers[] = 'date';
$headers[] = 'datetime';
$headers[] = 'rnd';
$headers[] = 'lang_N';
$headers[] = 'place_N';
$headers[] = 'select';
print_r($headers);


$line = 0;
$tweet = fgetcsv($file);
while (!feof($file)) {

    if (count($headers) != count($tweet)) {
        echo "error on tweet:\n";
        print_r($tweet);
        echo "Number of columns (" . count($tweet) . ") in tweet not equal to number of headers (" . count($headers) . "). Maybe an unescaped \\?\n";
        die();
    }

    $query = "INSERT INTO climate_tweets SET ";
    for ($i = 0; $i < count($headers); $i++) {
        if ($i == 4) continue;

        if ($i > 0) $query .= ", ";

        $query .= "`" . $headers[$i] . "`" . " = \"" . $boinc_db->real_escape_string($tweet[$i]) . "\"";
    }

    echo "$line: $query\n";
    query_boinc_db($query);

    $line++;
    $tweet = fgetcsv($file);
}

fclose($file);

?>

