<footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los Derechos Reservados <?php echo date('Y')?> &copy;</p>
    </footer>
    
    <?php
        $directory = getcwd();
        $file = 'build/js/bundle.min.js';
        $exists = file_exists( $file );
        
        if($exists){
            $ret = $file;
        } else {
            $exists = file_exists( $file );
            if($exists){
                $ret = $file;
            }else {
                $ret = '../'.$file;
            }
        }
    ?>
    <script src="<?php echo $ret; ?>"></script>
</body>
</html>