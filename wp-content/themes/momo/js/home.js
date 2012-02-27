
$(document).ready(function(){
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
});