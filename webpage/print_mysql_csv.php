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



/*echo"
<center>Climate Tweets Data</center>
<br>
<br>";

//while loop to print each row's data from array
$x = 0; while ($x < $num) {$field1_name=mysql_result($tweets, $x, "ID");
		$field2_name=mysql_result($tweets, $x, "USER_ID");
		$field3_name=mysql_result($tweets, $x, "TWEET_ID");
		$field4_name=mysql_result($tweets, $x, "INSERT_TIME");
		$field5_name=mysql_result($tweets, $x, "ATTITUDE");
		$field6_name=mysql_result($tweets, $x, "DRIVERS");
		$field7_name=mysql_result($tweets, $x, "SCIENCE");
		$field8_name=mysql_result($tweets, $x, "DENIAL");
		$field9_name=mysql_result($tweets, $x, "EXTREME");
		$field10_name=mysql_result($tweets, $x, "WEATHER");
		$field11_name=mysql_result($tweets, $x, "ENVIRONMENT");
		$field12_name=mysql_result($tweets, $x, "SOCIETY");
		$field13_name=mysql_result($tweets, $x, "POLITICS");
		$field14_name=mysql_result($tweets, $x, "ETHICS");
		$field15_name=mysql_result($tweets, $x, "UNKNOWN");

		echo"
		$field1_name 
		$field2_name
		$field3_name
		$field4_name
		$field5_name
		$field6_name
		$field7_name
		$field8_name
		$field9_name
		$field10_name
		$field11_name
		$field12_name
		$field13_name
		$field14_name
		$field15_name
		";
*/
?>
