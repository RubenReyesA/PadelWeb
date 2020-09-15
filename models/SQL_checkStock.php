<?php

// Modelo que con el id del producto realiza una consulta a la BD para verificar que quedan productos
// del mismo y en caso contrario nos muestra un mensaje.

    $id=$_GET["id"];

    $connexio=connectaDB();
    try{
        $consulta_quantity= $connexio->prepare("SELECT Quantity FROM Product WHERE ID=$id");
        $consulta_quantity->execute();
        $resultat_quantity= $consulta_quantity->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($resultat_quantity)) {
            echo (int)$resultat_quantity[0]["Quantity"];
        }

    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;

?>