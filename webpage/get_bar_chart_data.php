<?php
//this page retrieves the bar chart data from the main database.
$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");

$user = csg_get_user(false);
$user_id = $user['id'];

//index for array and array for answers
$c = 0;
$classifications = array();

//get drivers numbers
//
$query = "SELECT phenomenon_drivers from tweet_classifications WHERE phenomenon_drivers = 1";
$results = query_boinc_db($query);
//add each classification where = 1 to array
while($class[] = mysqli_fetch_assoc($results));
array_pop($class);
//get num of specific classification
$num = count($class);
$classifications[$c] = $num;
$c = $c+1;
 

//get science numbers
//
$query1 = "SELECT phenomenon_science from tweet_classifications WHERE phenomenon_science = 1";
$results1 = query_boinc_db($query1);
//add each classification where = 1 to array
while($class1[] = mysqli_fetch_assoc($results1));
array_pop($class1);
//get number of that classifications and add to array total
$num1 = count($class1);
$classifications[$c] = $num1;
$c = $c+1;
 

//get denial numbers
//
$query2 = "SELECT phenomenon_denial from tweet_classifications WHERE phenomenon_denial = 1";
$results2 = query_boinc_db($query2);
//add each classification where = 1 to array
while($class2[] = mysqli_fetch_assoc($results2));
array_pop($class2);
//get number of that classifications and add to array total
$num2 = count($class2);
$classifications[$c] = $num2;
$c = $c+1;
 

//get impact_extreme numbers
//
$query3 = "SELECT impacts_extreme from tweet_classifications WHERE impacts_extreme = 1";
$results3 = query_boinc_db($query3);
//add each classification where = 1 to array
while($class3[] = mysqli_fetch_assoc($results3));
array_pop($class3);
//get number of that classifications and add to array total
$num3 = count($class3);
$classifications[$c] = $num3;
 
$c = $c + 1;
//get impact_weather numbers
//
$query4 = "SELECT impacts_weather from tweet_classifications WHERE impacts_weather = 1";
$results4 = query_boinc_db($query4);
//add each classification where = 1 to array
while($class4[] = mysqli_fetch_assoc($results4));
array_pop($class4);
//get number of that classifications and add to array total
$num4 = count($class4);
$classifications[$c] = $num4;
$c = $c+1;
 

//get impact_environment numbers
//
$query5 = "SELECT impacts_environment from tweet_classifications WHERE impacts_environment = 1";
$results5 = query_boinc_db($query5);
//add each classification where = 1 to array
while($class5[] = mysqli_fetch_assoc($results5));
array_pop($class5);
//get number of that classifications and add to array total
$num5 = count($class5);
$classifications[$c] = $num5;
$c = $c+1;


//get impact_society numbers
//
$query6 = "SELECT impacts_society from tweet_classifications WHERE impacts_society = 1";
$results6 = query_boinc_db($query6);
//add each classification where = 1 to array
while($class6[] = mysqli_fetch_assoc($results6));
array_pop($class6);
//get number of that classifications and add to array total
$num6 = count($class6);
$classifications[$c] = $num6;
$c = $c+1;


//get adaptation_politics numbers
//
$query7 = "SELECT adaptation_politics from tweet_classifications WHERE adaptation_politics = 1";
$results7 = query_boinc_db($query7);
//add each classification where = 1 to array
while($class7[] = mysqli_fetch_assoc($results7));
array_pop($class7);
//get number of that classifications and add to array total
$num7 = count($class7);
$classifications[$c] = $num7;
$c = $c+1;


//get adaptation_ethics numbers
//
$query8 = "SELECT adaptation_ethics from tweet_classifications WHERE adaptation_ethics = 1";
$results8 = query_boinc_db($query8);
//add each classification where = 1 to array
while($class8[] = mysqli_fetch_assoc($results8));
array_pop($class8);
//get number of that classifications and add to array total
$num8 = count($class8);
$classifications[$c] = $num8;
$c = $c+1;
 

//get unknown
//
$query9 = "SELECT unknown from tweet_classifications WHERE unknown = 1";
$results9 = query_boinc_db($query9);
//add each classification where = 1 to array
while($class9[] = mysqli_fetch_assoc($results9));
array_pop($class9);
//get number of that classifications and add to array total
$num9 = count($class9);
$classifications[$c] = $num9;
$c = $c+1;

//print_r($classifications); 

echo json_encode($classifications);
