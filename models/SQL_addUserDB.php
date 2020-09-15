<?php

// Conectamos a la base de datos, comprobamos que los datos introducidos no son erroneos y finalmente realizamos
// la inserción de nuevo usuario con los datos de este.

$connexio = connectaDB();

// Imagen Predeterminada
$img = "../img/imgProfile/userDefault.png";

// Validación de los datos introducidos en el formulario.
$Filter = array("options" => array("regexp" => "/^[a-zA-Z0-9, ]*$/"));
$Filter2 = array("options" => array("regexp" => "/^[a-zA-Z0-9àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));
$Filter3 = array("options" => array("regexp" => "/^[0-9, ]*$/"));
$Filter4 = array("options" => array("regexp" => "/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

$error = false;
$temporal = array();
$temporal["code"] = "error";
$temporal["msg"] = "Errores: \n";

// Comprobación de los datos recibidos:
if (filter_var($_POST["f_Nom"], FILTER_VALIDATE_REGEXP, $Filter4)) {
    $nombre = $_POST["f_Nom"];
} else {
    $message = "El nombre introducido no es valido. Por favor introduce solamente letras.";
    $temporal["msg"] .= $message . "\n";
    $error = true;
}
if (filter_var($_POST["f_Cognoms"], FILTER_VALIDATE_REGEXP, $Filter4)) {
    $apellidos = $_POST["f_Cognoms"];
} else {
    $message = "Los apellidos introducidos no son validos. Por favor introduce solomente letras.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}
if (filter_var($_POST["f_Mail"], FILTER_VALIDATE_EMAIL)) {
    $mail = $_POST["f_Mail"];
} else {
    $message = "La dirección de correo introducido no es valido.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}

if (filter_var($_POST["f_Passwd"], FILTER_VALIDATE_REGEXP, $Filter)) {
    $contrasena = $_POST["f_Passwd"];
    $contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
} else {
    $message = "La Contraseña introducida no es valida. Solo se permiten letras y numeros 
        y tiene que tener de 6 a 12 carácteres.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}
if (filter_var($_POST["f_Pais"], FILTER_VALIDATE_REGEXP, $Filter4)) {
    $pais = $_POST["f_Pais"];
} else {
    $message = "El país seleccionado no es valido. Por favor seleccione un pais de la lista.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}
if (filter_var($_POST["f_Provincia"], FILTER_VALIDATE_REGEXP, $Filter4)) {
    $provincia = $_POST["f_Provincia"];
} else {
    $message = "La provincia seleccionada no es valida. Por favor seleccione una provincia de la lista.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}
if (filter_var($_POST["f_Poblacion"], FILTER_VALIDATE_REGEXP, $Filter4)) {
    $poblacion = $_POST["f_Poblacion"];
} else {
    $message = "La población introducida no es valida. Por favor introduzca solamente letras.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}
if (filter_var($_POST["f_DireccionPostal"], FILTER_VALIDATE_REGEXP, $Filter2)) {
    $direccion = $_POST["f_DireccionPostal"];
} else {
    $message = "La dirección introducida no es valida. Por favor introduzca Calle, Portal, Piso, Nº.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}
if (filter_var($_POST["f_CPostal"], FILTER_VALIDATE_REGEXP, $Filter3)) {
    $codigopostal = $_POST["f_CPostal"];
} else {
    $message = "El codigo postal introducido no es valida. Por favor introduzca solamente numeros de 0 a 9.";
    $temporal["msg"] .= $message . "\n";
    $error = true;

}

if ($error==false) {
// Inserción del Usuario a la BD:
    try {

        $consulta_addUser = $connexio->prepare("INSERT INTO User (Mail, Name, Surnames, Password, Address,
 Town, State, Country, ZIP, imgProfile) VALUES (?,?,?,?,?,?,?,?,?,?)");

        $consulta_addUser->bindParam(1, $mail, PDO::PARAM_STR);
        $consulta_addUser->bindParam(2, $nombre, PDO::PARAM_STR);
        $consulta_addUser->bindParam(3, $apellidos, PDO::PARAM_STR);
        $consulta_addUser->bindParam(4, $contrasena, PDO::PARAM_STR);
        $consulta_addUser->bindParam(5, $direccion, PDO::PARAM_STR);
        $consulta_addUser->bindParam(6, $poblacion, PDO::PARAM_STR);
        $consulta_addUser->bindParam(7, $provincia, PDO::PARAM_STR);
        $consulta_addUser->bindParam(8, $pais, PDO::PARAM_STR);
        $consulta_addUser->bindParam(9, $codigopostal, PDO::PARAM_STR);
        $consulta_addUser->bindParam(10, $img, PDO::PARAM_STR);

        $consulta_addUser->execute();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $connexio = null;

    $temporal2 = array();
    $temporal2["code"] = "success";
    echo json_encode($temporal2);

} else {
    echo json_encode($temporal);
}
?>