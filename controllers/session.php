<?php

// Controlador el cual realiza la activación, desactivación de la sessión y verificación del usuario para
// iniciar sessión en el web site:

    session_start();
    $option=$_REQUEST["option"];


    switch ($option){
        case 0: //Activar la sesión
            $_SESSION["StartedSession"]=true;
            require_once __DIR__.'/../models/connectaDB.php';
            require_once __DIR__ . '/../models/SQL_CarritoFunctions.php';

            if(!empty($_SESSION["carro_array"])) {
                require_once __DIR__ . '/../models/SQL_addCarrito.php';
            }

            $_SESSION["carro_array"]=array();
            $_SESSION["CartQuantity"]=0;
            $_SESSION["CartPrice"]="0,00 €";

            require_once __DIR__ . '/../models/SQL_loadCarrito.php';


            header("Location: ../index.php");
            break;
        case 1: //Desactivar la sesión
            $_SESSION["StartedSession"]=false;
            session_destroy();
            break;

        case 2: // Verificación del usuario para iniciar sesión
            $mail = $_POST["mail"];
            $pass = $_POST["pass"];

            $temporal = array();

            require_once __DIR__.'/../models/connectaDB.php';
            require_once __DIR__.'/../models/SQL_session.php';

            if(password_verify($pass,$user_details[0]["Password"])){
                $_SESSION["NameProfile"]=$user_details[0]["Name"];
                $_SESSION["imgPathProfile"]=$user_details[0]["imgProfile"];
                $_SESSION["MailProfile"]=$mail;
                $_SESSION["IDProfile"]=$user_details[0]["ID"];

                $temporal['found']= "true";
            }
            else{
                $temporal['found']= "false";
            }

            echo json_encode($temporal);
            break;
        default:
            break;
    }

?>