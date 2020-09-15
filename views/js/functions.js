function showLogin() {
    document.getElementById("sub3-1").style.display = "none";
    document.getElementById("sub3-2").style.display = "flex";
}

function changeQuantity(type, page = 0, id = "", lock = false) {

    var tagValue = null;
    var changed = false;

    if (lock) {
        document.getElementById("btn_decrease" + id).disabled = true;
        document.getElementById("btn_increase" + id).disabled = true;
    }

    if (id != "") {
        tagValue = document.getElementById("ProductQuantityValue" + id);

    } else {
        tagValue = document.getElementById("ProductQuantityValue");
        id = document.getElementById("title_product").title;
    }

    var maxStock = -1;

    $.ajax({
        type: "GET",
        url: "../controllers/checkStock.php",
        data: "id=" + id,
        success: function (value) {
            maxStock = parseInt(value);

            if (type == "d") {
                if (tagValue.value != 1) {
                    changed = true;
                    tagValue.value--;
                }
            }

            if (type == "i" && tagValue.value < maxStock) {
                changed = true;
                tagValue.value++;
            }

            if (page == 1) {

                var UnitaryPrice = document.getElementById("UnitaryPriceProduct" + id).textContent;
                UnitaryPrice = UnitaryPrice.replace(",", ".");
                UnitaryPrice = parseFloat(UnitaryPrice.substring(0, UnitaryPrice.length - 2));

                var TotalPrice = formatter.format(UnitaryPrice * parseInt(tagValue.value));

                var cartQuantity = document.getElementById("cart_quantity").textContent;
                var cartPrice = document.getElementById("cart_price").textContent;
                cartPrice = cartPrice.replace(",", ".");
                cartPrice = parseFloat(cartPrice.substring(0, cartPrice.length - 2));

                if (type == "d" && changed) {
                    cartQuantity--;
                    cartPrice = cartPrice - UnitaryPrice;
                }

                if (type == "i" && changed) {
                    cartQuantity++;
                    cartPrice = cartPrice + UnitaryPrice;
                }

                $.ajax({
                    type: "GET",
                    url: "../controllers/carro_item.php",
                    data: "option=1&id=" + id + "&value=" + tagValue.value + "&totalprice=" + TotalPrice +
                        "&cartquantity=" + cartQuantity + "&cartprice=" + formatter.format(cartPrice) +
                        "&type=" + type + "&changed=" + changed,
                    success: function () {
                        document.getElementById("BoldPrice" + id).textContent = TotalPrice;
                        $('header').load("./controllers/show_header.php");

                        document.getElementById("total_quantity").textContent = cartQuantity;
                        document.getElementById("total_price").textContent = formatter.format(cartPrice);

                        document.getElementById("btn_decrease" + id).disabled = false;
                        document.getElementById("btn_increase" + id).disabled = false;
                    }
                });

            }


        }
    });

}

function deleteItem(id) {
    var TotalPrice = document.getElementById("BoldPrice" + id).textContent;
    TotalPrice = TotalPrice.replace(",", ".");
    TotalPrice = parseFloat(TotalPrice.substring(0, TotalPrice.length - 2));

    var Quantity = document.getElementById("ProductQuantityValue" + id).value;
    Quantity = parseInt(Quantity);

    var cartQuantity = document.getElementById("cart_quantity").textContent;
    cartQuantity = parseInt(cartQuantity);
    var cartPrice = document.getElementById("cart_price").textContent;
    cartPrice = cartPrice.replace(",", ".");
    cartPrice = parseFloat(cartPrice.substring(0, cartPrice.length - 2));

    cartQuantity = cartQuantity - Quantity;
    cartPrice = cartPrice - TotalPrice;

    $.ajax({
        type: "GET",
        url: "../controllers/carro_item.php",
        data: "option=2&id=" + id + "&cartquantity=" + cartQuantity + "&cartprice=" + formatter.format(cartPrice),
        success: function () {
            $('#list_products').load("./controllers/show_compra.php");
            $('header').load("./controllers/show_header.php");

        }
    });
}

function deleteCart(opt=true) {
    $.ajax({
        type: "GET",
        url: "../controllers/carro_item.php",
        data: "option=3",
        success: function () {
            $('#list_products').load("./controllers/show_compra.php");
            $('#header').load("./controllers/show_header.php");

            if (opt) {
                alert("Carrito vaciado correctamente!");
            }
            else{
                $('#list_products').load("./controllers/show_confirmationPurchase.php");
            }
        }
    });
}

