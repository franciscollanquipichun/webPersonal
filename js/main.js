/**
 * Created by Francisco Llanquipichun on 03-01-15.
 */

$( document ).ready(function() {
    openFollowMe();
    openContact();
    openContactForm();

    $('#contact-form').on('submit', function (e) {
        sendAjaxForm();
        e.preventDefault();
        //OR
        return false;
    });

});

function openFollowMe() {
    $( "#follow-btn" ).click(function() {
        $("#contact").hide();
        $( "#follow" ).toggle("fast");
    });
}
function openContact() {
    $( "#contact-btn" ).click(function() {
        $( "#follow" ).hide();
        $("#contact").toggle("fast");
    });
}

function openContactForm() {
    $( "#mail" ).click(function() {
        $("#contact-form").toggle("fast");
        textcount();
    });
}

function textcount() {
    $("#message").keyup(function(){
        var ms = $(this).val();
        $( "#text-count" ).html(ms.length+":255");
    });
}

function sendAjaxForm() {
    var responseArea = $('#form-submit-area');
    var btn = $('#submit-btn');
    var msg = $('.form-msg');

    var form_data = {
        'captcha'   : $('.g-recaptcha-response').val(),
        'name'      : $('input[name=nombre]').val(),
        'mail'      : $('input[name=mail]').val(),
        'msg'       : $('textarea[name=text]').val()
    };

    $.ajax({
        url: 'mailto.php',
        type:'POST',
        data: form_data,
        before: function () {
            btn.html(' Enviar formulario <i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            response = JSON.parse(response);

            if(response.res == true){

                responseArea.removeClass('alert alert-danger');
                responseArea.addClass('alert alert-success');
                msg.html('<p>'+response.msg+' <i class="fa fa-smile-o"></i></p>');

            }else{

                responseArea.removeClass('alert alert-success');
                responseArea.addClass('alert alert-danger');
                msg.html('<p>'+response.msg+'</p>');
            }
        },
        error: function(e) {

            responseArea.removeClass('alert alert-success');
            responseArea.addClass('alert alert-danger');
            msg.html('<p>Lo siento. Ha ocurrido un problema al enviar el formulario, por favor intentelo mas tarde.</p>');
            console.log(e.message);
        }
    });

    grecaptcha.reset();
}