<?php 
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

// Consulta para tener todos los vendedores
$vendedor = new Vendedor;

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //Crear una nueva instancia 
    $vendedor = new Vendedor($_POST['vendedor']);
    
    //Validar
    $errores = $vendedor->validar();
    //no hay errores
    if(empty($errores)){
        $vendedor->guardar();
    }
}

incluirTemplate('header'); ?>

    <main class="contenedor seccion">
        <h1>Registrar Vendedor/a</h1>

        <a href="../index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form action="../../admin/vendedores/crear.php" method="POST" class="formulario">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Registrar Vendedor/a" class="boton boton-verde">
        </form>

    </main>

<?php incluirTemplate('footer'); ?>