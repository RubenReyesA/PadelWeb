<!--
Vista que muestra el formulario para que reporten cualquier incidencia o duda que tengan los clientes del web site:
-->
<form class="toCenter" method="post" id="form_register" class="content" action="./controllers/sendMailContact.php" onsubmit="finishMailSend();">
    <div class="titleprincipal">
        <h1 > Formulario de Incidencia: </h1>
    </div>
    <div class="titlesecundario">
        <h3> DATOS PERSONALES: </h3>
    </div>

    Nombre Completo: <input class="valid" type="text" name="f_Nom" placeholder="Por ejemplo: Juan González"
                            title="Debe introducir el nombre completo"
                            pattern="[a-zA-ZñÑáéíóúàèòÀÈÒÁÉÍÓÚüÜ ]*" required><br />

    Correo Electrónico: <input class="valid" type="email" name="f_Mail" id="f_Mail" placeholder="Tu mail (@)"
                               required title="Por favor introduzca correctamente su mail"><br />

    <div class="titlesecundario">
        <h3> INFORMACIÓN DE LA INCIDENCIA: </h3>
    </div>

    <input class="valid" type="text" name="f_Incidencia" required placeholder="Redacte su incidencia"
           title="Por favor introduzca su incidencia"><br>

    <input class="Button" type="submit" name="f_Submit" value="Confirmar Incidencia"><br>
</form>