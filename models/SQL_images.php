<?php

// Modelo el cual se conecta a la BD y realiza la consulta necesaria para extraer las imagenes de un
// producto concreto para utilizarlas en los detalles del producto y la previsualización del mismo en el catalogo
// de productos.

    $connexio=connectaDB();

    $PhotoID=$_GET["PhotoID"];

    try{
        $consulta_images= $connexio->prepare("SELECT ID_image, PathIMG FROM Image WHERE ID_Product=(SELECT ID_Product FROM Image WHERE ID_image=$PhotoID)");
        $consulta_images->execute();
        $resultat_images= $consulta_images->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;
?>