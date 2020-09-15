<?php

// Conecta a la BD y extrae los paises y ciudades de cada uno almacennadolos para su futuro uso en
// registro y edición de datos del perfil.

$connexio=connectaDB();

$provincia=$_POST["f_Provincia"];
$pais=$_POST["f_Pais"];


try{
    $consulta_bind= $connexio->prepare("SELECT Country FROM Register_Country WHERE ID=$pais");
    $consulta_bind->execute();
    $pais= $consulta_bind->fetchAll(PDO::FETCH_ASSOC);
    $_POST["f_Pais"]=$pais[0]["Country"];

    $consulta_bind= $connexio->prepare("SELECT State FROM Register_State WHERE ID=$provincia");
    $consulta_bind->execute();
    $provincia= $consulta_bind->fetchAll(PDO::FETCH_ASSOC);
    $_POST["f_Provincia"]=$provincia[0]["State"];


}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
$connexio=null;
?>