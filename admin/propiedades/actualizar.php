<?php 
require '../../includes/funciones.php';
$aut = estaAutenticado();

if(!$aut){
    header('Location: ../');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: ../');
}

/* Base de datos*/
require '../../includes/config/database.php';
$db = conectarDB();

$consulta = "SELECT * FROM propiedades where id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);
/* echo '<pre>';
var_dump($propiedad);
echo '</pre>'; */

//Consultar para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorid'];
$imagenPropiedad = $propiedad['imagen'];

//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   /*  echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    echo '<pre>';
    var_dump($_FILES);
    echo '</pre>'; */


    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];

    if(!$titulo){
        $errores[] = 'Debes añadir un titulo';
    }
    if(!$precio){
        $errores[] = 'Debes añadir un precio';
    }
    if(strlen($descripcion)<50){
        $errores[] = 'La descripcion es obligatoria y debe tener al menos 50 caracteres';
    }
    if(!$habitaciones){
        $errores[] = 'Debes añadir la cantidad de habitaciones';
    }
    if(!$wc){
        $errores[] = 'Debes añadir la cantidad de baños';
    }
    if(!$estacionamiento){
        $errores[] = 'Debes añadir la cantidad de estacionamiento';
    }
    if(!$vendedorId){
        $errores[] = 'Debes seleccionar un vendedor';
    }

    $medida = 1000 * 1000;

    if($imagen['size']>$medida){
        $errores[] = 'La imagen es muy pesada';
    }

    /* echo '<pre>';
    var_dump($errores);
    echo '</pre>'; */

    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){

        //Crear carpeta
        $carpetaImagenes = '../../imagenes';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        /* Subida de archivos */
        if($imagen['name']){
            unlink($carpetaImagenes . "/" . $propiedad['imagen']);

            //Generar nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/" .$nombreImagen);
        }else{
            $nombreImagen = $propiedad['imagen'];
        }

        //Insertar en la base de datos
        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, vendedorid = ${vendedorId} WHERE id = ${id}";
    
        //echo $query;
        $resultado = mysqli_query($db, $query);
    
        if($resultado){
            //Redireccionar al usuario
            
            header('Location: ../?resultado=2');
        }
    }
}

incluirTemplate('header'); ?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="../index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">
                
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">
                
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

                <img src="../../imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small">
                
                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información de la Propiedad</legend>
                <label for="habitaciones">Habitaciones</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">
                
                <label for="wc">Baños</label>
                <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">
                
                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor" id="vendedor">
                    <option value="">--Seleccion Vendedor--</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedorId===$row['id'] ? 'selected': ''; ?> value="<?php echo $row['id']?>"><?php echo $row['nombre'] . " " . $row['apellido'] ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>

    </main>

<?php incluirTemplate('footer'); ?>