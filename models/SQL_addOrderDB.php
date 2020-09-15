<?php

// Modelo el cual genera el ticket de compra y por cada elemento diferente de la compra añade un row en la tabla
// de PurchaseLine la cual almacena de cada ticket los productos que lo componen.
// EJEMPLO: Si un ticket(ID 3) marca 3 productos los cuales son 2 palas y 1 paquete de pelotas pues en la tabla
// PurchaseLine tendra 2 inserts uno de 1 pala perteneciente al ticket(ID 3) y otro insert de un paquete de
// pelotas perteneciente al ticket(ID 3).

    $connexio=connectaDB();

    session_start();

    $id=$_SESSION["IDProfile"];
    $quantity=$_SESSION["CartQuantity"];
    $price=str_replace(",",".",substr($_SESSION["CartPrice"],0,-2));

    $today=getdate();
    $date=$today["year"]."-".$today["mon"]."-".$today["mday"];
    $time=$today["hours"].":".$today["minutes"].":".$today["seconds"];

    try{
        $consulta_addOrder= $connexio->prepare("INSERT INTO Ticket (ID_User, Quantity, Price, Date, Time) VALUES (?,?,?,?,?)");
    
        $consulta_addOrder->bindParam(1,$id,PDO::PARAM_INT);
        $consulta_addOrder->bindParam(2,$quantity,PDO::PARAM_INT);
        $consulta_addOrder->bindParam(3,$price,PDO::PARAM_STR);
        $consulta_addOrder->bindParam(4,$date,PDO::PARAM_STR);
        $consulta_addOrder->bindParam(5,$time,PDO::PARAM_STR);
    
        $consulta_addOrder->execute();

        $consulta_ID=$connexio->prepare("SELECT LAST_INSERT_ID() as ID");
        $consulta_ID->execute();
        $resultat_ID= $consulta_ID->fetchAll(PDO::FETCH_ASSOC);
        
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    $id_ticket=$resultat_ID[0]["ID"];
    $_SESSION["last"] = $id_ticket;

    foreach ($_SESSION["carro_array"] as $key => $value) {

        $id_product = $_SESSION["carro_array"][$key][0];
        $quantity_line = $_SESSION["carro_array"][$key][3];
        $price_line=str_replace(",",".",substr($_SESSION["carro_array"][$key][5],0,-2));

        try {
            $consulta_addOrderLine = $connexio->prepare("INSERT INTO PurchaseLine (ID_Ticket, ID_Product, Quantity, Price) VALUES (?,?,?,?)");
            $consulta_addOrderLine->bindParam(1, $id_ticket, PDO::PARAM_INT);
            $consulta_addOrderLine->bindParam(2, $id_product, PDO::PARAM_INT);
            $consulta_addOrderLine->bindParam(3, $quantity_line, PDO::PARAM_STR);
            $consulta_addOrderLine->bindParam(4, $price_line, PDO::PARAM_STR);

            $consulta_addOrderLine->execute();

            updateStock($id_product,$quantity_line,0);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    $connexio=null;


?>