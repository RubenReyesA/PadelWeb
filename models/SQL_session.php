<?php

// Modelo el cual se conecta a la BD y optiene los datos del usuario con el correo que recibe.

$connexio=connectaDB();

try{
    $consulta_pass= $connexio->prepare("SELECT ID, Name, Password, imgProfile FROM User WHERE Mail='$mail'");
    $consulta_pass->execute();
    $user_details= $consulta_pass->fetchAll(PDO::FETCH_ASSOC);

}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

$connexio=null;

?>