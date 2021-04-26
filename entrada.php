<?php 
require 'includes/app.php';
incluirTemplate('header'); ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <sources srcset="build/img/destacada.webp" type="image/webp">
            <sources srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="Anuncio" loading="lazy">
        </picture>

        <p class="informacion-meta">Escrito el <span>20/10/2021</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores illum repellendus error, reprehenderit impedit minus quas eos dolorum quam quis veritatis mollitia expedita beatae assumenda animi magnam quod, perspiciatis sit.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam ipsa natus tempore! Quidem aliquam temporibus adipisci ipsam eligendi laborum doloribus, quam accusantium est fuga aliquid sint, beatae blanditiis? Harum, molestias.
            Recusandae doloremque quam odit fugit mollitia exercitationem possimus quod ea necessitatibus cum, non animi earum! Similique harum veritatis animi cum id sequi consequuntur! Alias, soluta aspernatur necessitatibus voluptate consequatur suscipit.</p>
        </div>
    </div>
    </main>

    <?php incluirTemplate('footer'); ?>