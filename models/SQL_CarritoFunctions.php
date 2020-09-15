<?php

// Modelo que contiene todas las funciones necesarias para trabajar con el carrito de productos del web site:

    function lookforProduct($id,$id_product){

        $connexio=connectaDB();
        try{
            $consulta_exist= $connexio->prepare("SELECT Quantity FROM Carrito WHERE ID_Product=? and ID_User=?");
            $consulta_exist->bindParam(1,$id_product,PDO::PARAM_INT);
            $consulta_exist->bindParam(2,$id,PDO::PARAM_INT);
            $consulta_exist->execute();
            $resultat_exist= $consulta_exist->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connexio=null;

        if(empty($resultat_exist)){
            return false;
        }
        else{
            return $resultat_exist[0]["Quantity"];
        }

    }

    function getProductNameandPrice($id){

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

    function getProductImage($id){

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

    function updateCarritoQuantity($id,$id_product,$newQ){

        $connexio=connectaDB();
        try{
            $update_quantity= $connexio->prepare("UPDATE Carrito SET Quantity=? WHERE ID_User=? AND ID_Product=?");
            $update_quantity->bindParam(1,$newQ,PDO::PARAM_INT);
            $update_quantity->bindParam(2,$id,PDO::PARAM_INT);
            $update_quantity->bindParam(3,$id_product,PDO::PARAM_INT);
            $update_quantity->execute();
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connexio=null;
        

    }

    function updateCarritoDelete($id,$id_product){

        $connexio=connectaDB();
        try{
            $update_quantity= $connexio->prepare("DELETE FROM Carrito WHERE ID_User=? AND ID_Product=?");
            $update_quantity->bindParam(1,$id,PDO::PARAM_INT);
            $update_quantity->bindParam(2,$id_product,PDO::PARAM_INT);
            $update_quantity->execute();
        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $connexio=null;


    }

    function insertCarrito($id,$id_product,$newQ){
        $connexio=connectaDB();

        try {
            $consulta_addCarrito = $connexio->prepare("INSERT INTO Carrito (ID_User, ID_Product, Quantity) VALUES (?,?,?)");
            $consulta_addCarrito->bindParam(1, $id, PDO::PARAM_INT);
            $consulta_addCarrito->bindParam(2, $id_product, PDO::PARAM_INT);
            $consulta_addCarrito->bindParam(3, $newQ, PDO::PARAM_INT);

            $consulta_addCarrito->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

?>