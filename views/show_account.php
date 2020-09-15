<!--
Vista la cual muestra todos los datos del usuario y permite la edición de estos:
-->
<div class="titleprincipal">
    <h1> Mi cuenta: </h1>
</div>

<div id="superior_details">
    <div id="img_and_mainData">
        <div id="img_profile">
            <img src="<?php echo $_SESSION["imgPathProfile"] ?>"/>
            <form class="account_column" action="/controllers/changeImageProfile.php?id=<?php echo $_SESSION["IDProfile"] ?>" enctype="multipart/form-data" method="post">
                <input id="imagen" name="imagen" size="30" type="file">
                <input id="submit_account_image" type="submit" value="Cambiar Imagen">
            </form>

        </div>
        <div id="main_data">
            <div class="titlesecundario">
                <h3> Datos principales: </h3>
            </div>
            <div id="data1">
                Nombre:
                <div class="account_row">
                    <form class="account_row" action="/controllers/changePersonalData.php?option=1" method="post"
                          onsubmit='edit_data(1); return false;'>
                        <input id="nombre" class="valid" type="text" name="f_Nom"
                               placeholder="Por ejemplo: Juan González"
                               title="Debe introducir el nombre completo"
                               value="<?php echo $resultat_user[0]["Name"] ?>"
                               disabled
                               pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ ]*" required><br/>
                        <button type=button onclick="activate_edit(1);"> Editar</button>
                        <button type=submit id="account1" hidden> Guardar Cambios</button>
                    </form>
                </div>

                Apellidos:
                <div class="account_row">
                    <form class="account_row" action="/controllers/changePersonalData.php?option=2" method="post"
                          onsubmit='edit_data(2); return false;'>
                        <input id="apellidos" class="valid" type="text" name="f_Cognoms"
                               placeholder="Por ejemplo: Fritz"
                               title="Debe introducir el nombre completo"
                               value="<?php echo $resultat_user[0]["Surnames"] ?>"
                               pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ ]*" required disabled><br/>
                        <button type=button onclick="activate_edit(2);"> Editar</button>
                        <button type=submit id="account2" hidden> Guardar Cambios</button>
                    </form>
                </div>

                Correo Electrónico:
                <div class="account_row">
                    <form class="account_row" action="/controllers/changePersonalData.php?option=3" method="post"
                          onsubmit='edit_data(3); return false;'>
                        <input class="valid" type="text" name="f_Mail" id="f_Mail" disabled
                               pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
                               value="<?php echo $resultat_user[0]["Mail"] ?>"
                               placeholder="Tu mail habitual (@)" required
                               title="Por favor introduzca correctamente su mail"><br/>
                        <button type=button onclick="activate_edit(3);"> Editar</button>
                        <button type=submit id="account3" hidden> Guardar Cambios</button>
                    </form>
                </div>
                Contraseña:
                <div class="account_row">
                    <form class="account_row" action="/controllers/changePersonalData.php?option=4" method="post"
                          onsubmit='edit_data(4); return false;'>
                        <input id="password" class="valid" type="password" name="f_Passwd" placeholder="Tu contraseña"
                               title="La contraseña introducida no es válida (de 6 a 12 carácteres)"
                               value="123123" disabled
                               pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜàèòÀÈÒ0-9]+" minlength="6" maxlength="12" required><br>
                        <button type=button onclick="activate_edit(4);"> Editar</button>
                        <button type=submit id="account4" hidden> Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="data2">
        <div class="titlesecundario">
            <h3> Datos secundarios: </h3>
        </div>

        País:
        <div class="account_row">
            <form class="account_row" action="/controllers/changePersonalData.php?option=5" method="post"
                  onsubmit='edit_data(5); return false;'>
                <?php
                $_SESSION["Account"] = true;
                include_once __DIR__ . '/../controllers/list_country.php'; ?>
                <button type=button onclick="activate_edit(5);"> Editar</button>
                <button type=submit id="account5" hidden> Guardar Cambios</button>
            </form>
        </div>

        Provincia:
        <div class="account_row">
            <form class="account_row" action="/controllers/changePersonalData.php?option=6" method="post"
                  onsubmit='edit_data(6); return false;'>
                <?php include_once __DIR__ . '/../controllers/list_states.php'; ?>
                <button type=button onclick="activate_edit(6);"> Editar</button>
                <button type=submit id="account6" hidden> Guardar Cambios</button>
            </form>
        </div>

        Población:
        <div class="account_row">
            <form class="account_row" action="/controllers/changePersonalData.php?option=7" method="post"
                  onsubmit='edit_data(7); return false;'>
                <input id="poblacion" class="valid" type="text" name="f_Poblacion" placeholder="Municipio del domicilio"
                       title="Por favor introduzca el municipio" disabled
                       value="<?php echo $resultat_user[0]["Town"] ?>"
                       pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜàèòÀÈÒ ]*" required><br>
                <button type=button onclick="activate_edit(7);"> Editar</button>
                <button type=submit id="account7" hidden> Guardar Cambios</button>
            </form>
        </div>

        Dirección Postal:
        <div class="account_row">
            <form class="account_row" action="/controllers/changePersonalData.php?option=8" method="post"
                  onsubmit='edit_data(8); return false;'>
                <input id="direccion" class="valid" type="text" name="f_DireccionPostal"
                       placeholder="Calle, Portal, Piso, Nº"
                       title="Por favor introduzca su dirección completa" disabled
                       value="<?php echo $resultat_user[0]["Address"] ?>"
                       pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ0-9 ]+" required><br>
                <button type=button onclick="activate_edit(8);"> Editar</button>
                <button type=submit id="account8" hidden> Guardar Cambios</button>
            </form>
        </div>

        Código Postal:
        <div class="account_row">
            <form class="account_row" action="/controllers/changePersonalData.php?option=9" method="post"
                  onsubmit='edit_data(9); return false;'>
                <input id="cpostal" class="valid" type="text" name="f_CPostal" placeholder="CP del Municipio"
                       value="<?php echo $resultat_user[0]["ZIP"] ?>"
                       title="Por favor introduzca correctamente el código postal (5 dígitos)" disabled
                       pattern="[0-9]+" minlength="5" maxlength="5" required><br>
                <button type=button onclick="activate_edit(9);"> Editar</button>
                <button type=submit id="account9" hidden> Guardar Cambios</button>
            </form>
        </div>

    </div>
</div>