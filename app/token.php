<?php 
    require "../database/conexion.php";

    //consultar con token
    function timeUpdate(){
        $conect = new Conexion();
        $conected = $conect->getConection();
    
        $conect->sql = "SELECT * FROM usuarios WHERE token_password=?";
        // $conect->sql = "SELECT * FROM usuarios WHERE id_usuario=? AND token_password=?";
    
        try {
            $conect->pps = $conected->prepare($conect->sql);
            // forma Ejecutar una sentencia preparada con parámetros de sustitución de signos de interrogación,
            // y poniendo numeros en e 1mer parametro del bindParam() 
            // $conect->pps->bindParam(1,$_GET['id']);
            $conect->pps->bindParam(1,$_GET['token']);
            $conect->pps->execute();
    
            //que nos retorna en forma de obj. la consulta 
            return $conect->pps->fetchAll(PDO::FETCH_OBJ);
    
        } catch (\Throwable $th) {
            echo $th->getMessage();
    
        }finally{//cerramos la consulta para minimizar consumo de recursos
            $conect->closeDB();
        }    
        //echo print_r($data); //con esto imprims consulta de obj. array
    }

    function consultaPass($id_usr){
        $conect = new Conexion();
        $conected = $conect->getConection();
    
        $conect->sql = "SELECT * FROM usuarios WHERE id_usuario=?";
            
        try {
            $conect->pps = $conected->prepare($conect->sql);
            
            $conect->pps->bindParam(1,$id_usr);
            $conect->pps->execute();
    
            //que nos retorna en forma de obj. la consulta 
            return $conect->pps->fetchAll(PDO::FETCH_OBJ);
    
        } catch (\Throwable $th) {
            echo $th->getMessage();
    
        }finally{//cerramos la consulta para minimizar consumo de recursos
            $conect->closeDB();
        }    
        //echo print_r($data); //con esto imprims consulta de obj. array
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