function changeImage(type) {
    var xmlhttp;

    if (window.XMLHttpRequest) { //tots els navegadors
        xmlhttp = new XMLHttpRequest();
    } else { // IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            var text = (xmlhttp.responseText).split('/%%/');
            var label = document.getElementById("title_product").textContent;
            document.getElementById("image_product").alt = text[0];
            document.getElementById("image_product").src = text[1];
            var click = "openImage('" + text[1] + "','" + label + "');";
            document.getElementById("image_product").setAttribute("onClick", click);
        }
    };

    var tagImageAlt = document.getElementById("image_product").alt;

    xmlhttp.open("GET", "./controllers/list_images.php?PhotoID=" + tagImageAlt + "&type=" + type, true);
    xmlhttp.send();
}

function addUserDB() {
    var xmlhttp;

    if (window.XMLHttpRequest) { //tots els navegadors
        xmlhttp = new XMLHttpRequest();
    } else { // IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            var jsonvar = JSON.parse(xmlhttp.responseText);

            if (jsonvar.found === "false") {
                alert("Se ha producido un error en el registro! Mail ya registrado!! Compruebe también su conexión a Internet.");
                window.location = "../../index.php";
            }
            if (jsonvar.found === "true") {
                $.ajax({
                    type: "POST",
                    url: "/controllers/addUserDB.php",
                    data: "f_Nom=" + document.getElementById("f_Nom").value +
                        "&f_Cognoms=" + document.getElementById("f_Cognoms").value +
                        "&f_Mail=" + document.getElementById("f_Mail").value +
                        "&f_Passwd=" + document.getElementById("f_Passwd").value +
                        "&f_Poblacion=" + document.getElementById("f_Poblacion").value +
                        "&f_DireccionPostal=" + document.getElementById("f_DireccionPostal").value +
                        "&f_Pais=" + document.getElementById("country").value +
                        "&f_Provincia=" + document.getElementById("state").value +
                        "&f_CPostal=" + document.getElementById("f_CPostal").value,
                    dataType: "json",
                    success: function (result) {
                        if (result.code === "success") {
                            alert("Su registro se ha realizado con éxito! Redirigiendo a la página principal...");
                            window.location = "../../index.php";
                        } else if (result.code === "error") {
                            alert(result.msg);
                        }
                    }
                });


            }
        }
    };

    var m_mail = document.getElementById("f_Mail").value;

    xmlhttp.open("GET", "./controllers/checkUserDB.php?f_Mail=" + m_mail, true);
    xmlhttp.send();


}

function finishMailSend() {
    alert("Su mensaje ha sido enviado con éxito. Recibirá una respuesta en un plazo de 24-48h. Gracias por contactar con nosotros!!");
    return true;
}


$(document).ready(function () {

    $(document).on('click', '#imglogo', function () {
        $('#list_products').load("./controllers/show_mainPage.php");
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "block");
    });

    $(document).on('click', '#carrito_compra', function () {
        $('#list_products').load("./controllers/show_compra.php");
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "block");

    });

    $(document).on('click', '#btn_orders', function () {
        $('#list_products').load("./controllers/show_orders.php");
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "block");
    });

    $(document).on('click', '#btn_account', function () {
        $('#list_products').load("./controllers/show_account.php");
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "block");
    });

    $(document).on('click', '#btn_Register', function () {
        $('#list_products').load("./controllers/show_Register.php");
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "none");
    });

    $(document).on('click', '#btn_AtClients', function () {
        $('#list_products').load("./controllers/show_AtClients.php");
        $('#btn_AtClients').css("display", "none");
        $('#btn_Register').css("display", "block");
    });

    $(document.body).on('change', '#country', function () {
        var op = $('#country option:selected').val();
        $('#state').load("./controllers/list_states.php?country=" + op);

    });

    $(document).on('click', '.nav_anchor', function () {
        var op = $(this).attr('title');
        $('#list_products').load("./controllers/list_products.php?category=" + op);
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "block");

    });

    $(document.body).on('click', '.img_product_view', function () {
        var op = $(this).attr('title');
        $('#list_products').load("./controllers/list_details.php?productID=" + op);
        $('#btn_AtClients').css("display", "block");
        $('#btn_Register').css("display", "block");
    });


    $("#search_bar_edit").keyup(function () {
        var text = document.getElementById("search_bar_edit").value;
        if (text !== "") {
            text = text.replace(/ /g, "%20%");
            $('#list_products').load("./controllers/searchBar.php?text=" + text);
        } else {
            $('#list_products').load("/controllers/show_mainPage.php");
        }

    });

});

