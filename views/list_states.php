<!--
Vista la cual muestra las ciudades del pais que ha seleccionado el usuario o por defecto las ciudades de España.
-->
<select name="f_Provincia" id="state" class="valid" required

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
        <?php } ?> >Seleccione una provincia/estado:</option>

    <?php foreach ($resultat_state as $fila){

        if(empty($_SESSION["Account"])){ ?>
            <option value='<?php echo $fila["ID"]?>'> <?php echo $fila["State"]?> </option>
        <?php }

        else{
            if($fila["State"]===$resultat_user[0]["State"]){ ?>

                <option value='<?php echo $fila["ID"]?>' selected='true'> <?php echo $fila["State"]?> </option>
            <?php }
            else{ ?>
                <option value='<?php echo $fila["ID"]?>'> <?php echo $fila["State"]?> </option>
            <?php }
        }
    }?>
</select><br>