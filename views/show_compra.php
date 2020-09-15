<!--
Vista que muestra el caarito de la compra con los producto que alamacena el mismo y un conjunto
 de datos para identificar los producto y poder añadir, eliminar productos o vaciar el carro:
-->
<div class="titleprincipal">
    <h1 > Carrito de la compra: </h1>
</div>
<div>
    <?php
        session_start();
        if(!empty($_SESSION["carro_array"])){
            foreach ($_SESSION["carro_array"] as $key => $value) {
                ?>
                <div class="carro_item">
                    <button id="btn_delete" onclick="deleteItem('<?php echo $_SESSION["carro_array"][$key][0] ?>');"><img id="delete" src="../img/delete.png"></button>
                    <img id="logo" src=<?php echo $_SESSION["carro_array"][$key][1] ?>>
                    <h4 id="titleProductCart"><?php echo $_SESSION["carro_array"][$key][2] ?></h4>
                    <div id="ButtonsProductQuantity">
                        <button id="btn_decrease<?php echo $_SESSION["carro_array"][$key][0] ?>" onclick="changeQuantity('d',1,'<?php echo $_SESSION["carro_array"][$key][0] ?>',true);"> -</button>
                        <input type="text" disabled id="ProductQuantityValue<?php echo $_SESSION["carro_array"][$key][0] ?>" value=
                        <?php echo $_SESSION["carro_array"][$key][3] ?> maxlength="2">
                        <button id="btn_increase<?php echo $_SESSION["carro_array"][$key][0] ?>" onclick="changeQuantity('i',1,'<?php echo $_SESSION["carro_array"][$key][0] ?>',true);"> +</button>
                    </div>
                    <div id="carro_precios">
                        <div class="carro_precio">
                            <p> Precio unitario</p>
                            <p id="UnitaryPriceProduct<?php echo $_SESSION["carro_array"][$key][0] ?>"><?php echo $_SESSION["carro_array"][$key][4] ?></p>
                        </div>

                        <div class="carro_precio">
                            <p> Subtotal</p>
                            <p id="TotalPriceProduct<?php echo $_SESSION["carro_array"][$key][0] ?>">
                                <b id="BoldPrice<?php echo $_SESSION["carro_array"][$key][0] ?>">
                                    <?php echo $_SESSION["carro_array"][$key][5] ?></b></p>
                        </div>
                    </div>
                </div>

                <?php
            } ?>

            <div id="total_cart_div">
                <div class="total_cart_item">
                    <button id="btn_delete" onclick="deleteCart();"><img id="delete" src="../img/delete.png">
                    VACIAR CARRITO
                    </button>
                </div>
                <div class="total_cart_item">
                <p> CANTIDAD DE PRODUCTOS: </p>
                <b id="total_quantity"> <?php echo $_SESSION["CartQuantity"] ?> </b>
                </div>

                <div class="total_cart_item">
                <p> TOTAL DEL CARRITO: </p>
                <b id="total_price"> <?php echo $_SESSION["CartPrice"] ?> </b>
                </div>

                <div class="total_cart_item">
                    <img id="pay" src="../img/paypal.png" onclick="pay();">
                </div>
            </div>


        <?php }
        else{ ?>
            <div class="toCenter">
                <br>
                <img id="empty_cart" src="../img/empty_carro.png" >
                <br>
                <p id="empty_cart_text" class="titlesecundario"> CARRITO VACÍO </p>
            </div>
        <?php } ?>

</div>