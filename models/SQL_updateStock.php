<?php

// Función la cual obtiene el total de unidades de un producto resta el numero que ha comprado el usuario
// en caso de ser negativo lo cambia a zero y si el producto esta a zero unidades lo vuelve no visible para
// que no se compren productos los cuales no quedan en stock.

function updateStock($id_product,$quantity,$mode){

    $connexio=connectaDB();
    try{
        $consulta_quantity= $connexio->prepare("SELECT Quantity FROM Product WHERE ID=$id_product");
        $consulta_quantity->execute();
        $resultat_quantity= $consulta_quantity->fetchAll(PDO::FETCH_ASSOC);

        $old_q=(int)$resultat_quantity[0]["Quantity"];

        switch ($mode){
            case 0:
                $quantity = $old_q - (int)$quantity;
                break;
            case 1:
                $quantity = $old_q + (int)$quantity;
                break;
            case 2:
                $quantity = (int)$quantity;
                break;
            default:
                break;
        }


        if($quantity<=0){
            $quantity=0;
        }

        $update_stock= $connexio->prepare("UPDATE Product SET Quantity=? WHERE ID=?");
        $update_stock->bindParam(1,$quantity,PDO::PARAM_INT);
        $update_stock->bindParam(2,$id_product,PDO::PARAM_INT);
        $update_stock->execute();

        if($quantity<=0){
            $update_visibility= $connexio->prepare("UPDATE Product SET isVisible=? WHERE ID=?");
            $update_visibility->bindParam(1,$quantity,PDO::PARAM_INT);
            $update_visibility->bindParam(2,$id_product,PDO::PARAM_INT);
            $update_visibility->execute();
        }
        else{
            $state=1;
            $update_visibility= $connexio->prepare("UPDATE Product SET isVisible=? WHERE ID=?");
            $update_visibility->bindParam(1,$state,PDO::PARAM_INT);
            $update_visibility->bindParam(2,$id_product,PDO::PARAM_INT);
            $update_visibility->execute();
        }

    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;

}

?>