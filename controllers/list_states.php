<?php

// Controlador el cual llama a los modelos y vistas necesarios para poder conectarse a la BD, obtener las
// ciudades de un cierto pais y posteiormente listarlas en el registro y edición de los datos del usuario
// registrado:

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_states.php';
    require_once __DIR__.'/../views/list_states.php';
?>