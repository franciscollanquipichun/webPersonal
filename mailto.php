<?php
/**
 * Created by PhpStorm.
 * User: Francisco Llanquipichun <francisco.llanquipichun@gmail.com>
 * Date: 19-01-15
 * Time: 21:55
 */

$msg = '';
$recaptcha = $_POST['g-recaptcha-response'];

if(!empty($recaptcha))
{
    include("getCurlData.php");
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6LcbqwATAAAAAGcAaUkYfDelgh0WqgjIby4EYVkO';
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;

    $msg = http_get($url);
    echo($msg);
/*
    $res = getCurlData($url);
    $res = json_decode($res, true);

    if($res['success']) {

            $nombre = $_POST['nombre'];
            $mail = $_POST['mail'];
            $text = $_POST['text'];

            if($nombre !== '' && $mail !== '' && $text !== '') {

                $email_to = "francisco.llanquipichun@gmail.com";
                $email_subject = "Contacto desde el sitio web";

                $email_message = "Contacto por correo desde francisco.llanquipichun.cl:\n\n";
                $email_message .= "Nombre: " . $nombre . "\n";
                $email_message .= "E-mail: " . $mail . "\n";
                $email_message .= "Comentarios: " . $text . "\n\n";

                $headers = 'From: francisco.llnquipichun@gmail.com'."\r\n".
                    'Reply-To: francisco.llnquipichun@gmail.com'."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                @mail($email_to, $email_subject, $email_message, $headers);

                echo "¡El formulario se ha enviado con éxito!";
            }else {
                $msg = "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />"
                      ."Por favor, vuelva atrás y verifique la información ingresada<br />";
            }

    }else {
        $msg.="Please re-enter your reCAPTCHA.";
    }
*/
}

echo($msg);