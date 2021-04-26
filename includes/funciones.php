<?php

require 'app.php';

function incluirTemplate($nombreTemplate, $inicio = false){
    include TEMPLATES_URL  ."/${nombreTemplate}.php";
}

function estaAutenticado() : bool {
    session_start();
    $aut = $_SESSION['login'];
    
    if($aut){
        return true;
    }
    return false;
}