<?php

// Modelo el cual se conecta a la BD y obtiene el nombre de la categoria que almacena en una variable.

    $connexio=connectaDB();

    $ID=$_GET['category'];
    try{
        $consulta_titleCategory= $connexio->prepare("SELECT ID, Name FROM Category WHERE ID=$ID");
        $consulta_titleCategory->execute();
        $resultat_titleCategory= $consulta_titleCategory->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;
?>