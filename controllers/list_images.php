<?php

// Controlador el cual llama a los modelos y vistas necesarias para poder conectarse a la BD, extraer las
// imagenes de la BD y mostrar estas en el web site.

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_images.php';
    require_once __DIR__.'/../views/list_images.php';
?>
