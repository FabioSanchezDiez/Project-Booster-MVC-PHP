<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $name;
    protected $token;

    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];

        $mail->setFrom("accounts@projectbooster.com");
        $mail->addAddress("accounts@projectbooster.com", "projectbooster.com");
        $mail->Subject = "Confirma tu Cuenta";

        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $content = "<html>";
        $content .= "<p><strong>Hola " . $this->name . "</strong> Has creado tu cuenta en Project Booster, confirmala en el siguiente enlace</p>";
        $content .= "<p>Pulse aquí: <a href='".$_ENV["PROJECT_URL"]."/confirm?token=" .$this->token . "'>Confirmar Cuenta</a></p>";
        $content .= "<p>Si tu no has creado esta cuenta, simplemente ignora este mensaje.</p>";
        $content .= "</html>";
        $mail->Body = $content;

        //Send email
        $mail->send();
    }

    public function sendResetPassword()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV["EMAIL_PORT"];
        $mail->Username = $_ENV["EMAIL_USER"];
        $mail->Password = $_ENV["EMAIL_PASS"];

        $mail->setFrom("accounts@projectbooster.com");
        $mail->addAddress("accounts@projectbooster.com", "projectbooster.com");
        $mail->Subject = "Reestablece tu contraseña";

        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";

        $content = "<html>";
        $content .= "<p><strong>Hola " . $this->name . "</strong> Has solicitado cambiar la contraseña en Project Booster, puedes cambiarla en el siguiente enlace</p>";
        $content .= "<p>Pulse aquí: <a href='".$_ENV["PROJECT_URL"]."/restart?token=" .$this->token . "'>Reestablecer Contraseña</a></p>";
        $content .= "<p>Si tu no has creado esta cuenta, simplemente ignora este mensaje.</p>";
        $content .= "</html>";

        $mail->Body = $content;

        //Send email
        $mail->send();
    }
}
