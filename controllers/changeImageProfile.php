<?php

// Controlador el cual realiza el cambio de la imagen de perfil de un usuario de la pagina web por si desea
// modificar la imagen seleccionada por defecto al crear dicho usuario por primera vez.

session_start();
// Obtengo el id del Usuario.
$id = $_SESSION["IDProfile"];
$formataccepted = array("image/jpg", "image/jpeg", "image/gif", "image/png");

if (in_array($_FILES['imagen']['type'], $formataccepted)) {
    if (isset($_FILES['imagen']) && !empty($_FILES['imagen'])) {

        //Ruta donde se queire dejar la imagen del perfil.
        $destinationPath = '/home/TDIW/tdiw-a6/public_html/img/imgProfile/' . $_FILES['imagen']['name'];
        $insertPath = '../img/imgProfile/' . $_FILES['imagen']['name'];
        // Función que copia la imagen del directorio temp al deseado.
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destinationPath);

        // Insertar en base de datos la ruta de la imagen.
        require_once __DIR__.'/../models/connectaDB.php';
        require_once __DIR__.'/../models/SQL_ProfileImage.php';

        $_SESSION["imgPathProfile"]=$insertPath;

        header("Location: ../index.php");
    }
}
else{
    die("Formato no soportado!");
}
?>