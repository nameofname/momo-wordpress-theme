
$(document).ready(function(){
    $('.entry-content').each(function(){
        var h = $(this).find('p').height(); 
        $(this).data('height', h); 
    });
    $('.entry-content').find('.expand').on('click', function(){
        var h = $(this).parent('.entry-content').data('height');
        $(this).parent('.entry-content').animate({'height' : h})
    });
});