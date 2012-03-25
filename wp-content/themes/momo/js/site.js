$(document).ready(function(){
    initCommentsInteractions(); 
    initToggleNavSearch(); 
    initNavExpand(); 

// End document.ready functions
});

// Toggle display of the hidden comment forms, and add other interactions
function initToggleNavSearch() {
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
}

// Toggle display of the hidden comments form.
function initCommentsInteractions() {
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

    /*$('.comment-form-comment textarea').blur(function(){
        $(this).animate({'height' : '40px'})
    }); */
}

// Collapse and expand sub categories in the main navigation. 
function initNavExpand() {
    $('.cat-item').each(function(key, val){
        if ($(this).children('.children').length > 0) {
            var expander = $('<div>').attr('class','nav_expander nav_collapsed').data('tognum' , 0); 
            $(this).find('a').first().after(expander); 
        }
    }); 
    $('.nav_expander').live('click', function(){
        $(this).next('.children').slideToggle(300); 
        if ($(this).data('tognum') % 2 == 0) {
            $(this).removeClass('nav_collapsed').addClass('nav_expanded');
        } else {
            $(this).removeClass('nav_expanded').addClass('nav_collapsed');
        }
        var num = $(this).data('tognum'); 
        num ++; 
        //$(this).data('tognum', num++); 
        $(this).data('tognum', num); 
    }); 
}
