<?php 
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

//Valida que se un id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: ../');
}

$vendedor = Vendedor::find($id);

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

     //Asignar los atributos
     $args = $_POST['vendedor'];

     //Sincronizar objeto en memoria
     $vendedor->sincronizar($args);
 
     //Validacion
     $errores = $vendedor->validar();
 
     //Revisar que el arreglo de errores este vacio
    if(empty($errores)){
        $vendedor->guardar();
    }
}

incluirTemplate('header'); ?>

    <main class="contenedor seccion">
        <h1>Actualizar Vendedor/a</h1>

        <a href="../index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>

    </main>

<?php incluirTemplate('footer'); ?>