<?php

// Controlador el cual llama a los modelos necesarios para conectar a la BD, obtener los paises y mostrar
// estos con la vista en un listado que se utiliza en el registro y edición de los datos personales del usuario.

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_country.php';
    require_once __DIR__.'/../views/list_country.php';
?>