function openImage(path, title) {
    document.getElementById("myModal").style.display = "block";
    document.getElementById("img01").src = path;
    document.getElementById("caption").innerHTML = title;
}

function span() {

    document.getElementById("myModal").style.display = "none";

}

function addtoCart(quantity, id = null, name = null, price = null, img = null) {

    var actual_Q = parseInt(document.getElementById("cart_quantity").textContent);
    var actual_P = document.getElementById("cart_price").textContent;
    actual_P = actual_P.replace(",", ".");
    actual_P = parseFloat(actual_P.substring(0, actual_P.length - 2));
    var newvalue;
    var quantity_result = 0;
    var actual_RealPrice = 0;
    var nameProduct = "";
    var imgProduct = "";
    var idProduct = "";

    if (quantity != "0") {
        idProduct = id;
        nameProduct = name;
        actual_RealPrice = price;
        imgProduct = img;
        quantity_result = 1;
        actual_RealPrice = parseFloat(actual_RealPrice.substring(0, actual_RealPrice.length - 1));
    } else {
        idProduct = document.getElementById("title_product").title;
        nameProduct = document.getElementById("title_product").textContent;
        imgProduct = document.getElementById("image_product").src;
        quantity_result = parseInt(document.getElementById("ProductQuantityValue").value);
        actual_RealPrice = document.getElementById("RealPrice").textContent;
        actual_RealPrice = parseFloat(actual_RealPrice.substring(0, actual_RealPrice.length - 1));
    }

    newvalue = actual_Q + quantity_result;
    actual_P = actual_P + quantity_result * actual_RealPrice;


    $.ajax({
        type: "GET",
        url: "../controllers/carro_item.php",
        data: "option=0&idProduct=" + idProduct + "&img=" + imgProduct + "&name=" + nameProduct + "&quantity=" + quantity_result +
            "&unitary_price=" + formatter.format(actual_RealPrice) + "&total_price=" +
            formatter.format(quantity_result * actual_RealPrice) + "&cartQuantity=" + newvalue +
            "&cartPrice=" + formatter.format(actual_P),
        success: function (result) {

            if (result != "") {
                result = result.replace(",", ".");
                result = parseFloat(result.substring(0, result.length - 2));
                result += quantity_result * actual_RealPrice;
                $.ajax({
                    type: "GET",
                    url: "../controllers/carro_item.php",
                    data: "option=4&idProduct=" + idProduct + "&total_price=" +
                        formatter.format(result),
                    success: function () {
                    }
                });
            }

            $('#header').load("./controllers/show_header.php");
            $('#list_products').load("./controllers/show_compra.php");
            $('#btn_AtClients').css("display", "block");
            $('#btn_Register').css("display", "block");

            alert("Tu producto <" + nameProduct + "> se ha añadido correctamente a la cesta de la compra.");
        }
    });


}

const formatter = new Intl.NumberFormat('es-ES', {
    style: 'currency',
    currency: 'EUR',
    minimumFractionDigits: 2,
    useGrouping: false
});

function startSession() {

    var mail = document.getElementById("username").value;
    var pass = document.getElementById("userpass").value;

    $.ajax({
        type: "GET",
        url: "../controllers/checkUserDB.php",
        data: "f_Mail=" + mail,
        dataType: "json",
        success: function (result) {
            if (result.found === "true") {
                alert("Mail no registrado en el sistema. Haz click en 'Registrarse' para unirse a PadelTDIW!");
            } else {
                if (result.found === "false") {
                    $.ajax({
                        type: "POST",
                        url: "../controllers/session.php",
                        data: "option=2&mail=" + mail + "&pass=" + pass,
                        dataType: "json",
                        success: function (result) {
                            if (result.found === "true") {
                                alert("Sesión iniciada correctamente!");
                                document.getElementById("form_login").submit();
                                $('#header').load("./controllers/show_header.php");
                            } else {
                                if (result.found === "false") {
                                    alert("Contraseña incorrecta! Reintentelo de nuevo.")
                                }
                            }

                        }
                    });
                }
            }

        }
    });

}

