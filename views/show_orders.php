<!--
Vista la cual muestra el listado de las compras que ha realizado un usuario registrado en el web site:
-->
<div class="titleprincipal">
    <h1 > Mis compras: </h1>
</div>

<?php

    if(!empty($resultat_tickets)){
    $index=0;
    foreach ($resultat_tickets as $orders){
        $index+=1; ?>
<div class="order">

    <div class="titlesecundario">
        <h3> Compra nº<?php echo $index ?> - <?php echo $orders["Date"] ?> // <?php echo $orders["Time"] ?> </h3>
    </div>

    <hr class="order_hr"/>

    <?php

    $resultat_line=getLineofTicket($orders["ID"]);

    foreach ($resultat_line as $line) {
        $resultat_productName=getNameofProduct($line["ID_Product"]);
        $resultat_image=getImageofProduct($line["ID_Product"]);
        ?>

    <div class="order_item">
        <img id="logo_order" src= <?php echo $resultat_image[0]["PathIMG"] ?> />
        <h4 id="titleOrderItem"> <?php echo $resultat_productName[0]["Name"] ?> </h4>
        <div id="order_quantity">
            <p>Cantidad:</p>
            <p> <?php echo $line["Quantity"] ?> </p>
        </div>
        <div id="order_precios">
            <div class="order_precio">
                <p> Precio unitario</p>
                <p id="UnitaryPriceProduct>"> <?php echo $resultat_productName[0]["Price"] ?>€</p>
            </div>

            <div class="order_precio">
                <p> Subtotal</p>
                <p id="TotalPriceProduct>">
                    <b id="BoldPrice"> <?php echo $line["Price"] ?>€</b></p>
            </div>
        </div>
    </div>

    <hr class="order_hr"/>

    <?php } ?>

    <div class="order_total">
            <div class="total_cart_item">
                <p> CANTIDAD DE PRODUCTOS: </p>
                <b id="total_quantity"> <?php echo $orders["Quantity"] ?> </b>
            </div>

            <div class="total_cart_item">
                <p> TOTAL DE LA COMPRA: </p>
                <b id="total_price"> <?php echo $orders["Price"] ?>€</b>
            </div>
    </div>
</div>
    <?php }}

    else{ ?>
        <div class="toCenter">
            <br>
            <img id="empty_cart" src="../img/empty_carro.png" >
            <br>
            <p id="empty_cart_text" class="titlesecundario"> NO HAY COMPRAS </p>
        </div>
    <?php } ?>

