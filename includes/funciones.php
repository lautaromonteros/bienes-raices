<?php

require 'app.php';

function incluirTemplate($nombreTemplate, $inicio = false){
    include TEMPLATES_URL  ."/${nombreTemplate}.php";
}