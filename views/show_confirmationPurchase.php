<div class="titleprincipal">
    <h1> Resultado de la compra: </h1>
</div>

<div class="toCenter">
    <div id="titleConfirmationOrder" class="titlesecundario">
        <h3> Su compra se ha realizado correctamente! </h3>
    </div>
    <?php
    foreach ($resultat_lastOrder as $last){
    ?>
    <hr class="order_hr">
    <p> ID de la transacción: <?php echo $_SESSION["last"]; unset($_SESSION["last"]); ?></p>
    <p> Fecha de la compra: <?php echo $last["Date"]; ?></p>
    <p> Hora de la compra: <?php echo $last["Time"]; ?> </p>
    <hr class="order_hr">
    <p> Cantidad total: <?php echo $last["Quantity"]; ?> </p>
    <p> Precio total pagado: <?php echo $last["Price"]; ?> </p>
    <hr class="order_hr">

    <?php } ?>

    <div id="dualButtonConfirmation">
        <button class="Button" id="btn_printTicket" onclick="printDiv('list_products');">Imprimir Ticket</button>
        <button class="Button" id="btn_mainPage" onclick="goMainPage();">Seguir Comprando</button>
    </div>
</div>