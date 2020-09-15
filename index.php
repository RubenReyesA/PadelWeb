<!--
Primer archivo de ejecución el cual inicializa el contenido de la variable session
 y llama al recurso_portada para mostrar la pagina principal de la pagina web.
 -->
<?php

session_start();

if (!isset($_SESSION["carro_array"])) {
    $_SESSION["carro_array"]=array();
    $_SESSION["CartQuantity"]=0;
    $_SESSION["CartPrice"]="0,00 €";
    $_SESSION["StartedSession"]=false;
    $_SESSION["NameProfile"]="";
    $_SESSION["MailProfile"]="";
    $_SESSION["IDProfile"]="";
    $_SESSION["imgPathProfile"]="";
}


require_once __DIR__.'/recurs_portada.php';

?>