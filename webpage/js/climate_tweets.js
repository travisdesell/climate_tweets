$(document).ready(function () {
    //sets array for users desired tweet languages
    var languages = [];
  
       //check if user accepts warning modal. If they have already seen it, modal will be disactivated
    $("#button1").click(function() {
        console.log("User will continue to the website");
        
    });

    $("#button2").click(function() {
        console.log("Redirect to previous page");
        window.history.back(-1);
        });


    $('#warning-modal').modal('show');
 
    //upon click, code recorded so the user has seen the warning
    $('#warning-modal').click(function() {
        $('#warning-modal').collapse('hide');
        var warning = true;
    });    
    
    //when the document is loaded, this will
    //initialize the languages array to preselected user preferences
    $(".lang-checkbox").each(function() {
        if ($(this).prop('checked')) { 
            console.log($(this).attr("id") + " is checked!");
            languages.push($(this).attr("id"));
        } else {
            console.log( $(this).attr("id") + " is not checked");
            for (var y=0; y<languages.length; y++) {
                if (languages[y] == $(this).attr("id")) {
                    languages.splice(y,1);
                }
            }   
        }
        console.log(languages);  
    });


    $(".lang-checkbox").click(function() {
         if ($(this).prop('checked')) { 
             console.log($(this).attr("id") + " is checked!");
             languages.push($(this).attr("id"));
         }
         else{
            console.log( $(this).attr("id") + " is not checked");
            for(var y=0; y<languages.length; y++) {
                if (languages[y] == $(this).attr("id")) {
                    languages.splice(y,1);
                }
            }   
        }
        console.log(languages);  

        $.ajax({
            type : 'POST',
            url : './update_language_preferences.php',
            data : { languages : languages },
            dataType : 'text',
           
            success : function(response) {
                console.log("the ajax call worked!");
                console.log("the response was: " + JSON.stringify(response));   
            },
            
            error : function(jqXHR, textStatus, errorThrown) {
                console.log("there was an error: '" + errorThrown + "'");
            }
         });//ajax

    });


	console.log("its working!");
    var number_checked = 0;
    var checked_boxes = [];

    //if user has not selected an attitude, cannot submit tweet classification
    $("#submit-button").addClass('disabled');

    $(".classify-checkbox").click(function() {
        if ($(this).prop('checked')) {
            //when a box is checked, increment the number checked
            number_checked++;
            console.log( $(this).attr("name") + " is checked! total_checked: " + number_checked );
            //also add it's id to the array of checked boxes
            checked_boxes.push($(this).attr("id"));

            console.log( checked_boxes );

            if (number_checked > 3) {
                console.log("unchecking: #" + checked_boxes[0]);
                //this will uncheck the checkbox with the first id in the checked boxes array
                $("#" + checked_boxes[0]).attr('checked', false);
                //this removes the first id from the checked boxes array
                checked_boxes.splice(0, 1);
                console.log( checked_boxes );
                number_checked--;
            }
        } else {
          //remove the id of the unchecked checkbox from the checked_boxes array
            number_checked--;
            console.log( $(this).attr("name") + " is not checked! total_checked: " + number_checked );
            $("#" + checked_boxes[0]).attr('checked', false);
            checked_boxes.splice(0,1);
            number_checked--;
        }
    });

   //set radio box variable
    $('.attitude-radio').click(function() {
        if ($('.attitude-radio'.checked)) {
            radio_checked = ($(this).attr("value"));
            console.log( $(this).attr("value") + " is checked");
            }

            $('#submit-button').removeClass('disabled');
    });

    //submit data to server
                
    $("#submit-button").click(function() {
        console.log("clicked the submit button!");

        $(this).addClass('disabled');

        //making an object on the go
        var submit_data = {
                    tweet_id : $(this).attr('tweet_id'),
                    attitude : radio_checked,
                    checked_boxes : checked_boxes
                };//data

        console.log(submit_data);

        var submit_button = $(this);

        $.ajax({
            type : 'POST',
            url : './submit_tweet_classifications.php',
            data : submit_data,
            dataType : 'JSON',
           
            success : function(response) {
                console.log("the ajax call worked!");
                console.log("the response was: " + JSON.stringify(response));   

                submit_button.attr('tweet_id', response['new_id']);
                $("#tweet-well").text( response['tweet_text'] );
                $(this).removeClass('disabled');
               
                //unchecks boxes when ajax call is successful and pulls another tweet to classify
             
                checked_boxes = [];
                number_checked = 0;
                $(".classify-checkbox").attr('checked',false);
                $(".attitude-radio").attr('checked',false);     
                
                $('#test').modal('hide');
            },
            
            error : function(jqXHR, textStatus, errorThrown) {
                console.log("there was an error: '" + errorThrown + "'");
            }
         });//ajax
      });//function
  
    $('#modal').collapse('show');
    
    $('#instructions-button').click(function() {
        $('#modal').collapse('hide');
    });
});
 
