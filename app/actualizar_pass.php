<?php 
    session_start();
    require "../database/conexion.php";

    if(isset($_POST['save'])){
        if(!empty($_POST['pass']) && !empty($_POST['pass_confirm'])){

            $pass = $_POST['pass'];
            $passconfirm = $_POST['pass_confirm'];
            $user_id = $_POST['text_id'];
            $token = $_POST['text_token'];

            if( $pass === $passconfirm){
                
                $passencript = password_hash($pass, PASSWORD_BCRYPT);
                UpdatePass($passencript,$user_id);

            }else{    
                $_SESSION['err'] = "Contraseñas deben ser iguales";
                echo "<script>history.back()</script>";
            }

        }else{
            $_SESSION['err']= "Completa los campos";
            echo "<script>history.back()</script>";

        }
    }


    function UpdatePass($passencriptado,$user_id){
        
        $conect = new Conexion();
        $conect->sql = "UPDATE usuarios SET password=:pass WHERE id_usuario =:id_usr";

        try {
            
            $conect->pps = $conect->getConection()->prepare($conect->sql);
            $conect->pps->bindParam(":pass",$passencriptado);
            $conect->pps->bindParam(":id_usr",$user_id);

            return $conect->pps->execute();

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }finally{
            $conect->closeDB();
        }
    }
?>