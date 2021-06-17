$(document).ready(function() {
    $(".card-lista").click(function(event) {
        var id = this.getAttribute("id");
        window.location.href = './lista?list_id='+id;

    });

    $('#user-menu').css("display","none");
    var open_menu = false;
    $('#user-atributes-warper').click(function(event){
        if (!open_menu){
            $('#user-menu').css("display","block");
            open_menu = true;
        }else{
            $('#user-menu').css("display","none");
            open_menu = false;
        }
    });
    $('#logout').click(function(){
        var request = $.ajax({
            url: "../backend/logout.php",
            type: "post",
            dataType: 'json',
            data: '',
            async: false
        });
        window.location = './';
    });

});
