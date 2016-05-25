$(document).ready(function () {

    $('#discuss-tweet-button:not(.click-bound)').addClass('click-bound').click(function() {
        var forum_post_content = "I would like to discuss the tweet: [quote]" + $("#tweet-well").text() +  "[/quote]\n\n";

        console.log("forum post: " + forum_post_content);
        $("#discuss-tweet-content").val( forum_post_content );
        $("#discuss-tweet-form").submit();
    });

});

