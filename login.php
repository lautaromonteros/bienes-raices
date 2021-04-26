<?php 
require 'includes/config/database.php';
$db = conectarDB();

//Autenticar el usuario
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email){
        $errores[] = "El email es obligatorio o es inválido";
    }

    if(!$email){
        $errores[] = "El passworod es obligatorio";
    }

    if(empty($errores)){
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios where email = '${email}'";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows){
            //Revisar que el password sea correcto
            $usuario = mysqli_fetch_assoc($resultado);

            //Verificar si el pass es correcto 
            $aut = password_verify($password, $usuario['password']);
            if($aut){
                //El usuario ha sido autenticado
                session_start();

                //Llenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header("Location: admin");
            }else{
                $errores[] = "El passworod es incorrecto";
            }
        }else{
            $errores[] = "El usuario no existe";
        }
    }

}

//Incluye el header
require 'includes/funciones.php';
incluirTemplate('header'); ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>
        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu password">

            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>