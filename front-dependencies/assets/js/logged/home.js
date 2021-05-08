$(document).ready(function() {
    $('.user-menu').css("display","none");
    var open_menu = false;

    $('#user_img').click(function(event) {
        if (!open_menu){
            $('.user-menu').css("display","block");
            open_menu = true;
        }else{
            $('.user-menu').css("display","none");
            open_menu = false;
        }
    });
    
});
