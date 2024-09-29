<?php
    session_start();
    require '../database/conexion.php';
    // login e acceso
    if (isset($_POST['login'])) { //si existe el btn login
        
        if (!empty($_POST['usuario']) and !empty($_POST['pass'])) {

            $login = $_POST['usuario'];
            $password = $_POST['pass'];

            login([
                "usuario"=>$login, //aqui porque en el input name va permitir ingresar el usuario o correo
                "pass"=>$password 
            ]);
        } else {

            $_SESSION['error'] = 'Ingrese sus credenciales';
            header("location:../view/login.php");
        }
        
    }

    // registrar new usuario
    if(isset($_POST['registrar'])){ //si existe el btn registrar
        //crear variables para datos a enviar
        $name = $_POST['name'] ?? ''; //si esta definido va tomar 1mer valor cas contrario el vacio igual comillas simples
        $pass = $_POST['password'];
        $rol = $_POST['rol'];
        $email = $_POST['email'];

        // llamamos a f.saveUser() y dentro le pasamos los datos
        $respuesta = saveUser([
            "name"=> $name,
            "password" => password_hash($pass, PASSWORD_BCRYPT), //encriptamos pass
            "rol"=> $rol,
            "email" => $email
        ]);

        $mensaje = $respuesta ?'usuario registrado' :'no se puede registrar'; //el 1ro es true y el segundo depues de dos puntos es false
        
        $_SESSION['mensaje']= $mensaje;//guardamos el mensaje en $_SESSION['mensaje']
        header("location:../view/registrate.php");

    }

    function saveUser(array $datos){

        try {
            
            $conect = new Conexion(); //instancia la clase

            $conectado = $conect->getConection(); //llamamos a conecion a db

            //hacemos la consulta
            $conect->pps = $conectado->prepare( //preparamos la conexion y insertamos datos en la tabla usuarios
                "INSERT INTO usuarios(name,password,rol,email) VALUES(:name,:password,:rol,:email)"
            );

            //con array $datos['name'] con nombre name, le pasamos el abrebiado ":name",
            $conect->pps->bindParam(":name", $datos['name']);
            $conect->pps->bindParam(":password", $datos['password']);
            $conect->pps->bindParam(":rol", $datos['rol']);
            $conect->pps->bindParam(":email", $datos['email']);

            return $conect->pps->execute();// retorna 1(true, datos correctos) ó 0(false)

        } catch (\Throwable $e) {
            
            echo $e->getMessage();
        }finally{
            $conect->closeDB();
        }
    }

    // realiza el logeo
    function login(array $credenciales){
        // consulta a db
        $conect = new Conexion();

        //en f. ConsultaUsuario(), 1mer datos es la conexion establecida y la 2da es array
        $usuario = ConsultaUsuario($conect,[ // la consulta se hace solo con el usuario
            "usuario"=>$credenciales['usuario']
        ]);
        //print_r($usuario[0]['name']); //impima el array del index cero y el campo nombre //imprime yuen o yosep
        //echo $usuario;
        //echo "<br>";
        // print_r(ConsultaUsuario($conect,[  // con esto imprime Array ( [0] => Array ( [id_usuario] => 2 [0] => 2 [name] => yusen [1] => yusen [password] => $2y$10$NBQsI0fs0GsRDseW9DvYXOeWzbQO3YRCk1m9PC2W8yw3tlYHGWriq [2] => $2y$10$NBQsI0fs0GsRDseW9DvYXOeWzbQO3YRCk1m9PC2W8yw3tlYHGWriq [rol] => vendedor [3] => vendedor [email] => jhosepeltukito@gmail.com [4] => jhosepeltukito@gmail.com [request_password] => 0 [5] => 0 [token_password] => [6] => [expired_session] => [7] => ) )
        //     "usuario"=>$credenciales['usuario'],
        //     "email"=>$credenciales["email"]
        // ]));
        
        // echo count($usuario); //imprime: cero cuando no hay usuario y 1 si coincide
        // return;

        if (count($usuario)>0) { //si existe el usuario

            $username = $usuario[0]['name'];//capturamos el name de la db
            $correo = $usuario[0]['email'];// capturamos el email del db
            $hashpassword = $usuario[0]['password'];

            if( $username===$credenciales['usuario'] or $correo ===$credenciales['usuario']){ //si el $username de la db es igual a credencial que ingresas en el input de name

                if (password_verify($credenciales['pass'],$hashpassword)) {
                    header("location:../view/dashbord.php");
                }else{
                    $_SESSION['error']= 'Error en password';
                    header("location:../view/login.php");
                }

            }else{
                $_SESSION['error']= 'Error en el nombre de usuario';
                header("location:../view/login.php");
            }

        }else{
            $_SESSION['error']= 'Error, no existe ese usuario';
            header("location:../view/login.php");
        }
        
    }

    //consulta al usuaio
    function ConsultaUsuario($conexion, array $dataConsulta){
        
        $consulta = "SELECT * FROM usuarios WHERE name =:name OR email=:email";

        try {
            $conexion->pps = $conexion->getConection()->prepare($consulta);

            $conexion->pps->bindParam(":name",$dataConsulta['usuario']);
            $conexion->pps->bindParam(":email",$dataConsulta['usuario']);//usuario pq permite en el input email o usuario

            $conexion->pps->execute();

            return $conexion->pps->fetchAll();
        } catch (\Throwable $e) {
            
            echo $e->getMessage();

        }finally{
            $conexion->closeDB();
        }
    }
?>