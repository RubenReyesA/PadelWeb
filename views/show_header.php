<!--
Vista la cual muestra la cabezera del web site y dependiendo del contenido de la sessión muestra
 unos datos u otros:
-->

<div id="sub1">
    <img id="imglogo" src="../img/Logo.png" width="400px" height="100%" class="responsive800"/>
</div>

<div id="sub2">
    <div id="Contacto">
        <img id="telf" src="../img/telf.png" class="responsive400"/>
        <p> Contáctanos al 938791234 - 666123789 </p>
    </div>
    <div id="AC-RG">
            <button class="Button" id="btn_AtClients">Atención Cliente</button>
            <button class="Button" id="btn_Register">Registrarse </button>
    </div>
    <div id="search_bar">
        <input id="search_bar_edit" placeholder="Escribe para buscar" type="text"/>
    </div>
</div>

<div id="sub3">

<?php
    $start = $_SESSION["StartedSession"];

    if($start){ ?>

    <div id="sub3-3">
        <div id="sub3-3-1">
            <img id="logosession" src="<?php echo $_SESSION["imgPathProfile"] ?>">
            <p id="msgsession" title="<?php echo $_SESSION["NameProfile"] ?>"> ¡Hola <?php echo $_SESSION["NameProfile"] ?>! </p>
        </div>
        <div id="sub3-3-2">
            <button id="btn_account" class="Button"> Mi cuenta </button><br>
            <button id="btn_orders" class="Button"> Mis compras </button><br>
            <button id="btn_close" class="Button" onclick="closeSession();"> Cerrar sesión </button><br>
        </div>
    </div>

   <?php }
    else{ ?>
    <div id="sub3-1">
        <img id="userclient" width="120px" height="120px" src="/img/InicioSesion.png" onclick="showLogin();">
    </div>
    <div id="sub3-2">
        <form method="post" id="form_login" action="../controllers/session.php?option=0"
              onsubmit='startSession(); return false;'>
            <h3> Mail: </h3>
            <input class="user_pass" type="text" id="username" name="username"
                   pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
                   placeholder="Tu mail registrado (@)" required
                   title="Por favor introduzca correctamente su mail"><br/>
            <h3> Password: </h3>
            <input class="user_pass" type="password" id="userpass" name="userpass"
                   placeholder="Tu contraseña registrada"
                   title="La contraseña introducida no es válida (de 6 a 12 carácteres)"
                   pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜàèòÀÈÒ0-9]+" minlength="6" maxlength="12" required><br/>
            <input id="start_session" type="submit" name="f_Submit" value="Iniciar sesión"><br>
        </form>
    </div>

    <?php } ?>

</div>
<div id="carrito_compra">
    <div id="carrito_compra_img">
    <img src="../img/buy.png" class="responsive400"/>
    <p id="cart_quantity"> <?php echo $_SESSION["CartQuantity"] ?> </p>
    </div>
    <hr>
    <div id="carrito_compra_price">
        <p id="cart_price"> <?php echo $_SESSION["CartPrice"] ?> </p>
    </div>
</div>