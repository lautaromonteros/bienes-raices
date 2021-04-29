<?php 
    require 'includes/app.php';

    use App\Propiedad;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('location: index.php');
    }

    $propiedad = Propiedad::find($id);
    
    incluirTemplate('header'); 


?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <img src="imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>

            </ul>
            <p><?php echo $propiedad->descripcion; ?></p>
        </div>
    </div>
    </main>
    
    <?php incluirTemplate('footer'); ?>