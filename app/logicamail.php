<?php 

    session_start();

    //----------- inicio php mailer ------------
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../config/setting.php';
    require '../vendor/autoload.php';
    //----------- fin php mailer ------------

    require("../database/conexion.php");

    if(isset($_POST['reset_pass'])): //si existe el btn send
        
        if (!empty($_POST['correo'])) {
            
            //echo count(ConsultaUsuarioPorEmail("yuchinnaxe@gmail.com")); //imprime uno si coincide con email, caso contrario imprime cero
            //return;
            $correo = $_POST['correo'];
            
            if(filter_var($correo,FILTER_VALIDATE_EMAIL)){ //si es un email valido

                $usuario = ConsultaUsuarioPorEmail($correo);
                
                if (count($usuario) > 0) {
                    
                    //EnviarCorreoResetPassword($usuario);
                    //echo $usuario[0]->name; //imprime: yosep o yusen
                    //echo print_r($usuario); //imprime:Array ( [0] => stdClass Object ( [id_usuario] => 1 [name] => yosep [password] => $2y$10$GovLA8WuLB.kC00YdLCEeef5vvtzBY.Gg6BGCuQd9TNndfe2twQz. [rol] => admin [email] => yuchinnaxe@gmail.com [request_password] => 0 [token_password] => [expired_session] => ) ) 1
                    EnviarCorreoResetPassword($usuario[0]->email, $usuario[0]->name);

                }else{
                    $_SESSION['response'] = "No existe el ususario";
                }
            }else{ // el email escrito en el input no es valido
                $_SESSION['response'] = "Email incorrecto";
            }

        } else {
            $_SESSION['response'] = "Ingrese su email";
        }
    
        //header("location:../view/reset_password.php");
        
    endif;

    function ConsultaUsuarioPorEmail($email){
        
        $conect = new Conexion();
        $conect->sql = "SELECT * FROM usuarios WHERE email = :email";
        
        try {
        
            $conect->pps = $conect->getConection()->prepare($conect->sql);
            $conect->pps->bindParam(":email",$email);

            $conect->pps->execute();

            //FETCH_OBJ: con esto convierte en obj. anonimo
            return $conect->pps->fetchAll(PDO::FETCH_OBJ);

        } catch (\Throwable $th) { //con throwable puede lanzar exception o error, si usamos Exception no va dar una exception n ms
            
            echo $th->getMessage();
        }finally{
            $conect->closeDB();
        }
    }

    // enviar correo reste pass
    function EnviarCorreoResetPassword($emailReceptor, $nombreReceptor){

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
            $mail->addAddress($emailReceptor, $nombreReceptor);     //Es quien recibe el correo
    
            //Content
            $mail->isHTML(true); //enviamos en formato html
            $mail->Subject = 'Reseteo de Password'; //este es el asunto
            $mail->Body    = 'Usted ha solicitado un reseteo de contraseña <b>Cambiar Contraseña aqui</b>'; // es el contenido del correo
        
            $mail->send(); // con esto se envia el email
            echo 'Mensaje Enviado';
        } catch (Exception $e) {
            echo "Mensaje no se envió. Mailer Error: {$mail->ErrorInfo}";
        }
    }

?>