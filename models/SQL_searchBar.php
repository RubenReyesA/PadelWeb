<?php

// Modelo el cual obtiene el valor introducido en el buscador y realizar una consulta con los productos
// que son parecidos al valor introducido:

$connexio = connectaDB();

$text = $_REQUEST['text'];

// Conversor de espació en expresión regular.
$text = str_replace("%20%", " ", $text);

$string = "%" . $text . "%";

try {
    $consulta_productInfo = $connexio->prepare("SELECT p.ID, p.Name, p.Price, i.PathIMG FROM Product p, Image i 
                        WHERE i.ID_Product=p.ID AND p.isVisible=1 AND p.Name LIKE ? GROUP BY p.ID");
    $consulta_productInfo->bindParam(1, $string, PDO::PARAM_STR);
    $consulta_productInfo->execute();
    $resultat_productInfo = $consulta_productInfo->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$connexio = null;
?>