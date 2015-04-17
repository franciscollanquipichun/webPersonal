/**
 * Created by Francisco Llanquipichun on 03-01-15.
 */

$( document ).ready(function() {
    openFollowMe();
    openContact();
    openContactForm();
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
