<!--
Vista la cual muestra el listado de productos que contienen una similitud co n el texto introducido en el buscador:
-->
<?php
 $size = sizeof($resultat_productInfo);
?>
    <div class="titleprincipal">
        <h1> Resultados de la búsqueda: (<?php echo $size ?>)</h1>
    </div>
    <div id="ListofProducts">
            <?php
            $pathAddtoCart="../img/addtocart.png";
            foreach ($resultat_productInfo as $fila){
                $pathIMG=$fila["PathIMG"];
                $product_ID=$fila["ID"];
                ?>
                <div class='product'>
                    <img id="image_product" height='200px' class="img_product_view" src='<?php echo $pathIMG ?>' title='<?php echo $product_ID ?>'/>
                    <h3 id="title_product"><?php echo $fila["Name"] ?></h3>
                    <b><h4 id='RealPrice'><?php echo $fila["Price"] ?>€</h4></b>
                    <div id='addtocart_desplegable' class='addtoCartDesplegable'>
                        <button id="btn_product" title=<?php echo $fila["Price"] ?>€><img
                                    onclick="addtoCart(1,'<?php echo $product_ID ?>','<?php echo $fila["Name"] ?>','<?php echo $fila["Price"] ?>€','<?php echo $pathIMG ?>')"
                                    src=<?php echo $pathAddtoCart ?> </img></button>
                    </div>
                </div>
            <?php
            }
            ?>
    </div>