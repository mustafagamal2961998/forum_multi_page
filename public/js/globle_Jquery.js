// START GLOBLE JQUERY CODE
$(document).ready(function() {
    var timeFormat = $('.last-topic-date-time').data('title');
    $('.last-topic-date-time').append(moment(timeFormat).format('h:mm A'));
});

$(document).ready(function() {

    $('.title-icon').click(function (){
        var $test = $('.topics-content[data-id='+$(this).attr("data-id")+']').toggle();

    });
    $('.last-member-title-text i').click(function (){
       $('.last-member').toggle();
    });

    $('.last-topic-title-text i').click(function (){
        $('.last-topics-content-list-items').toggle();
    });


    $('.forum-analysis-title-text i').click(function (){
        $('.forum-analysis').toggle();
    });

});


// END GLOBLE JQUERY CODE
