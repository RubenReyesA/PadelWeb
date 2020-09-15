<!--
Vista que genera el listado de opiniones de un producto en concreto:
-->
    <?php foreach($resultat_reviews as $fila){ ?>

        <div class='comment'>
        <img src="../img/User_Icon.png">
        <p><?php echo $fila["Text_Review"] ?></p>
        </div>

    <?php } ?>

</div>
