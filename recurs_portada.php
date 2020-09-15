<!--
Archivo html el cual crea la pagina principal y llama a los recursos necesarios para construir
la paguina principal de la web.
-->
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>PadelTDIW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="views/css/style.css"/>
    <link rel="icon" type="image/png" href="../img/Logo_only.png">
    <script type="text/javascript" src="views/js/jquery-3.4.1.min.js"></script>
    <script src="views/js/functions.js"></script>
</head>

<body>
<div class="device_portrait">
    <p> ROTA EL TELÉFONO (HORIZONTAL) </p>
    <img src="./img/devicerotate.png"/>
</div>
<div class="container_general">
    <header id="header">
        <?php require_once __DIR__ . '/controllers/show_header.php'; ?>
    </header>

    <div class="information">

        <nav id="nav">
            <?php require_once __DIR__ . '/controllers/list_categories.php'; ?>
        </nav>

        <div id="list_products" class="content">
            <?php require_once __DIR__ . '/controllers/show_mainPage.php'; ?>
        </div>
    </div>

    <footer class="footer_css">
        <?php require_once __DIR__ . '/controllers/show_footer.php'; ?>
    </footer>
</div>
</body>
</html>