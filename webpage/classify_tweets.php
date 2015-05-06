<?php

$cwd[__FILE__] = __FILE__;
if (is_link($cwd[__FILE__])) $cwd[__FILE__] = readlink($cwd[__FILE__]);
$cwd[__FILE__] = dirname($cwd[__FILE__]);

require_once($cwd[__FILE__] . "/../../citizen_science_grid/header.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/navbar.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/footer.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/my_query.php");
require_once($cwd[__FILE__] . "/../../citizen_science_grid/user.php");
require_once($cwd[__FILE__] . "/get_languages.php");

$user = csg_get_user();
$user_id = $user['id'];

$css_header = "<link rel='stylesheet' type = 'text/css' href = 'css/style.css' />";

print_header("Classifying Climate Tweets", "$css_header <script type='text/javascript' src='js/climate_tweets.js'></script>", "dna");
print_navbar("Projects: Climate Tweets", "Climate Tweets", "..");

echo"
<div class='modal fade' id = 'warning-modal'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-body'>
                <p>Some tweets included in the Climate Tweets project contain profanity. <p>
            </div>
            <div class='modal-footer'>
                <button type='button' id = 'button1' class='btn btn-primary' data-dismiss='modal'>Continue</button>
                <button type='button' id = 'button2' class='btn btn-primary'>Go Back</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->";

echo"<http://pietervanklinken.nl/wp-content/uploads/2010/10/twitter-creative-commons-2.jpg>";

$langArray = get_languages($user_id);
$langArrayResult = implode(',',$langArray);

$langArrayQuery = '';
if ($langArrayResult != '') {
    $langArrayQuery = "lang IN ($langArrayResult) AND ";
}

//error_log("langArray: '" . implode(',',$langArray) . "'");

//query for tweets only within languages selected
$query = "SELECT id, tweet_id, text, lang, datetime FROM climate_tweets ct WHERE $langArrayQuery NOT EXISTS (select * FROM tweet_classifications tc where tc.tweet_id = ct.id and tc.user_id != $user_id) order by rand() limit 1";

$result = query_boinc_db($query);
$row = $result->fetch_assoc();
$id = $row['id'];

if(count($langArray) == 0){
    $text = 'Please enter your language preferences below';
}
else {
    $text = $row['text'];
}

//$text = $row['text'];
$lang = $row['lang'];
$datetime = $row['datetime'];


/*css
echo "<style>
        .jumbotron{border: double #8DCDC1 8px; background-color: rgba(13, 205, 193, 0.05)}
        .well{border: double #D3E397 8px; background-color: rgba(211, 227, 151, 0.1)}
        .panel{border: #000000}
        .modal-content{border: double #FFFFCC 8px; background-color: rgba(255, 255, 204)}      
        </style>";
 */

//modal for instructions

echo "
    <div class='container'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class = 'jumbotron'>";
//echo "<html><head><body> <img src = 'http://www.steamfeed.com/wp-content/uploads/2013/07/twitter-bird.jpg' />  </body></head></html>";
echo "<h1 align='center'>Help us classify the tweets!</h1>";
echo "
    <!-- Button trigger modal -->
    <div class = 'span6' style = 'text-align:center'>
    <button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>
      Instructions
    </button>

    <!-- Modal -->
    <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <div class='modal-body' style = 'text-align: left'>
          <font size = '4'><b>Classifications</b><br></font>
          <i>Note: If the tweet does not fit any category select the 'Unknown' attitude and submit</i><br>
          <br>
                <b>Attitudes</b><br>
                -2: Extremely negative, denial or skepticism of Climate Change.<br>
                -1: Negative, denial of Climate Change.<br>
                0: Neutral.<br>
                1. Positive, supports Climate Change.<br>
                2. Extremely positive, supports Climate Change.<br>
                <br>
                <b>Categories</b><br>
                <i>Global Warming Phenomenon</i><br>
                1. Drivers of Climate Change, such as greenhouse gases.<br>
                2. Mentions science or data collected by scientists or scientific groups.<br>
                3. Denial, skepticism, or theories, such as scientists lying to the public.<br>
                <br>
                <i>Impacts of Climate Change</i><br>
                4. Mentions extreme weather events, such as hurricanes or tornados.<br>
                5. Mentions unusual weather, such as heavy snowfall or extreme temperatures.<br>
                6. Mentions the environment, such as deforestation, wildfires, acid rain, etc.<br>
                7. Mentions society or economics, such as how agriculture is threatened, property loss, sea rising will threaten small nations, etc.<br>
                <br>
                <i>Adaptation and Migration</i><br>
                8. Mentions politics, such as elections and taxes.<br>
                9. Mentions ethics or moral responsibility, such as our need to fight global warming.<br>
                <br>
                <i>Unknown category</i><br>
                10. Jokes, irrelevant, or hard to classify<br>
          </div>
            <button type='button' class='btn btn-primary  center-block' data-dismiss='modal'>Close</button>
            <br>   
         </div>
      </div>
    </div>
  </div>
";


echo "<br>";
echo "</div><!--jumbo-->";

echo "<div class='row row-centered'>";
echo "<div class='col-sm-12'>";
echo "<div class='well' id='tweet-well'>";

echo "'$text'<br>";
//echo "<br>";
//echo "Tweet ID: '$id'<br>";
//echo "Language: '$lang'<br>";
//echo "Tweeted on: '$datetime'<br>";

echo "</div>";
echo "</div>";

//section for checkboxes - classify tweets by categories