function closeSession() {

    $.ajax({
        type: "GET",
        url: "../controllers/session.php",
        data: "option=1",
        success: function () {
            var nombre = document.getElementById("msgsession").title;
            $('#header').load("./controllers/show_header.php");
            window.location = "./index.php";
            alert("Sesión cerrada con éxito. Nos vemos, " + nombre + "!!");
        }
    });

}


function pay() {
    if (document.getElementById("sub3-3") != null) {
        alert("Redireccionando a PayPal para procesar la compra!");
        $.ajax({
            type: "GET",
            url: "../controllers/addOrderDB.php",
            success: function () {
                deleteCart(false);
                alert("Comprado con éxito!");
            }
        });
    } else {
        alert("Inicia sesión o regístrese en PadelTDIW antes de proceder con la compra!");
    }

}

function activate_edit(id) {

    switch (id) {
        case 1:
            document.getElementById("nombre").disabled = false;
            document.getElementById("account1").hidden = false;
            break;
        case 2:
            document.getElementById("apellidos").disabled = false;
            document.getElementById("account2").hidden = false;
            break;
        case 3:
            document.getElementById("f_Mail").disabled = false;
            document.getElementById("account3").hidden = false;
            break;
        case 4:
            document.getElementById("password").disabled = false;
            document.getElementById("account4").hidden = false;
            break;
        case 5:
            document.getElementById("country").disabled = false;
            document.getElementById("account5").hidden = false;
        case 6:
            document.getElementById("state").disabled = false;
            document.getElementById("account6").hidden = false;
            break;
        case 7:
            document.getElementById("poblacion").disabled = false;
            document.getElementById("account7").hidden = false;
            break;
        case 8:
            document.getElementById("direccion").disabled = false;
            document.getElementById("account8").hidden = false;
            break;
        case 9:
            document.getElementById("cpostal").disabled = false;
            document.getElementById("account9").hidden = false;
            break;
        default:
            alert("OPCIÓN NO VÁLIDA, EXCEPCIÓN");
            break;

    }
}

function edit_data(id) {

    switch (id) {
        case 1:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=1&data=" + document.getElementById("nombre").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("nombre").disabled = true;
                        document.getElementById("account1").hidden = true;
                        alert("Nombre cambiado con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });
            break;
        case 2:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=2&data=" + document.getElementById("apellidos").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("apellidos").disabled = true;
                        document.getElementById("account2").hidden = true;
                        alert("Apellidos cambiados con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });

            break;
        case 3:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=3&data=" + document.getElementById("f_Mail").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("f_Mail").disabled = true;
                        document.getElementById("account3").hidden = true;
                        alert("Correo electrónico cambiado con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });
            break;
        case 4:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=4&data=" + document.getElementById("password").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("password").disabled = true;
                        document.getElementById("account4").hidden = true;
                        alert("Contraseña cambiada con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });
            break;
        case 5:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=5&data=" + document.getElementById("country").options[document.getElementById("country").selectedIndex].text,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("country").disabled = true;
                        document.getElementById("account5").hidden = true;
                        alert("País cambiado con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });

            break;
        case 6:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=6&data=" + document.getElementById("state").options[document.getElementById("state").selectedIndex].text,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("state").disabled = true;
                        document.getElementById("account6").hidden = true;
                        alert("Provincia o Estado cambiado con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });

            break;
        case 7:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=7&data=" + document.getElementById("poblacion").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("poblacion").disabled = true;
                        document.getElementById("account7").hidden = true;
                        alert("Población cambiada con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });

            break;
        case 8:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=8&data=" + document.getElementById("direccion").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("direccion").disabled = true;
                        document.getElementById("account8").hidden = true;
                        alert("Dirección Postal cambiada con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }
                }
            });

            break;
        case 9:
            $.ajax({
                type: "POST",
                url: "/controllers/changePersonalData.php",
                data: "option=9&data=" + document.getElementById("cpostal").value,
                dataType: "json",
                success: function (result) {
                    if (result.code === "success") {
                        document.getElementById("cpostal").disabled = true;
                        document.getElementById("account9").hidden = true;
                        alert("Código Postal cambiado con éxito!");
                    } else if (result.code === "error") {
                        alert(result.msg);
                    }

                }
            });

            break;
        default:
            alert("OPCIÓN NO VÁLIDA, EXCEPCIÓN");
            break;

    }
}

function goMainPage() {
    $('#list_products').load("./controllers/show_mainPage.php");
    $('#btn_AtClients').css("display", "block");
    $('#btn_Register').css("display", "block");
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}


