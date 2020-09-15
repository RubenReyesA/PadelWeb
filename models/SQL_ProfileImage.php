<?php

// Modelo el cual se conecta a la BD y actualiza la imagen del perfil de un usuario que ha
// iniciado sessión actualmente:

$connexio = connectaDB();
try {
    $update_data = $connexio->prepare("UPDATE User SET imgProfile=? WHERE ID=?");
    $update_data->bindParam(1, $insertPath, PDO::PARAM_STR);
    $update_data->bindParam(2, $id, PDO::PARAM_INT);
    $update_data->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$connexio = null;
?>