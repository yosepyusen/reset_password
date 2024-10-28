<?php 
    session_start();
    // require "../database/conexion.php";
    require "token.php";

    if(isset($_POST['save'])){
        if(!empty($_POST['pass']) && !empty($_POST['pass_confirm'])){

            $pass = $_POST['pass'];
            $passconfirm = $_POST['pass_confirm'];
            $user_id = $_POST['text_id'];
            $token = $_POST['text_token'];

            $data_pass = consultaPass($user_id);

            if( $pass === $passconfirm && password_verify($pass,$data_pass[0]->password)==false ){
                
                $passencript = password_hash($pass, PASSWORD_BCRYPT);
                if(UpdatePass($passencript,$user_id)){
                    
                    $_SESSION['mensaje'] = "Contraseña Actualizado...!!"; 
                    header("location:../index.php");                   
                }

            }else if( password_verify($pass,$data_pass[0]->password) ){    
                $_SESSION['mensaje'] = "Contraseñas no deben ser igual al anterior";
                echo "<script>history.back()</script>";
            }else{    
                $_SESSION['mensaje'] = "Contraseñas deben ser iguales";
                echo "<script>history.back()</script>";
            }

        }else{
            $_SESSION['mensaje']= "Completa los campos";
            echo "<script>history.back()</script>";

        }
    }


  
?>