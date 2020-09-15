<?php

// Conecta a la BD y realiza la consulta necesaria para obtener el listado de paises.

    $connexio=connectaDB();
    try{
        $consulta_country= $connexio->prepare("SELECT ID, Country FROM Register_Country");
        $consulta_country->execute();
        $resultat_country= $consulta_country->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;
?>