<?php
#This program fetches the results of the tweet_classifications and prints them to the screen (can be pipped in command line to a new file)
//connect to database
$host = "localhost";
$database = "csg";
$user = "tdesell";
$password = "TDBoinc12";

mysql_connect($host, $user, $password) or die ("Unable to connect to database");

//select database
mysql_select_db($database) or die ("Unable to select database");

//get results from tweet_classfications
$query = "SELECT * from tweet_classifications";
$result = mysql_query($query) or die (mysql_error());

//put all data from table into php array
while($row = mysql_fetch_array($result)) {
	echo $row['id']. " - ". $row['user_id']. " - ". $row['tweet_id']. " - ". $row['insert_time']. " - ". $row['attitude']. " - ". $row['phenomenon_drivers']. " - ". $row['phenomenon_science']. " - " .$row['phenomenon_denial']. " - ". $row['impacts_extreme']. " - ". $row['impacts_weather']. " - ". $row['impacts_environment']. " - ". $row['impacts_society']. " - ". $row['adaptation_politics']. " - ". $row['adaptation_ethics']. " - ". $row['unknown'];
	echo "<br>";

};

?>
