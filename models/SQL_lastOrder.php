<?php

    $connexio=connectaDB();

    session_start();

    $id_ticket=$_SESSION["last"];

    try{
        $consulta_lastOrder= $connexio->prepare("SELECT Quantity, Price, Date, Time FROM Ticket WHERE ID=?");
        $consulta_lastOrder->bindParam(1,$id_ticket,PDO::PARAM_INT);
        $consulta_lastOrder->execute();

        $resultat_lastOrder= $consulta_lastOrder->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;


?>