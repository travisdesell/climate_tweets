<?php


function get_languages($user_id) {

    $languages_result = query_boinc_db("SELECT english, portuguese, spanish, german, russian, french FROM tweet_preferences WHERE user_id = $user_id");

    $row = $languages_result->fetch_assoc();
    $english = 0;
    $portuguese = 0;
    $spanish = 0;
    $german = 0;
    $russian = 0;
    $french = 0;

    if ($row != NULL) {
        $english = intval($row['english']);
        $portuguese = intval($row['portuguese']);
        $spanish = intval($row['spanish']);
        $german = intval($row['german']);
        $russian = intval($row['russian']);
        $french = intval($row['french']);
    }

    //make sure at least one is checked
    $sum = $english + $portuguese + $spanish + $german + $russian + $french;
    error_log($sum);
    $langArray = array();
    $x = 0;

<<<<<<< HEAD
    if($sum==0){
        $langArray[$x] = '\'en\'';
        $x = $x+1;
    }
=======
    /*if($sum==0){
        $langArray[$x] = '\'en\'';
        $x = $x+1;
    }*/
>>>>>>> 65fb80bb11c8639e97935315ea15990c10e9d9c4

    if ($english == 1) {
        $langArray[$x] = '\'en\'';
        $x = $x + 1;
    }
    if ($portuguese == 1) {
        $langArray[$x] = '\'pt\'';
        $x = $x + 1;
    }    
    if ($spanish == 1) {
        $langArray[$x] = '\'es\'';
        $x = $x + 1;

    }
    if ($german == 1) {
        $langArray[$x] = '\'de\'';
        $x = $x + 1;
    }

    if ($russian == 1) {
        $langArray[$x] = '\'ru\'';
        $x = $x + 1;
    }

    if ($french == 1) {
        $langArray[$x] = '\'fr\'';
        $x = $x + 1;
    }

    return $langArray;

}

?>
