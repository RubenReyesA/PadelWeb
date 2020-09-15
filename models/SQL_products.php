<?php

// Modelo el cual se conecta a la BD y obtiene los datos del producto seleccionado distingiendo si
// este se encuantra en oferta o no gracias al campo category ya que los datos a mostrar son diferentes
// y los almacena en una variable para su utilización posteriormente:

    $connexio=connectaDB();

    $ID=$_GET['category'];

    if($ID==1){// Productos en oferta:
        try{
            $consulta_productInfo= $connexio->prepare("SELECT p.ID, p.Name, p.Price, p.Old_Price, i.PathIMG FROM Product p, Image i WHERE i.ID_Product=p.ID AND p.isVisible=1 AND p.isOffer=1 GROUP BY p.ID");
            $consulta_productInfo->execute();
            $resultat_productInfo= $consulta_productInfo->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }

    }
    else{// Productos sin oferta:
        try{
            $consulta_productInfo= $connexio->prepare("SELECT p.ID, p.Name, p.Price, i.PathIMG FROM Product p, Image i WHERE i.ID_Product=p.ID AND p.isVisible=1 AND p.ID_Category=$ID GROUP BY p.ID");
            $consulta_productInfo->execute();
            $resultat_productInfo= $consulta_productInfo->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    $connexio=null;
?>