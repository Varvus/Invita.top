<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $evento = htmlspecialchars(trim($_POST['evento']));
    $correo = htmlspecialchars(trim($_POST['correo']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $detalles = htmlspecialchars(trim($_POST['detalles']));

    // Validar el correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Configurar destinatario y asunto
    $destinatario = "contacto@invita.top"; // Cambia esto por tu dirección de correo
    $asunto = "Nuevo mensaje de contacto";

    // Mensaje
    $mensaje = "Nombre: $nombre\n";
    $mensaje .= "Tipo de Evento: $evento\n";
    $mensaje .= "Correo: $correo\n";
    $mensaje .= "Teléfono: $telefono\n";
    $mensaje .= "Detalles: $detalles\n";

    // Cabeceras del correo
    $headers = "From: $nombre <$correo>" . "\r\n" .
               "Reply-To: $correo" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Enviar el correo
    if (mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje. Inténtalo de nuevo más tarde.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
