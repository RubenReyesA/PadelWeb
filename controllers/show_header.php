<?php

// Controlador el cual muestra la cabecera del web site llamando a la vista necesaria e inicializa
// la sessión si no existe esta:

    if(!isset($_SESSION)){
        session_start();
    }
    require_once __DIR__.'/../views/show_header.php';

?>