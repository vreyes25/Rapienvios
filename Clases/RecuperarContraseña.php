<?php
include "Respuesta.php";

class Recuperar {
    public $to;
    public $from = "From: " . "Rapienvios";
    public $subject = "Recuperar contraseña";
    public $message = "Ingrese al siguiente enlace para reestablecer su contraseña\n" . "http://localhost/Rapienvios/confirmPassword.php";


    public function constructorCorreo($to, $from, $subject, $message) {
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function recuperarContraseña($conexion) {
        $Recuperar = new Recuperar();
        $Recuperar->constructorCorreo($this->to, $this->to, $this->subject, $this->message,);
    }

}

try {
    if (isset($_POST['correo']) && !empty($_POST['correo'])) {
        $pass = substr((microtime()), 1, 10);
        $mail = $_POST['correo'];

        $server = "localhost";
        $userbd = "root";
        $passbd = "";
        $db = "rapienvio";
        //Conecto
        $conexion = mysqli_connect($server, $userbd, $passbd, $db);

        $sql = "UPDATE usuario SET contrasena='$pass' WHERE correo='$mail'";

        if ($conexion->query($sql) === true) {

        } else {
            echo "Error modificando: " . $conexion->error;
        }

        $to = $_POST['correo']; //"destinatario@email.com";
        $from = "From: " . "Rapienvios";
        $subject = "Recuperar contraseña";
        $message = "El sistema le asigno la siguiente clave incluyendo el punto (.): " . $pass;

        mail($to, $subject, $message, $from);
        echo 'Contraseña modificada satisfactoriamente revisa tu correo: ' . $_POST['correo'];
    }

} catch (Exception $e) {
    echo 'Excepción capturada: ', $e->getMessage(), "\n";
}
