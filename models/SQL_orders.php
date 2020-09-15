<?php

// Modelo el cual con el ID del usuario obtiene todos los datos de la compras que ha realizado
// el mismo almacennadolas en variables para su uso en la vista:

    session_start();

    $id = $_SESSION["IDProfile"];

    $connexio=connectaDB();
    try{
        $consulta_tickets= $connexio->prepare("SELECT ID, Quantity, Price, DATE_FORMAT(Time, '%H:%i:%S') as Time , DATE_FORMAT(Date,'%d/%m/%Y') AS Date FROM Ticket WHERE ID_User=?");
        $consulta_tickets->bindParam(1,$id,PDO::PARAM_INT);
        $consulta_tickets->execute();
        $resultat_tickets= $consulta_tickets->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;


    function getLineofTicket($id){

        $connexio=connectaDB();
        try{
            $consulta_line= $connexio->prepare("SELECT ID_Product, Quantity, Price FROM PurchaseLine WHERE ID_Ticket=$id");
            $consulta_line->execute();
            $resultat_line= $consulta_line->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connexio=null;

        return ($resultat_line);

    }

    function getNameofProduct($id){

        $connexio=connectaDB();
        try{
            $consulta_product= $connexio->prepare("SELECT Name, Price FROM Product WHERE ID=$id");
            $consulta_product->execute();
            $resultat_product= $consulta_product->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connexio=null;

        return ($resultat_product);

    }

function getImageofProduct($id){

    $connexio=connectaDB();
    try{
        $consulta_image= $connexio->prepare("SELECT PathIMG FROM Image WHERE ID_Product=$id GROUP BY ID_Product");
        $consulta_image->execute();
        $resultat_image= $consulta_image->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;

    return ($resultat_image);

}

?>