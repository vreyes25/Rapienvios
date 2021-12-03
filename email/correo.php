<?php

/*use PHPMailer\PHPMailer\PHPMailer;

class email{
    
    public $email;
    public $nombre;
    
    public function __construct($email, $nombre){
        $this->email = $email;
        $this->nombre = $nombre;
    }

    public function enviar(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;

        $mail->setFrom('cuentas@novasystem.com');
        $mail->addAddress("cuentas@novasystem.com", "NovaSystem.com");
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en Nova
        System, para confirmarla haz click el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:8080/sistema_ventas/index.php"
        . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        // Enviar email
        $mail->send();
    }
}*/
?>