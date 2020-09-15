<?php

// Modelo el cual con los datos del pais seleccionado realiza la consulta para obtener las ciudades
// que pertenecen a ese pais y posteriormente mostrarlos en una lista.

    $connexio=connectaDB();
    // Obtiene el pais
    if(isset($_GET['country'])){
        $country=$_GET['country'];
    }
    else{ // Si el campo pais esta vacio de la sessión lo inicializa.
        if(empty($_SESSION["Account"])) {
            $country = 1;
        }
        else{
            $country=$_SESSION["ID_Country"];
        }
    }

    try{
        $consulta_state= $connexio->prepare("SELECT ID, State FROM Register_State WHERE ID_Country=$country");
        $consulta_state->execute();
        $resultat_state= $consulta_state->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $connexio=null;
?>