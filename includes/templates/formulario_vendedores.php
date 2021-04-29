<fieldset>
    <legend>Información general</legend>
    
    <label for="nombre">Nombre</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre Vendedor/a" value="<?php echo s($vendedor->nombre); ?>">
    
    <label for="apellido">Apellido</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido Vendedor/a" value="<?php echo s($vendedor->apellido); ?>">
    
    <label for="telefono">Teléfono</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Teléfono Vendedor/a" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>