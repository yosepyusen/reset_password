<?php 

    session_start();

    //----------- inicio php mailer ------------
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';
    //----------- fin php mailer ------------

    require("../database/conexion.php");

    if(isset($_POST['reset_pass'])): //si existe el btn send
        
        if (!empty($_POST['correo'])) {
            
            //echo count(ConsultaUsuarioPorEmail("yuchinnaxe@gmail.com")); //imprime uno si coincide con email, caso contrario imprime cero
            //return;
            $correo = $_POST['correo'];
            
            if(filter_var($correo,FILTER_VALIDATE_EMAIL)){ //si es un email valido

                if (count(ConsultaUsuarioPorEmail($correo)) > 0) {
                    

                }else{
                    $_SESSION['response'] = "No existe el ususario";
                }
            }else{ // el email escrito en el input no es valido
                $_SESSION['response'] = "Email incorrecto";
            }

        } else {
            $_SESSION['response'] = "Ingrese su email";
        }
    
        header("location:../view/reset_password.php");
        
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

?>