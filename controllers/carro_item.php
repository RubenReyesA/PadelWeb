<?php

// Controlador el cual dependiendo de la opción del usuario ha realizado en el menu detallado del carro; añade
// un nuevo producto, elimina un producto existente en el carro, vacia el carro completamente o cambia el
// numero de unidades de dicho producto a la alza y baja de este.

session_start();

$option=$_GET["option"];

switch ($option){
    case 0: // AÑADIR PRODUCTO NUEVO:
        $idProduct=$_GET["idProduct"];
        $imgProduct=$_GET["img"];
        $nameProduct=$_GET["name"];
        $quantity=$_GET["quantity"];
        $unitary_price=$_GET["unitary_price"];
        $total_price=$_GET["total_price"];

        $cartQuantity=$_GET["cartQuantity"];
        $cartPrice=$_GET["cartPrice"];

        $isFound=false;
        $index=-1;
        foreach ($_SESSION["carro_array"] as $key => $val) {
            if ($_SESSION["carro_array"][$key][0] == $idProduct) {
                $isFound=true;
                $index=$key;
            }
        }

        if($isFound){
            $last_quantity = $_SESSION["carro_array"][$index][3];
            $last_total_price = $_SESSION["carro_array"][$index][5];

            $quantity=(int)$last_quantity+(int)$quantity;

            echo $last_total_price; // IMPORTANTE NO ELIMINAR!

            $_SESSION["carro_array"][$index][3]=(string)$quantity;
        }
        else{
            $arrayADD=array($idProduct,$imgProduct,$nameProduct,$quantity,$unitary_price,$total_price);
            array_push($_SESSION["carro_array"],$arrayADD);
        }


        if($_SESSION["StartedSession"]){
            require_once __DIR__.'/../models/connectaDB.php';
            require_once __DIR__.'/../models/SQL_CarritoFunctions.php';

            if($isFound){
                updateCarritoQuantity($_SESSION["IDProfile"],$idProduct,$quantity);
            }
            else{
                insertCarrito($_SESSION["IDProfile"],$idProduct,$quantity);
            }
        }

        require_once __DIR__.'/../models/connectaDB.php';
        require_once __DIR__.'/../models/SQL_updateStock.php';

        updateStock($idProduct,$quantity,0);

        $_SESSION["CartQuantity"]=$cartQuantity;
        $_SESSION["CartPrice"]=$cartPrice;
        break;

    case 1: // CAMBIAR LA CANTIDAD DE UN PRODUCTO EXISTENTE:
        $idProduct=$_GET["id"];
        $quantity=$_GET["value"];
        $total_price=$_GET["totalprice"];
        $cartQuantity=$_GET["cartquantity"];
        $cartPrice=$_GET["cartprice"];
        $type=$_GET["type"];
        $changed=$_GET["changed"];

        foreach ($_SESSION["carro_array"] as $key => $val) {
            if ($_SESSION["carro_array"][$key][0] == $idProduct) {
                $_SESSION["carro_array"][$key][3]=$quantity;
                $_SESSION["carro_array"][$key][5]=$total_price;
            }
        }


        if($_SESSION["StartedSession"]){
            require_once __DIR__.'/../models/connectaDB.php';
            require_once __DIR__.'/../models/SQL_CarritoFunctions.php';

            updateCarritoQuantity($_SESSION["IDProfile"],$idProduct,$quantity);
        }
        require_once __DIR__.'/../models/connectaDB.php';
        require_once __DIR__.'/../models/SQL_updateStock.php';

        if($type=="i" && $changed=="true") {
            updateStock($idProduct, 1, 0);
        }
        if ($type=="d" && $changed=="true"){
            updateStock($idProduct,1,1);
        }

        $_SESSION["CartQuantity"]=$cartQuantity;
        $_SESSION["CartPrice"]=$cartPrice;

        break;

    case 2: // ELIMINAR UN PRODUCTO DEL CARRO:
        $idProduct=$_GET["id"];
        $cartQuantity=$_GET["cartquantity"];
        $cartPrice=$_GET["cartprice"];
        $quantity=-1;

        $toDelete=-1;

        foreach ($_SESSION["carro_array"] as $key => $val) {
            if ($_SESSION["carro_array"][$key][0] == $idProduct) {
                $toDelete=$key;
                $quantity=$_SESSION["carro_array"][$key][3];
            }
        }

        unset($_SESSION["carro_array"][$toDelete]);

        if($_SESSION["StartedSession"]) {

            require_once __DIR__ . '/../models/connectaDB.php';
            require_once __DIR__ . '/../models/SQL_CarritoFunctions.php';

            updateCarritoDelete($_SESSION["IDProfile"], $idProduct);
        }

        require_once __DIR__.'/../models/connectaDB.php';
        require_once __DIR__.'/../models/SQL_updateStock.php';

        updateStock($idProduct,$quantity,1);

        $_SESSION["CartQuantity"]=$cartQuantity;
        $_SESSION["CartPrice"]=$cartPrice;
        break;

    case 3: // VACIAR EL CARRO COMPLETAMENTE:

        if($_SESSION["StartedSession"]) {

            require_once __DIR__ . '/../models/connectaDB.php';
            require_once __DIR__ . '/../models/SQL_CarritoFunctions.php';

            foreach ($_SESSION["carro_array"] as $key => $val) {
                updateCarritoDelete($_SESSION["IDProfile"], $_SESSION["carro_array"][$key][0]);
            }

        }

        require_once __DIR__ . '/../models/connectaDB.php';
        require_once __DIR__ . '/../models/SQL_updateStock.php';

        foreach ($_SESSION["carro_array"] as $key => $val) {
            updateStock($_SESSION["carro_array"][$key][0],$_SESSION["carro_array"][$key][3],1);
        }

        unset($_SESSION["carro_array"]);
        $_SESSION["carro_array"]=array();
        $_SESSION["CartQuantity"]=0;
        $_SESSION["CartPrice"]="0,00 €";
        break;

    case 4: //FIX STRING PRICE WHEN ADDING AN EXISTING PRODUCT
        $idProduct=$_GET["idProduct"];
        $total_price=$_GET["total_price"];

        foreach ($_SESSION["carro_array"] as $key => $val) {
            if ($_SESSION["carro_array"][$key][0] == $idProduct) {
                $_SESSION["carro_array"][$key][5]=$total_price;
            }
        }
        break;
    default:
        break;
}


?>