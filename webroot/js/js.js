$(function(){

//------------------add

    $("button[data-id|='img_add']").on('click', function(){
        arr = $(this).attr('data-id').split('-');
        dir = arr[1];
        $.ajax("/" + dir + "page/item_add/img",{
            type: "POST",
            processData: false,
            contentType: false,
            data: new FormData($('.formimg')[0]),
            success: function(data) {
                //alert (data);
                $("#img").text(data);
                $(".image_main img").attr("src","/mvc_hand/img/" + data);
            }
        })
    });

    $("div[data-id|='add']").on("click",function(){
        arr = $(this).attr('data-id').split('-');
        dir = arr[1];
        $.post("/" + dir + "page/item_add/insert",{
            name: $("#name").text(),
            img: ($("#img").html() !== "") ? $("#img").html() : "picture.png",
            about: $("#about").text(),
            type: $('.check_cat:input:radio:checked').val(),
            price: $("#price").text()
        },function(data){
            //alert (data);
            window.location.href="/" + dir + "page/item_user"
        });
    });

//------------------edit

    $("button[data-id|='img_edit']").on('click', function(){
        arr = $(this).attr('data-id').split('-');
        dir = arr[1];
        $.ajax("/" + dir + "page/item_edit/img",{
            type: "POST",
            processData: false,
            contentType: false,
            data: new FormData($('.formimg')[0]),
            success: function(data) {
                //alert (data);
                $("#img").text(data);
                $(".image_main img").attr("src","/mvc_hand/img/" + data);
            }
        })
    });

    $("div[data-id|='edit']").on('click', function(){
        arr = $(this).attr('data-id').split('-');
        id = arr[1];
        dir = arr[2];
        $.post("/" + dir + "page/item_edit/update",{
            id: id,
            name: $("#name").text(),
            img: $("#img").text(),
            about: $("#about").text(),
            type: $('.check_cat:input:radio:checked').val(),
            price: $("#price").text()
        },function(data){
            //alert(data)
            window.location.href="/" + dir + "page/item_user"
        })
    });

//-------------------del

    $("a[data-id|='del']").on('click', function() {
        arr = $(this).attr('data-id').split('-');
        id = arr[1];
        dir = arr[2];
        $.get("/" + dir + "page/item_user/delete/" + id, function(data){
            //alert(data);
            //$(".product[data-id=" + id + "]").css("display","none")
            location.reload();
        });
    });

//-----------------------------cart

    $("div[data-id|='cart']").on('click', function() {
        arr = $(this).attr('data-id').split('-');
        id = arr[1];
        dir = arr[2];
        $.get("/" + dir + "page/item_cart/add/" + id, function(data){
            //alert (data);
            $("div[id='store'] span").text(data);
        })
    });

//------------------modal

    window.onload = function () {
        $('#myModal').modal('show');
        setTimeout(function(){
            $('#myModal').modal('hide');
        }, 7000);
    };

//------------------registration

    $('#login1, #email1, #pass1').on('keyup', checkInputs);

    function  checkInputs() {
        var login5 = $('#login1').val();
        login = $.trim(login5);
        var email5 = $('#email1').val();
        email = $.trim(email5);
        var pass5= $('#pass1').val();
        pass = $.trim(pass5);

        if (login!='' && email!='' && pass!='') {
            $('form button[id="send"]').removeAttr('disabled');
        }
        else {
            $('form button[id="send"]').attr('disabled', 'disabled');
        }
    }


});






