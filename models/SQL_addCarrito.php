<?php

// Modelo el cual añade productos al carro:

    $id = $_SESSION["IDProfile"];

    foreach ($_SESSION["carro_array"] as $key => $val) {
        $id_product= $_SESSION["carro_array"][$key][0];
        $quantity=$_SESSION["carro_array"][$key][3];

        $value=lookforProduct($id,$id_product);
        if($value != false){
            $quantity=(int)$quantity+(int)$value;
            updateCarritoQuantity($id,$id_product,$quantity);
        }
        else {
            insertCarrito($id,$id_product,$quantity);
        }
    }

    $connexio=null;

?>