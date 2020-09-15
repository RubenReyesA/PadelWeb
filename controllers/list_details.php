<?php

// Controlador el cual llama a los modelos y vistas necesarias para poder generar el producto detallado
// con todos las caracteristicas de un producto y las opiniones que tienen los usuario de este mismo producto.

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_details.php';
    require_once __DIR__.'/../views/list_details.php';
    require_once __DIR__.'/../models/SQL_reviews.php';
    require_once __DIR__.'/../views/list_reviews.php';
?>