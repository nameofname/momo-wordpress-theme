$(document).ready(function(){
    // Pop down the hidden comments form on the home page. 
    $('.comments_home_show_btn').each(function(key, val){
        $(this).attr('data-toggle', 0); 
    });
    $('.comments_home_show_btn').on('click', function(){
        if (parseInt($(this).attr('data-toggle')) % 2 == 0) {
            $(this).next('.comments_home_hide').slideDown(300); 
            $(this).text('-'); 
        } else {
            $(this).next('.comments_home_hide').slideUp(300); 
            $(this).text('+'); 
        }
        var num = $(this).attr('data-toggle'); 
        num ++; 
        $(this).attr('data-toggle', num); 
    });

    $('.nav_search').data('expanded', false); 
    $('.nav_search').on('click', function(){
        if ($(this).data('expanded') == false) {
            $('#access form').slideDown(500); 
            $(this).data('expanded', true); 
            $(this).text('Search-'); 
        } else {
            $('#access form').slideUp(500); 
            $(this).data('expanded', false); 
            $(this).text('Search+'); 
        }
    });

    $('.show-form-allowed').data('expanded', false); 
    $('.show-form-allowed').on('click', function(){
        if ($(this).data('expanded') == false) {
            $(this).next('.form-allowed-tags').slideDown(500); 
            $(this).text('about comments -'); 
            $(this).data('expanded', true); 
        } else {
            $(this).next('.form-allowed-tags').slideUp(500); 
            $(this).text('about comments +'); 
            $(this).data('expanded', false); 
        }
    });

    $('.comment-form-comment textarea').focus(function(){
        $(this).animate({'height' : '120px'})
    }); 

    $('.comment-form-comment textarea').blur(function(){
        $(this).animate({'height' : '40px'})
    }); 

// End document.ready functions
});
