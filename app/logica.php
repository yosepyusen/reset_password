<?php
    session_start();
    require '../database/conexion.php';
    // login e acceso
    if (isset($_POST['login'])) { //si existe el btn login
        
    }

    // registrar new usuario
    if(isset($_POST['registrar'])){ //si existe el btn registrar
        //crear variables para datos a enviar
        $name = $_POST['name'] ?? ''; //si esta definido va tomar 1mer valor cas contrario el vacio igual comillas simples
        $pass = $_POST['password'];
        $rol = $_POST['rol'];

        $respuesta = saveUser([
            "name"=> $name,
            "password" => password_hash($pass, PASSWORD_BCRYPT), //encriptamos pass
            "rol"=> $rol
        ]);

        $mensaje = $respuesta ?'usuario registrado' :'no se puede registrar'; //el 1ro es true y el segundo depues de dos puntos es false
        
        $_SESSION['mensaje']= $mensaje;//guardamos el mensaje en $_SESSION['mensaje']
        header("location:../view/registrate.php");

    }

    function saveUser(array $datos){

        try {
            
            $conect = new Conexion();

            $conectado = $conect->getConection();

            $conect->pps = $conectado->prepare( //preparamos la conexion y insertamos datos en la tabla usuarios
                "INSERT INTO usuarios(name,password,rol) VALUES(:name,:password,:rol)"
            );

            $conect->pps->bindParam(":name", $datos['name']);
            $conect->pps->bindParam(":password", $datos['password']);
            $conect->pps->bindParam(":rol", $datos['rol']);

            return $conect->pps->execute();// retorna 1(true, datos correctos) ó 0(false)

        } catch (\Throwable $e) {
            
            echo $e->getMessage();
        }finally{
            $conect->closeDB();
        }
    }
?>