<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../config/setting.php';
    require '../vendor/autoload.php';
    

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP(); //el envio se hace por SMTP
        $mail->Host       = HOST;                     
        $mail->SMTPAuth   = true; //Habilitar autenticación SMTP                            
        $mail->Username   = USERNAME;                     
        $mail->Password   = PASSWORD;                           
        $mail->SMTPSecure = SMTP_SECURE; // la seguridad del envio de smtp, Habilitar el cifrado TLS implícito        
        $mail->Port       = PORT;                                      

        //Recipients
        $mail->setFrom('soporte@gmail.com', 'Soprte'); //quien va enviar el correo electronico
        $mail->addAddress('yaguirreobregon@gmail.com', 'yosep');     //Es quien recibe el correo

        //Content
        $mail->isHTML(true); //enviamos en formato html
        $mail->Subject = 'Reseteo de Password'; //este es el asunto
        $mail->Body    = 'Usted ha solicitado un reseteo de contraseña <b>Cambiar Contraseña aqui</b>'; // es el contenido del correo

        $mail->send(); // con esto se envia el email
        echo 'Mensaje Enviado';
    } catch (Exception $e) {
        echo "Mensaje no se envió. Mailer Error: {$mail->ErrorInfo}";
    }

?>