<?php 
    session_start();
    require("../app/token.php");
    
    $data=timeUpdate();
    
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
    <form class="formulario" name="form1" action="../app/actualizar_pass.php" method="post">
        <div class="contenedor_formulario">

        <?php 
                  if(isset($_SESSION['mensaje'])):
                ?>
               
                <p class="msje"><?php echo $_SESSION['mensaje'] ?></p>
                <?php 
                    unset($_SESSION['mensaje']); endif;
                ?>
            
            <div hidden class="nombre_texto">
                <input hidden type="text" name="text_id" value="<?= $data[0]->id_usuario ?>">
            </div>
            <div hidden class="nombre_texto">
                <input hidden type="text" name="text_token" value="<?= $data[0]->token_password ?>">
            </div>
            <div class="nombre_texto"><p>Contraseña Nueva</p> 
                <input type="password" name="pass">
            </div>
            <div class="nombre_texto"><p>Confirmar Contraseña Nueva</p> 
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
