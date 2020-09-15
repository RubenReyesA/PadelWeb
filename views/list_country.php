<!--
Vista la cual muestra en forma de lista los paises registrados en la base de datos.
-->
<select name="f_Pais" id="country" class="valid" required

<?php

    if(!empty($_SESSION["Account"])){ ?>
    disabled >

    <?php }

    else{ ?>
    >
    <?php } ?>

    <option value='' disabled='disabled'

            <?php
            if(empty($_SESSION["Account"])){ ?>
            selected='true'
            <?php } ?> >Seleccione el país:</option>

    <?php foreach ($resultat_country as $fila){

        if(empty($_SESSION["Account"])){ ?>
            <option value='<?php echo $fila["ID"]?>'> <?php echo $fila["Country"]?> </option>
        <?php }

        else{
            if($fila["Country"]==$resultat_user[0]["Country"]){
                $_SESSION["ID_Country"]=$fila["ID"];
                ?>
                <option value='<?php echo $fila["ID"]?>' selected='true'> <?php echo $fila["Country"]?> </option>
            <?php }
            else{ ?>
                <option value='<?php echo $fila["ID"]?>'> <?php echo $fila["Country"]?> </option>
            <?php }
        }
    }?>
</select><br>
