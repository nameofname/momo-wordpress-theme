$(document).ready(function(){
    /*$('label').each(function(key,val){
        var input = $(this).find('input'); 
        $('form input').attr('autocomplete', 'off'); 
        $(this).html(input); 
    }); */
    var user = $('<p>').attr({'class' : 'custom-label', 'id' : 'custom-user-label'}).text('User Name').after($('#user_login')); 
    var pw = $('<p>').attr({'class' : 'custom-label', 'id' : 'custom-pw-label'}).text('Password').after($('#user_pass')); 
    user.attr('autocomplete', 'off'); 
    pw.attr('autocomplete', 'off'); 
    //$('form').attr('autocomplete', 'off'); 
    pw.detach(); 
    user.detach(); 
    $('label').empty(); 
    $('form label').eq(0).append(user); 
    $('form label').eq(1).append(pw); 
});

