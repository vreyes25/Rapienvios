<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';  

    $correo = new PHPMailer();
    //lamando a los campos
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    //Datos para el correo
    $destinatario = "rapienviosexpress2021@gmail.com";   
    $asunto = "Bienvenido a Rapienvios";

    $carta = "Has creado tu cuenta en Nova System, para iniciar sesión haz click el siguiente enlace: \n";
    $carta .= "http://localhost/Rapienvios/login.php\n";
    
    //$carta = "Para: $nombre \n";
    //$carta = "Correo: $correo \n";

    //Enviando mensaje
    mail($destinatario, $asunto, $carta);

    header("Location:login.php");

    /*$correo = $_POST['correo'];
    $subject = "Bienvenido a nuestro sitio web";
    $msg = "Gracias por registrarte";
    $send = mail($correo, $subject, $msg);

    if($send){
        echo "Correo enviado correctamente";
    }else{
        echo "No se pudo enviar";
    }*/

    /*$to = 'ventascliente3@gmail.com';
    $subject = 'Nova System';
    $message = '¡Gracias por registrarte.! Ya puedes inicar sesión y realizar tus compras.';
    $headers = 'From: novasistema3@gmail.com' . "\r\n" .
                'Reply-To: novasistema3@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);*/


?>