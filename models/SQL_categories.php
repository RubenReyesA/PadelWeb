<?php

// Modelo el cual se conecta a la BD y realiza la consulta para obtener las categorias y alamacenarlas
// para su posteior uso.

    $connexio=connectaDB();
    try{
        $consulta_categories= $connexio->prepare("SELECT ID, Name FROM Category");
        $consulta_categories->execute();
        $resultat_categories= $consulta_categories->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;
?>