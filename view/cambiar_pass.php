<?php 
    session_start();

    require_once "../database/conexion.php";

    $conect = new Conexion();
    $conected = $conect->getConection();

    $conect->sql = "SELECT * FROM usuarios WHERE id_usuario=? AND token_password=?";

    try {
        $conect->pps = $conected->prepare($conect->sql);
        // forma Ejecutar una sentencia preparada con parámetros de sustitución de signos de interrogación,
        // y poniendo numeros en e 1mer parametro del bindParam() 
        $conect->pps->bindParam(1,$_GET['id']);
        $conect->pps->bindParam(2,$_GET['token']);
        $conect->pps->execute();

        //que nos retorna en forma de obj. la consulta 
        $data = $conect->pps->fetchAll(PDO::FETCH_OBJ);

    } catch (\Throwable $th) {
        echo $th->getMessage();

    }finally{//cerramos la consulta para minimizar consumo de recursos
        $conect->closeDB();
    }    
    //echo print_r($data); //con esto imprims consulta de obj. array

    if(count($data)>0 and $data[0]->expired_session > time()): //si existe $data y expired_session(ya esta guardado en la db) es <= tiempo      
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="estilosTabla.css">

    <style>
        *{
            padding: 0;
            margin: 0;
            background-color: #fbc2eb;
        }
        form{
            max-width: 30%;
            padding: 25px;
            margin: auto;
            justify-content: center;
            align-items: center;
        }
        .contenedor_formulario{
            margin: 0;
            padding: 0;
            border: 1px solid #764ba2;
        }
        .nombre_texto{
            display: flex;
            padding: 5px;
        }
        p{
            margin-right: 5px;
            width:100%;
        }
    
        h1, h2{
            width: 100%;
            text-align: center;
        }
        .btns{
            text-align:center ;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        
        .boton{
            margin-left: 4px;
            padding: 5px;
        }
        .links{
            margin-top: 5px;
            text-align: center;
        }

        .links >*{
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }

        .a1{
            color: purple;
        }
        .a2{
            color: green;
        }
        .msje{
            text-align: center;
            font-family: arial;
            margin: 1rem;
            color: red;
            font-size: 14px;
            font-weight: bold;
            width: 80%;
        }

    </style>
</head>
<body>
    <br><br><br><br><br>
    <h1>Login</h1>
    <form class="formulario" name="form1" action="" method="post">
        <div class="contenedor_formulario">
            
                <?php 
                  if(isset($_SESSION['error'])):
                ?>
                <p class="msje"><?php echo $_SESSION['error'] ?></p>
                <?php 
                    unset($_SESSION['error']); endif;
                ?>
            
            <div class="nombre_texto"><p>Contraseña Nueva</p> 
                <input type="password" name="pass">
            </div>
            <div class="nombre_texto"><p>Confirmar contraseña</p> 
                <input type="password" name="pass_confirm">
            </div>
            <div class="btns">
                <button class="boton" type="submit" name="save">Guardar</button>
                <button class="boton" type="reset" name="cancel">Cancelar</button>
            </div>
            
        </div>
    </form>
</body>
</html>

<?php else: header("location:login.php"); endif; ?>
