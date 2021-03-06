$(document).ready(function(){
    // For truncated content on the journaled pages - When the user clicks the 
    // expand button, expand to the height of the content, 
    // Toggles back to the original height. 
    $('#primary-journaled .entry-content').each(function(key, val){
        // Remove the "read more" link if the post's height is under 99px.  
        // In some cases, if an image loads up late, this could negatively impact the
        // layout, but it hasn't been a problem for me. 
        var h = $(this).height(); 
        if (h <= 99){
            $(this).find('.expand').remove(); 
        }
        // Store the original height - 99px. 
        // Get the height of the posts contents on the fly to account for changes to
        // height - eg. image took a long time to load, etc. 
        $(this).data('orig_height', '99px'); 
        $(this).css('height', '99px'); 
    });
    $('#primary-journaled .entry-content').find('.expand, .collapse').on('click', function(){
        swap_height(this); 
    });
    function swap_height(elem){
        if($(elem).hasClass('expand')) {
            var h = $(elem).parent('#primary-journaled .entry-content-inner').height(); 
            console.log(h); 
            console.log($(elem).parent('#primary-journaled .entry-content')); 
            $(elem).closest('#primary-journaled .entry-content').animate({'height' : h}); 
            $(elem).removeClass('expand').addClass('collapse').text('Read Less...'); 
        } else {
            var h = $(elem).closest('#primary-journaled .entry-content').data('orig_height');
            $(elem).closest('#primary-journaled .entry-content').animate({'height' : h}); 
            $(elem).removeClass('collapse').addClass('expand').text('...Read More'); 
        }
    }

}); 
