<?php

// Modelo el cual genera el correo de la incidencia con la incidencia que han escrito los usuarios del web
// site registrados y sin registrar.

$correo_destinatario = "segui09516@gmail.com";
$nombre_remitente = "Incidencia-PadelTDIW";
$correo_remitente = "contacto@PadelTDIW.uab.cat";
$asunto = "Incidencia PadelTDIW // " . $_POST["f_Mail"] . " // " . $_POST["f_Nom"];
$mensaje = $_POST["f_Incidencia"];

/* Hacemos uso de mb_encode_mimeheader para codificar correctamente caracteres especiales */
$headers = 'From: "' . mb_encode_mimeheader($nombre_remitente) . '" <' . $correo_remitente . ">\r\n"
    . 'Reply-To: ' . $correo_remitente . "\r\n"
    . 'X-Mailer: PHP/' . phpversion() . "\r\n";

    function mailutf8(
        $correo_destinatario,
        $asunto = "(Sin Asunto)",
        $mensaje = "",
        $header = ""
    )
    {
        /* Estas son las cabeceras básicas para el envío de UTF-8 usando codificación de 8 bits */
        $header_on = "MIME-Version: 1.0\r\nContent-type: text/html; charset=\"UTF-8\"\r\nContent-Transfer-Encoding: 8bit\r\n";
        return mail(
            $correo_destinatario,
            mb_encode_mimeheader($asunto),
            $mensaje,
            $header_on . $header
        );
    }

    /* Enviamos el correo y mostramos un mensaje dependiendo de la salida de la función mail */
    mailutf8($correo_destinatario, $asunto, $mensaje, $headers);

    header("Location: ../index.php");

?>