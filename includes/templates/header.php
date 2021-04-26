<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    //var_dump($_SESSION);

    $auth = $_SESSION['login'] ?? false;

    //var_dump($auth);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <?php
        $directory = getcwd();
        $file = 'build/css/app.css';
        $exists = file_exists( $file );
        
        if($exists){
            $ret = $file;
        } else {
            $file = '../'.$file;
            $exists = file_exists( $file );
            if($exists){
                $ret = $file;
            }else {
                $ret = '../'.$file;
            }
        }
    ?>
    <link rel="stylesheet" href="<?php echo $ret; ?>">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                <?php
                    $directory = getcwd();
                    $file = 'build/img/logo.svg';
                    $exists = file_exists( $file );
                    
                    if($exists){
                        $ret = $file;
                    } else {
                        $file = '../'.$file;
                        $exists = file_exists( $file );
                        if($exists){
                            $ret = $file;
                        }else {
                            $ret = '../'.$file;
                        }
                    }
                ?>
                    <img src="<?php echo $ret ?>" alt="logo">
                </a>
                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                    <?php if($auth): ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div><!-- .barra -->

            <?php 
                if($inicio){
                    echo "<h1>Venta de Casas y Depertamentos Exclusivos de Lujo</h1>";
                }
            ?>
        </div>
    </header>