echo "<div class='col-sm-6'>";
echo "<div class='well well-sm'>";
echo "<h3>Categories</h3>";
echo "<b>Phenomenon:</b><br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='phenomenon-drivers' value='0'> Drivers</input><br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='phenomenon-science' value='0'> Science</input> <br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='phenomenon-denial' value='0'> Denial</input> <br>";
echo "<b>Impacts:</b><br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-extreme' value='0'> Extreme</input> <br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-weather' value='0'> Weather</input> <br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-environment' value='0'> Environment</input> <br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='impacts-society' value='0'> Society</input> <br>";
echo "<b>Adaptation:</b><br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='adaptation-politics' value='0'> Politics</input> <br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='adaptation-ethics' value='0'> Ethics</input> <br>";
echo "<b>Other:</b><br>";
echo "&nbsp;&nbsp;&nbsp;<input type='checkbox' class='classify-checkbox' id='unknown' value='0'> Unknown</input> <br>";
echo "<i><font size ='1'>You may choose up to three applicable categories</font></i><br>";
echo "<br>";
echo "</div>";//well
echo "</span>";
echo "</div>";//column 

//section for radio buttons - classify tweets by attitude
echo "<div class ='col-sm-6'>";
echo "<div class = 'well well-sm'>";


echo "<p><h3>Attitudes</h3></p>";
echo "<form role='form'>
      <div class = 'radio'>
       <label> <input type='radio' class = 'attitude-radio' id = 'radioID' name='optradio' value ='-2' >-2: Extremely Negative </label></div>
       <div class = 'radio'>
       <label> <input type='radio' class= 'attitude-radio' id = 'radioID2' name='optradio' value ='-1'>-1: Negative</label></div>
       <div class = 'radio'>
    <label><input type='radio' class = 'attitude-radio' id = 'radioID3' name='optradio' value= '0'>0: Neutral</label></div>
    <div class = 'radio'>
    <label><input type = 'radio' class= 'attitude-radio' id = 'radioID4' name = 'optradio' value ='1'>1: Positive </label></div>
    <div class = 'radio'>
    <label> <input type = 'radio' class = 'attitude-radio' id = 'radioID5' name = 'optradio' value ='2'>2: Extremely Positive </labe></div>
    <div class = 'radio'>
    <label><input type = 'radio' class = 'attitude-radio' id = 'radioID6' name = 'optradio' value = 'Unknown'>Unknown</label></div>
    </form>";
echo "</div><!-- well -->";
echo "</div><!--column-->";
echo "</div><!--row-->";

//submit button
echo"<div class = 'col-sm-12'>";
echo "<button type ='button' class='btn btn-primary center-block' data-toggle='modal' id='submit-button' tweet_id='$id' data-target='.conf-modal'>Submit the classification!</button>";
echo "<font size = '1'><center>An attitude is needed to submit the tweet</font>";
echo "</div><!--col-->";


//section for languages
echo"<div class ='col-sm-12'>
    <div class = 'panel panel-default'>
    <div class = 'panel-body'>";

echo "<br><i><font color = 'hex_number-666666'><font size = '2'>Please select the language(s) of the tweets presented:  </font></font> </i>";

error_log( json_encode($langArray) );

foreach ($langArray as $lang) {
    if ($lang == "'en'") $english = 1;
    if ($lang == "'es'") $spanish = 1;
    if ($lang == "'pt'") $portuguese = 1;
    if ($lang == "'de'") $german = 1;
    if ($lang == "'fr'") $french = 1;
    if ($lang == "'ru'") $russian = 1;
}

if ($english) {
    echo "<input type='checkbox' class='lang-checkbox' id='english' value='1' checked> English  </input>";
} else {
    echo "<input type='checkbox' class='lang-checkbox' id='english' value='0'> English  </input>";
}

if ($portuguese) {
    echo "<input type='checkbox' class='lang-checkbox' id='portuguese' value='1' checked> Portuguese  </input>";
} else {
    echo "<input type='checkbox' class='lang-checkbox' id='portuguese' value='0'> Portuguese  </input>";
}

if ($spanish) {
    echo "<input type='checkbox' class='lang-checkbox' id='spanish' value='1' checked> Spanish  </input>";
} else {
    echo "<input type='checkbox' class='lang-checkbox' id='spanish' value='0'> Spanish  </input>";
}

if ($german) {
    echo "<input type='checkbox' class='lang-checkbox' id='german' value='1' checked> German  </input>";
} else {
    echo "<input type='checkbox' class='lang-checkbox' id='german' value='0'> German  </input>";
}

if ($russian) {
    echo "<input type='checkbox' class='lang-checkbox' id='russian' value='1' checked> Russian  </input>";
} else {
    echo "<input type='checkbox' class='lang-checkbox' id='russian' value='0'> Russian  </input>";
}

if ($french) {
    echo "<input type='checkbox' class='lang-checkbox' id='french' value='1' checked> French  </input>";
} else {
    echo "<input type='checkbox' class='lang-checkbox' id='french' value='0'> French  </input>";
}


echo"</div></div>";//col12 & well

//modal response to submission
echo " 
<!-- Small modal -->
        <div class='modal fade conf-modal' tabindex='1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                   <center><font size = '5'>Your tweet has now been classified.</font><br>Thanks for your help!</center>
                </div>
            </div>
        </div>";

echo"<http://pietervanklinken.nl/wp-content/uploads/2010/10/twitter-creative-commons-2.jpg>";

echo"
    </div><!--well-->
            </div> <!-- col-sm-6 -->
            </div> <!-- row -->
            </div> <!-- /container -->";
 

print_footer('Travis Desell and the Climate Tweets Team', 'Aaron Bergstrom, Travis Desell, Lindsey Wingate, and Andrei Kirilenko');

echo "</body></html>";

?>
