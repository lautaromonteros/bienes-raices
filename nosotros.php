<?php 
require 'includes/funciones.php';
incluirTemplate('header'); ?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <sources srcset="build/img/nosotros.webp" type="image/webp">
                    <sources srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre nosotros" loading="lazy">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 Años de experiencia</blockquote>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores illum repellendus error, reprehenderit impedit minus quas eos dolorum quam quis veritatis mollitia expedita beatae assumenda animi magnam quod, perspiciatis sit.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam ipsa natus tempore! Quidem aliquam temporibus adipisci ipsam eligendi laborum doloribus, quam accusantium est fuga aliquid sint, beatae blanditiis? Harum, molestias.
                Recusandae doloremque quam odit fugit mollitia exercitationem possimus quod ea necessitatibus cum, non animi earum! Similique harum veritatis animi cum id sequi consequuntur! Alias, soluta aspernatur necessitatibus voluptate consequatur suscipit.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat commodi dicta ex ad voluptatibus qui vitae minus distinctio. Animi aspernatur ipsum, eligendi provident veniam facilis?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat commodi dicta ex ad voluptatibus qui vitae minus distinctio. Animi aspernatur ipsum, eligendi provident veniam facilis?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat commodi dicta ex ad voluptatibus qui vitae minus distinctio. Animi aspernatur ipsum, eligendi provident veniam facilis?</p>
            </div>
        </div>
    </section>
    <?php incluirTemplate('footer'); ?>