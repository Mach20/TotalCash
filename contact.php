<?php
header('Content-Type: application/json');

if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array("message" => "Error: Datos del formulario incompletos o inválidos."));
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "maurizava34@gmail.com"; // Cambia esto al correo al que deseas enviar el mensaje
$subject = "$m_subject: $name";
$body = "Has recibido un nuevo mensaje desde el formulario de contacto de tu sitio web.\n\n" .
    "Detalles:\n\nNombre: $name\n\nEmail: $email\n\nAsunto: $m_subject\n\nMensaje: $message";
$header = "From: $email";
$header .= "Reply-To: $email";

if (mail($to, $subject, $body, $header)) {
    echo json_encode(array("message" => "Mensaje enviado correctamente"));
} else {
    http_response_code(500);
    echo json_encode(array("message" => "Error al enviar el mensaje"));
}
?>
