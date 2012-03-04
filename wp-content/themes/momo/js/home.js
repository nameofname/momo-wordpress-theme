$(document).ready(function(){
    // For truncated content on the home page - When the user clicks the 
    // expand button, expand to the height of the content, 
    // Toggles back to the original height. 
    $('.entry-content').each(function(){
        var h = $(this).find('p').height(); 
        var h1 = $(this).height(); 
        $(this).data('height', h); 
        $(this).data('orig_height', h1); 
    });
    $('.entry-content').find('.expand, .collapse').on('click', function(){
        swap_height(this); 
    });
    function swap_height(elem){
        if($(elem).hasClass('expand')) {
            var h = $(elem).parent('.entry-content').data('height');
            $(elem).parent('.entry-content').animate({'height' : h}); 
            $(elem).removeClass('expand').addClass('collapse'); 
        } else {
            var h = $(elem).parent('.entry-content').data('orig_height');
            $(elem).parent('.entry-content').animate({'height' : h}); 
            $(elem).removeClass('collapse').addClass('expand'); 
        }
    }
    // Pop down the hidden comments form on the home page. 
    $('.comments_home_show_btn').each(function(key, val){
        $(this).attr('data-toggle', 0); 
    });
    $('.comments_home_show_btn').on('click', function(){
        if (parseInt($(this).attr('data-toggle')) % 2 == 0) {
            $(this).next('.comments_home_hide').find('.respond').slideDown(300); 
        } else {
            $(this).next('.comments_home_hide').find('.respond').slideUp(300); 
        }
        var num = $(this).attr('data-toggle'); 
        num ++; 
        $(this).attr('data-toggle', num); 
    });
});