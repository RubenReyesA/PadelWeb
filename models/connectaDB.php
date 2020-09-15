<?php
// Modelo el cual realiza la conexión a la base de datos y la devuelva para realizar modificaciones
// en ella, consultar datos, ...
function connectaDB(){

    $servidor="localhost";
    $usuari="tdiw-a6";
    $clau="VauMCxx_";
    try {
        $connexio = new PDO("mysql:host=$servidor;dbname=tdiwa6;charset=utf8", $usuari, $clau);
        $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    return ($connexio);
}

?>