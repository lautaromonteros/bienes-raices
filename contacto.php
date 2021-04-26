<?php 
require 'includes/app.php';
incluirTemplate('header'); ?>
    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="blog">
        </picture>

        <h2>LLene el formularioa de Contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email">

                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" placeholder="Tu telefono">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select name="opciones" id="opciones">
                    <option value="0" disabled selected>-- Seleccione una opción --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="tel" name="presupuesto" id="presupuesto" placeholder="Tu precio o presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser cotnactado</p>
                <label for="opciones">Vende o compra</label>
                
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">Email</label>
                    <input type="radio" name="contacto" id="contactar-email">
                </div>

                <p>Si eligió telefono, elija la fecha y hora para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>