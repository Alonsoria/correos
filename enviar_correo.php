<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $remitente = $_POST["remitente"];
    $destinatario = $_POST["destinatario"];
    $asunto = $_POST["asunto"];
    $cuerpo = $_POST["cuerpo"];

    // Verificar si se ha adjuntado un archivo
    $archivo_adjunto = '';
    if(isset($_FILES['adjunto']) && $_FILES['adjunto']['error'] == UPLOAD_ERR_OK) {
        $archivo_adjunto_nombre = $_FILES['adjunto']['name'];
        $archivo_adjunto_tmp = $_FILES['adjunto']['tmp_name'];
        $archivo_adjunto = chunk_split(base64_encode(file_get_contents($archivo_adjunto_tmp)));
    }

    // Cabeceras del correo
    $headers = "From: $remitente\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

    // Cuerpo del correo
    $mensaje = "--boundary\r\n";
    $mensaje .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $mensaje .= "Content-Transfer-Encoding: 7bit\r\n";
    $mensaje .= "\r\n";
    $mensaje .= $cuerpo . "\r\n";

    // Adjuntar archivo si existe
    if(!empty($archivo_adjunto)) {
        $mensaje .= "--boundary\r\n";
        $mensaje .= "Content-Type: application/octet-stream; name=\"$archivo_adjunto_nombre\"\r\n";
        $mensaje .= "Content-Transfer-Encoding: base64\r\n";
        $mensaje .= "Content-Disposition: attachment\r\n";
        $mensaje .= "\r\n";
        $mensaje .= $archivo_adjunto . "\r\n";
    }

    // Enviar correo
    if(mail($destinatario, $asunto, $mensaje, $headers)) {
        echo "El correo ha sido enviado correctamente.";
    } else {
        echo "Error al enviar el correo.";
    }
}
?>