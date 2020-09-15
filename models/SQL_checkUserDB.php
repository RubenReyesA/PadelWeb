<?php

// Modelo el cual realiza una conexión a la BD y comprueba que el correo que el usuario desea insertar no este
// ya registrado en la BD de usuarios.

    // Función que comprueba que el mail recibido no existe en un usuario ya registrado en la BD.
    function searchForId($mail, $array) {
        foreach ($array as $key => $val) {
            if ($val['Mail'] == $mail) {
                return "false";
            }
        }
        return "true";
    }

    $connexio=connectaDB();

    $mail=$_GET["f_Mail"];

    try{
        $temporal = array();

        $consulta_checkUsers= $connexio->prepare("SELECT Mail FROM User");
        $consulta_checkUsers->execute();
        $resultat_checkUsers= $consulta_checkUsers->fetchAll(PDO::FETCH_ASSOC);

        $temporal['found'] = searchForId($mail,$resultat_checkUsers);

        echo json_encode($temporal);


    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;

?>