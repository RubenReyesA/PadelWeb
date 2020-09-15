<!--
Vista la cual genera el menu lateral del web site con los datos extraidos de la BD.
-->
<ul class="menu">
    <?php
    foreach ($resultat_categories as $fila){
        $fila["ID"] = htmlentities($fila["ID"], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $fila["Name"] = htmlentities($fila["Name"], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        ?>
         <li> <a class="nav_anchor" title='<?php echo $fila["ID"]?>'> <?php echo $fila["Name"] ?> </a></li>
    <?php } ?>
</ul>


