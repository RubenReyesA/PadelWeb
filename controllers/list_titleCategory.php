<?php

// Controlador el cual llama a los modelos necesarios y vistas para conectar a la BD, optener el nombre
// de las categorias y mostrar estas gracias a la vista.

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_titleCategory.php';
    require_once __DIR__.'/../views/list_titleCategory.php';
?>