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
    <?php session_start() ?>
    <h1>Reset Password</h1>
    <form class="formulario" name="form1" action="../app/logicamail.php" method="post">
        <div class="contenedor_formulario">
            <?php 
                  if(isset($_SESSION['response'])):
                ?>
                <p class="msje"><?php echo $_SESSION['response'] ?></p>
                <?php 
                    unset($_SESSION['response']); endif;
            ?>
            <div class="nombre_texto"><p>Escriba su email</p> 
                <input type="text" name="correo">
            </div>
            <div class="btns">
                <button class="boton" type="submit" name="reset_pass">Entrar</button>
                <button class="boton" type="reset" name="cancel">Cancelar</button>
            </div>
            
        </div>
    </form>
</body>
</html>