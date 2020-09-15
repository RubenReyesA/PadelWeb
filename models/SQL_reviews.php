<?php

// Modelo el cual realiza la conexión con la BD y obtiene las opiniones de un producto concreto.

    $connexio=connectaDB();

    $ID=$_GET['productID'];

    try{
    $consulta_reviews= $connexio->prepare("SELECT ID, Text_Review FROM Reviews WHERE ID_Product=$ID");
    $consulta_reviews->execute();
    $resultat_reviews= $consulta_reviews->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    $connexio=null;
?>