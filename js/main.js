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
        success: function (response) {
            //examina la respuesta
            console.log(response);
        }
    });

}