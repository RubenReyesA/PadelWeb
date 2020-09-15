<?php

// Modelo que contiene las funciones necesarias para editar cualquier dato del usuario:

function changeName($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET Name=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $_SESSION["NameProfile"]=$item;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "El nombre introducido no es válido. Por favor introduce solamente letras";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }
}

function changeSurnames($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET Surnames=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "Los apellidos introducidos no son válidos. Por favor introduce solamente letras.";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }
}


function changeMail($item, $id)
{
    if (filter_var($item, FILTER_VALIDATE_EMAIL)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET Mail=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "La dirección de correo introducida no es válida.";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }

}

function changePass($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-Z0-9, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $pass = password_hash($item, PASSWORD_BCRYPT);

            $update_data = $connexio->prepare("UPDATE User SET Password=? WHERE ID=?");
            $update_data->bindParam(1, $pass, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "La contraseña introducida no es válida. Sólo se permiten letras y números 
        y debe tener de 6 a 12 carácteres";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }


}

function changeCountry($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET Country=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "El país seleccionado no es válido. Por favor seleccione un país de la lista.";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }


}

function changeState($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET State=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "La provincia seleccionada no es válida. Por favor seleccione una provincia de la lista.";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }


}

function changeTown($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET Town=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "La población introducida no es válida. Por favor introduzca solamente letras.";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }

}

function changeAddress($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[a-zA-Z0-9àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ, ]*$/"));

    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET Address=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "La dirección introducida no es válida. Por favor introduzca Calle, Portal, Piso, Nº.";
        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }

}

function changeZIP($item, $id)
{
    $Filter = array("options" => array("regexp" => "/^[0-9, ]*$/"));
    if (filter_var($item, FILTER_VALIDATE_REGEXP, $Filter)) {
        $connexio = connectaDB();
        try {
            $update_data = $connexio->prepare("UPDATE User SET ZIP=? WHERE ID=?");
            $update_data->bindParam(1, $item, PDO::PARAM_STR);
            $update_data->bindParam(2, $id, PDO::PARAM_INT);
            $update_data->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $connexio = null;

        $temporal = array();
        $temporal["code"] = "success";
        echo json_encode($temporal);

    } else {
        $message = "El código postal introducido no es válido. Por favor introduzca solamente números de 0 a 9.";

        $temporal = array();
        $temporal["code"] = "error";
        $temporal["msg"] = $message;

        echo json_encode($temporal);
    }

}

?>