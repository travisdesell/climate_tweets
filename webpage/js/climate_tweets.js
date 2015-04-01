$(document).ready(function () {

	console.log("its working!");
    var number_checked = 0;
    var checked_boxes = [];

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


    //sets array for users desired tweet languages
    var languages = [];
    
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
    });

    
 
    //set radio box variable
    $('.checkbox').click(function() {
            if ($('checkbox'.checked)) {
                radio_checked = ($(this).attr("value"));
                console.log( $(this).attr("value") + " is checked");
            }

            $('#submit-button').removeClass('disabled');
    });

    //submit data to server
                
    $("#submit-button").click(function() {
        console.log("clicked the submit button!");

        $(this).addClass('disabled');

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
                for(var x=0; x<checked_boxes.length;x++) {
                    $("#" + checked_boxes[x]).attr('checked', false);
                }   
                    $("#radioID").attr('checked', false);
                    $("#radioID2").attr('checked',false);
                    $("#radioID3").attr('checked',false);
                    $("#radioID4").attr('checked',false);
                    $("#radioID5").attr('checked',false);
                    $("#radioID6").attr('checked',false);

            },
            
            error : function(jqXHR, textStatus, errorThrown) {
                console.log("there was an error: '" + errorThrown + "'");
            }
         });//ajax
/*
       var submit_data2 = {
                 user_id : $(this).attr('user_id'),
                language_preferences : languages 
            }); //data2

       console.log(submit_data2);

        $.ajax({
            type : 'POST',
            url : './submit_tweet_classifications.php',
            data : submit_data2,
            dataType: 'JSON'
            
            success : function(response2) {
                console.log("the second ajax call worked!");
                console.log("the response was: " + JSON.stringify(response));
            }, 

            error : function(jqXHR, textStatus, errorThrown) {
                console.log("there was an error: " + errorThrown + "'");
           }
         }); 
*/
      });//function
  
    $('#collapseOne').collapse('show');
    
    $('#instructions-button').click(function() {
        $('#collapseOne').collapse('hide');
    });
});
 
