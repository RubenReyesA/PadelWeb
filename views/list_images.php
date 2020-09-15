<?php

// Vista la cual muestra en el web site las imagenes que hay de un cierto producto y dependiendo del producto
// este dispone de varias imagenes las cuales el usuario que esta visualizando los detalles de este producto
// puede cambiar y visualizarlas.

$type=$_GET["type"];
$actualID=$_GET["PhotoID"];

$i=0;
$found=false;

// Comprobar que las imagenes del producto deseado se encuentran en la lista de imagenes:
while($i<sizeof($resultat_images) and $found==false){
    if($resultat_images[$i]["ID_image"]==$actualID){
        $found=true;
    }
    else {
        $i++;
    }
}
// Si se ha encontrado las imagenes las muestra y permite cambiar entre las diferentes imagenes
// de un mismo producto:
if($found==true){

    if($type=="next") {
        $i++;
        $i = ($i%sizeof($resultat_images));
    }

    if($type=="back"){
        if($i==0){
            $i=sizeof($resultat_images)-1;
        }
        else{
            $i--;
            $i = ($i%sizeof($resultat_images));
        }
    }

    $j=0;
    foreach ($resultat_images as $fila){
        if($i==$j){
            echo $fila['ID_image'] . "/%%/" . $fila["PathIMG"];
        }
        $j++;
    }
}

?>