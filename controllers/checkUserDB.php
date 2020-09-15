<?php

// Controlador el cual se conecta a la BD y llama al modelo checkUser para comprobar que el usuario que se
// desea insertar no existe en la BD usuarios.

    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_checkUserDB.php';
?>