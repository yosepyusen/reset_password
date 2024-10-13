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
        .mensaje{
            color: green;
        }

    </style>
</head>
<body>
    <?php session_start(); ?>
    <br><br><br><br><br>
    <h1>Restritate</h1>
    <form class="formulario" name="form1" action="../app/logica.php" method="post">
        <div class="contenedor_formulario">
            <div class="nombre_texto"><p>Usuario</p> 
                <input type="text" name="name" required>
            </div>
            <div class="nombre_texto"><p>Contraseña</p> 
                <input type="password" name="password" required>
            </div>
            <div class="nombre_texto"><p>Rol</p>
                <select name="rol" required>
                    <option value="">Seleccione..</option>
                    <option value="admin">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                </select> 
            </div>
            <div class="nombre_texto"><p>Email</p> 
                <input type="email" name="email" required>
            </div>
            <?php 
                if(isset($_SESSION['mensaje'])):
            ?>
            <p class="mensaje"><?php echo $_SESSION['mensaje'] ?></p>
            <?php 
                endif;
            ?>
            <div class="btns">
                <button class="boton" type="submit" name="registrar">Registrar</button>
                <button class="boton" type="reset" name="cancel">Cancelar</button>
            </div>
            
        </div>
    </form>
</body>
</html>