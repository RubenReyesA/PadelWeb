<?php

// Modelo el cual carga los datos del carrito y en caso de estar vacio inicializa los datos del mismo:

    $connexio=connectaDB();

    $id = $_SESSION["IDProfile"];

    try {
        $consulta_carrito = $connexio->prepare("SELECT ID_Product, Quantity FROM Carrito WHERE ID_User=?");
        $consulta_carrito->bindParam(1, $id, PDO::PARAM_INT);
        $consulta_carrito->execute();
        $resultat_carrito= $consulta_carrito->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    if(empty($resultat_carrito)){
        $_SESSION["carro_array"]=array();
        $_SESSION["CartQuantity"]=0;
        $_SESSION["CartPrice"]="0,00 €";
    }
    else {
        $cartQuantity = 0;
        $cartPrice = 0.00;

        foreach ($resultat_carrito as $item) {
            $idProduct = $item["ID_Product"];

            $imgProduct = getProductImage($idProduct)[0]["PathIMG"];
            $product = getProductNameandPrice($idProduct);

            $nameProduct = $product[0]["Name"];
            $quantity = $item["Quantity"];
            $quantity_int = (int)$quantity;
            $cartQuantity += $quantity_int;


            $unitary_price = $product[0]["Price"];
            $unitary_price_float = (float) $unitary_price;
            $unitary_price=str_replace('.',',',$unitary_price)." €";

            $total_price_float = $quantity_int * $unitary_price_float;
            $cartPrice += $total_price_float;

            $total_price = number_format($total_price_float,2,'.','');
            $total_price=str_replace('.',',',$total_price)." €";

            $arrayADD = array($idProduct, $imgProduct, $nameProduct, $quantity, $unitary_price, $total_price);
            array_push($_SESSION["carro_array"], $arrayADD);
        }

        $_SESSION["CartQuantity"] = $cartQuantity;
        $_SESSION["CartPrice"] = number_format($cartPrice,2,'.','') . " €";

    }

    $connexio=null;


?>