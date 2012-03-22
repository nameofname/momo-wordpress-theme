$(document).ready(function(){
    /*$('label').each(function(key,val){
        var input = $(this).find('input'); 
        $('form input').attr('autocomplete', 'off'); 
        $(this).html(input); 
    }); */
    var user = $('#user_login'); 
    var pw = $('#user_pass'); 
    user.attr('autocomplete', 'off'); 
    pw.attr('autocomplete', 'off'); 
    //$('form').attr('autocomplete', 'off'); 
    pw.detach(); 
    user.detach(); 
    $('label').empty(); 
    $('form label').eq(0).append(user); 
    $('form label').eq(1).append(pw); 
});

