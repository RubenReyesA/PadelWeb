<!--
Controlar el cual conecta con la BD, llama al modelo BindCityState para cargar el pais con las ciudades y
finalmente inserta el usuario a la BD comprobando que los datos recibidos son correctos.
-->
<?php
    require_once __DIR__.'/../models/connectaDB.php';
    require_once __DIR__.'/../models/SQL_BindCityState.php';
    require_once __DIR__.'/../models/SQL_addUserDB.php';
?>