<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilosTabla.css">

    <style>
        *{
            padding: 0;
            margin: 0;
            background-color: #fbc2eb;
        }
        form{
            max-width: 27%;
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
            width:32%;
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

    </style>
</head>
<body>
    <br><br><br><br><br>
    <h1>Login</h1>
    <form class="formulario" name="form1" action="../app/logica.php" method="post">
        <div class="contenedor_formulario">
            <div class="nombre_texto"><p>Usuario</p> 
                <input type="text" name="login" required>
            </div>
            <div class="nombre_texto"><p>Contraseña</p> 
                <input type="text" name="password" required>
            </div>
            <div class="links">
                <a class="a1" href="">Olvidaste la contraseña?</a>
                <a class="a2" href="registrate.php">Registrate...!</a>
            </div>
            <div class="btns">
                <button class="boton" type="submit" name="login">Entrar</button>
                <button class="boton" type="reset" name="cancel">Cancelar</button>
            </div>
            
        </div>
    </form>
</body>
</html>