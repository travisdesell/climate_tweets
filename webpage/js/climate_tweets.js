$(document).ready(function() {
    //sets array for users desired tweet languages
    var languages = [];

    //first ajax call gets whether user has seen modal or not 
     $.ajax({
         type : 'POST',
         url : './get_profanity.php',
         dataType : 'text',
       
         success : function(result) {
            console.log("the profanity ajax call worked!");
            console.log("the php script returned: '" + result + "'");
            
            if(result == 1){
                $('#warning-modal').modal('hide');
            }
            else {
                $('#warning-modal').modal('show');
            }

         },
        
        error : function(jqXHR, textStatus, errorThrown) {
            console.log("there was an error during the get_profanity ajax call: '" + errorThrown + "'");
        }
    });

    //check if user accepts warning modal.
    $("#button1").click(function() {
        console.log("User will continue to the website");
       
       //second ajax call: once the user has accepted profanity warning it is recorded in the table so they will not see it again 
        $.ajax({
            type : 'POST',
            url : './update_profanity.php',
            dataType : 'text',
      
            success : function(query) {
                console.log("the profanity ajax call worked!");
                console.log("query is: "+JSON.stringify(query));
                },
        
            error : function(jqXHR, textStatus, errorThrown) {
                console.log("there was an error during the update_profanity ajax call: '" + errorThrown + "'");
           }
       });      
    });

    $("#button2").click(function() {
        console.log("Redirect to previous page");
        window.history.back(-1);
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

    //selects languages when clicked or unclicked
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

    //sends languages to table in database to be stored for future user preferences
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
    var radio_checked = null;
    var checked_boxes = [];

    //if user has not selected an attitude, cannot submit tweet classification
    $("#submit-button").addClass('disabled');
    
    //records classified checkboxes in array
    $(".classify-checkbox").click(function() {
        if ($(this).prop('checked')) {
            //when a box is checked, increment the number checked
            number_checked++;
            console.log( $(this).attr("id") + " is checked! total_checked: " + number_checked );
            //also add it's id to the array of checked boxes
            checked_boxes.push($(this).attr("id"));

            console.log( checked_boxes );

            //max of 3
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
            console.log( $(this).attr("id") + " is not checked! total_checked: " + number_checked );
            
            var unchecked_id = $(this).attr("id");
            for (var i = 0; i < checked_boxes.length; i++) {

                if (checked_boxes[i] === unchecked_id) {
                    console.log("unchecking: #" + checked_boxes[i]);
                    $("#" + checked_boxes[i]).attr('checked', false);
                    checked_boxes.splice(i,1);
                    break;
                }
            }

            number_checked--;
            console.log( checked_boxes );
        }

        console.log(radio_checked);
        if (number_checked > 0 && radio_checked) {
            $('#submit-button').removeClass('disabled');
        } else {
            $('#submit-button').addClass('disabled');
        }
    });

  //open and close instructions button 
   $('#instructions-button').click(function() {
       $('#modal').collapse('hide');
   });


   //set radio box variable
    $('.attitude-radio').click(function() {
        if ($('.attitude-radio'.checked)) {
            radio_checked = ($(this).attr("value"));
            console.log( $(this).attr("value") + " is checked");

            if (number_checked > 0) {
                $('#submit-button').removeClass('disabled');
            }
        }
    });

   //submit data to server      
    $("#submit-button").click(function() {
        console.log("clicked the submit button!");
    
        //alert is shown and disappears after submit button selected
        $('#tweet-alert').removeClass('hide-me');
 	    window.setTimeout(function() {$('.alert').addClass('hide-me'); }, 1500);
	   
        $(this).addClass('disabled');
       
        //making an object on the go
        var submit_data = {
                    tweet_id : $(this).attr('tweet_id'),
                    attitude : radio_checked,
                    checked_boxes : checked_boxes
        	};//data

        console.log(submit_data);
        var submit_button = $(this);

//ajax call for tweet submissions
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
	    },
            
            error : function(jqXHR, textStatus, errorThrown) {
                console.log("there was an error: '" + errorThrown + "'");
            }
         });//ajax
      });//function
    //$('#tweet-alert').addClass('hidden');  
    
});
 
