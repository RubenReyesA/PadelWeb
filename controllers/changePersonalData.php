<?php

// Controlador el cual se conecta a la BD, llama a los modelos necesarios para modificar los datos actuales del
// usuario y a las funciones de JS necesarias.

session_start();

$option = $_REQUEST["option"];

require_once __DIR__.'/../models/connectaDB.php';
require_once __DIR__.'/../models/SQL_ChangePersonalData.php';

switch ($option){

    case 1:
        changeName($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 2:
        changeSurnames($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 3:
        changeMail($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 4:
        changePass($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 5:
        changeCountry($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 6:
        changeState($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 7:
        changeTown($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 8:
        changeAddress($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    case 9:
        changeZIP($_REQUEST["data"],$_SESSION["IDProfile"]);
        break;
    default:
        break;
}

?>