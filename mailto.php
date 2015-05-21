<?php
/**
 * Created by PhpStorm.
 * User: Francisco Llanquipichun <francisco.llanquipichun@gmail.com>
 * Date: 19-01-15
 * Time: 21:55
 */

$captcha_data = $_POST['captcha'];
$name = $_POST['name'];
$email = $_POST['mail'];
$msg = $_POST['msg'];

$serviceResponce = array();

/**
 * validacion de captcha
 */
if(!empty($captcha_data)) {

    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6LcbqwATAAAAAGcAaUkYfDelgh0WqgjIby4EYVkO';
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

            //echo "¡El formulario se ha enviado con éxito!";
            $serviceResponce['res'] = TRUE;
            $serviceResponce['msg'] = 'Formulario enviado con exito';
            echo( json_encode($serviceResponce) );
        }else {
            //echo('no se ha podido enviar el mensaje: '.$name.' '.$email.' '.$msg);
            $serviceResponce['res'] = FALSE;
            $serviceResponce['msg'] = 'No se ha podido enviar el mensaje, falta información';
            echo( json_encode($serviceResponce) );
        }

    }else{
        //echo('Tu eres un robot... no me engañas');
        $serviceResponce['res'] = FALSE;
        $serviceResponce['msg'] = 'Tu eres un robot... no me engañas';
        echo( json_encode($serviceResponce) );
    }

}else{
    //echo('no hay captcha');
    $serviceResponce['res'] = FALSE;
    $serviceResponce['msg'] = 'No se ha detectado el captcha';
    echo( json_encode($serviceResponce) );
}