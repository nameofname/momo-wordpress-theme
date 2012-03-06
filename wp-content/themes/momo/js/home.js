$(document).ready(function(){
    // For truncated content on the home page - When the user clicks the 
    // expand button, expand to the height of the content, 
    // Toggles back to the original height. 
    $('.entry-content').each(function(key, val){
        var h = $(this).height(); 
        //var h1 = $(this).height(); 
        //$(this).data('height', h); 
        //$(this).data('orig_height', h1); 
        $(this).data('height', h); 
        $(this).data('orig_height', '92px'); 
        $(this).css('height', '92px'); 
        if (h <= 92){
            $(this).find('.expand').remove(); 
        }
    });
    $('.entry-content').find('.expand, .collapse').on('click', function(){
        swap_height(this); 
    });
    function swap_height(elem){
        if($(elem).hasClass('expand')) {
            var h = $(elem).parent('.entry-content').data('height');
            $(elem).parent('.entry-content').animate({'height' : h}); 
            $(elem).removeClass('expand').addClass('collapse').text('Read Less...'); 
        } else {
            var h = $(elem).parent('.entry-content').data('orig_height');
            $(elem).parent('.entry-content').animate({'height' : h}); 
            $(elem).removeClass('collapse').addClass('expand').text('...Read More'); 
        }
    }
}); 