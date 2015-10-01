<?php
/**
 * Created by PhpStorm.
 * @author Francisco Llanquipichun <francisco.llanquipichun@gmail.com>
 * Date: 19-01-15
 * Time: 21:55
 */

require 'Constants.php';

$captcha_data = $_POST['captcha'];
$name = $_POST['name'];
$email = $_POST['mail'];
$msg = $_POST['msg'];

/**
 * validacion de captcha
 */
if(!empty($captcha_data)) {

    $google_url = $_CAPTCHA_URL;
    $secret = $_CAPTCHA_SECRET;

    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $google_url."?secret=".$secret."&response=".$captcha_data."&remoteip=".$ip;

    $response = file_get_contents($url);
    $aceptado = json_decode($response);

    //valida el capcha
    if($aceptado->success == TRUE ) {

        if($name !== '' || $email !== '' || $msg !== '') {

            $email_to = "francisco.llanquipichun@gmail.com";
            $email_subject = "Contacto desde el sitio web";

            $email_message = "Contacto por correo desde francisco.llanquipichun.cl:\n\n";
            $email_message .= "Nombre: " . $name . "\n";
            $email_message .= "E-mail: " . $email . "\n";
            $email_message .= "Mensaje:\n" . $msg . "\n";

            $headers = 'From: francisco@llanquipichun.cl'."\r\n".
                'Reply-To: '.$email."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            @mail($email_to, $email_subject, $email_message, $headers);

            formResponse(TRUE, 'Formulario enviado con exito');

        }else{
            formResponse(FALSE, 'No se ha podido enviar el mensaje, falta información');
        }

    }else{
        formResponse(FALSE, 'Tu eres un robot... no me engañas');
    }

}else{
    formResponse(FALSE, 'No se ha detectado el captcha');
}



/**
 * envia respuesta al formulario
 * @param boolean $res
 * @param string $msg
 */
function formResponse($res, $msg) {

    $serviceResponce['res'] = $res;
    $serviceResponce['msg'] = $msg;

    echo(
        json_encode($serviceResponce)
    );
}