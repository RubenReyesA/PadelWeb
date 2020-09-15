<!--
Vista la cual genera la vista del producto seleccionado y muestra todas las caracteristicas del mismo.
-->
<div class="titleprincipal">
    <?php foreach ($resultat_details as $fila){ ?>

        <h1 id="title_product" title='<?php echo $fila["ID"] ?>'><?php echo $fila["Name"] ?></h1>
    <?php } ?>
</div>

<div id="product_content_detail">

    <div id="ProductDetailsIMG" class="ProductDetails">
        <!-- The Modal -->
        <div id="myModal" class="modal" onclick="span();">
            <span onclick="span();" class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>

        <?php foreach ($resultat_details as $fila){ ?>
            <img onclick="openImage('<?php echo $fila["PathIMG"]; ?>' , '<?php echo $fila["Name"]; ?>');" id='image_product' alt='<?php echo $fila["ID_image"] ?>' src='<?php echo $fila["PathIMG"] ?>' width='1000px' class='responsive200' />
        <?php } ?>

        <div id="buttonLayoutIMG">
            <button onclick="changeImage('back');"> < </button>
            <button onclick="changeImage('next');"> > </button>
        </div>
    </div>
    <div id="ProductDetailsDescription" class="ProductDetails">
        <?php foreach ($resultat_details as $fila){ ?>
            <p><?php echo $fila["Description"] ?></p>
        <?php } ?>
    </div>

    <div id="ProductDetailsPriceTag" class="ProductDetails">
    <?php foreach ($resultat_details as $fila){ ?>
        <?php if($fila["isOffer"]==1){ ?>
            <h4 id='OldPrice'><?php echo $fila["Old_Price"] ?>€</h4>
        <?php } ?>
        <h1 id='RealPrice'><?php echo $fila["Price"] ?>€</h1>
    <?php } ?>
        <div id="ProductQuantity" class="ProductDetails">
            <h4> CANTIDAD: </h4>
            <div id="ButtonsProductQuantity">
                <button onclick="changeQuantity('d');"> - </button> <input type="text" disabled id="ProductQuantityValue" value="1" maxlength="2"> <button onclick="changeQuantity('i');"> + </button>
            </div>
        </div>
        <div id="addtocart" class="ProductDetails">
            <button> <img onclick="addtoCart(0)" src="../img/addtocart.png"/></button>
        </div>
    </div>
</div>

<div id="Reviews" class="content">
    <h2> OPINIONES </h2>