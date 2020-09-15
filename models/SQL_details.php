<?php

// Modelo el cual obtiene todas las caracteristics de un producto concreto y las almacena en una variable
// para su futuro uso en la vista que muestra el producto detallado.

$connexio=connectaDB();

    $ID=$_GET['productID'];

    try{
        $consulta_details= $connexio->prepare("SELECT p.ID, p.Name, p.Description, p.Price, p.isOffer, p.Old_Price, i.ID_image, i.PathIMG FROM Product p, Image i WHERE p.ID=i.ID_Product AND p.ID=$ID GROUP BY p.ID");
        $consulta_details->execute();
        $resultat_details= $consulta_details->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    $connexio=null;
?>