<?php

// Modelo el cual con el ID del usuario que se encuentra en la sessión se conecta a la BD y realiza
// la consulta necesaria para obtener los datos del usuario:

    session_start();
    $id = $_SESSION["IDProfile"];
    $connexio=connectaDB();

    try{
        $consulta_user= $connexio->prepare("SELECT Mail, Name, Surnames, Address, Town, State, Country, ZIP, imgProfile FROM User WHERE ID=?");
        $consulta_user->bindParam(1,$id,PDO::PARAM_INT);
        $consulta_user->execute();
        $resultat_user= $consulta_user->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;

?>