
$(document).ready(function(){
    var num = 0; 
    $('.show-form-allowed').on('click', function(){
        var pm = (num%2 == 0) ? 'less about comments -' : 'about comments +'; 
        $('.form-allowed-tags').toggle('slow', function(){num++}); 
        $(this).text(pm); 
    });
});