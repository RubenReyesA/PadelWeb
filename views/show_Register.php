<!--
Vista que muestra el formulario con los datos necesarios para generar un usuario en este web site
 el cual se envia al controlador añadir usuario:
-->
<form class="toCenter" method="post" id="form_register" class="content" action="/controllers/addUserDB.php"
      onsubmit='addUserDB(); return false;'>
<div class="titleprincipal">
    <h1 > Formulario de Registro: </h1>
</div>
<div class="titlesecundario">
    <h3> DATOS PERSONALES: </h3>
</div>
Nombre: <input class="valid" type="text" id="f_Nom" name="f_Nom" placeholder="Por ejemplo: Juan González"
               title="Debe introducir el nombre completo"
               pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ ]*" required><br />

Apellidos: <input class="valid" type="text" id="f_Cognoms" name="f_Cognoms" placeholder="Por ejemplo: Fritz"
               title="Debe introducir el nombre completo"
               pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ ]*" required><br />

Correo Electrónico: <input class="valid" type="text" name="f_Mail" id="f_Mail"
                           pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
                           placeholder="Tu mail habitual (@)" required
                           title="Por favor introduzca correctamente su mail"><br />

Contraseña: <input class="valid" type="password" id="f_Passwd" name="f_Passwd" placeholder="Tu contraseña"
                   title="La contraseña introducida no es válida (de 6 a 12 carácteres)"
                   pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜàèòÀÈÒ0-9]+" minlength="6" maxlength="12" required><br>

<div class="titlesecundario">
    <h3> DIRECCIÓN: </h3>
</div>

País: <?php include_once __DIR__.'/../controllers/list_country.php'; ?>

Provincia:<?php include_once __DIR__.'/../controllers/list_states.php'; ?>

Población: <input class="valid" type="text" id="f_Poblacion" name="f_Poblacion" placeholder="Municipio del domicilio"
                  title="Por favor introduzca el municipio"
                  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜàèòÀÈÒ ]*" required><br>

Dirección Postal: <input class="valid" type="text" id="f_DireccionPostal" name="f_DireccionPostal" placeholder="Calle, Portal, Piso, Nº"
                         title="Por favor introduzca su dirección completa"
                         pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ0-9 ]+" required><br>

Código Postal: <input class="valid" type="text" id="f_CPostal" name="f_CPostal" placeholder="CP del Municipio"
                      title="Por favor introduzca correctamente el código postal (5 dígitos)"
                      pattern="[0-9]+" minlength="5" maxlength="5" required><br>

<div class="titlesecundario">
    <h3> POLÍTICA DE PRIVACIDAD (GDPR): </h3>
</div>

<a href="https://policies.google.com/?hl=es" target="_blank"> Política de Privacidad - Datos Personales (GDPR) - Condiciones de Uso </a><br>
<div>
    <input type="checkbox" name="f_Acepto" required
           title="Por favor acepte los términos y condiciones para continuar"/> Acepto todos los términos y condiciones.<br>
    <br>
</div>

<input class="Button" type="submit" name="f_Submit" value="Confirmar Registro"><br>
</form>