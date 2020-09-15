<?php

// Controlador el cual llama a los modelos necesarios para obtener las categorias de la BD y mostrar estas
// en una vista realizando el menu lateral del web site.

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_categories.php';
    require_once __DIR__.'/../views/list_categories.php';
?>