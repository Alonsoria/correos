<?php
$servername = "localhost";
$username = "root";
$dbname = "db_test";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asistencia = isset($_POST['asistencia']) ? $_POST['asistencia'] : "";
    $num_personas = isset($_POST["num_personas"]) ? $_POST["num_personas"] : "";
    $nom_personas = isset($_POST["nom_personas"]) ? $_POST["nom_personas"] : "";
    $dedicatoria = isset($_POST["dedicatoria"]) ? $_POST["dedicatoria"] : "";
    
    // Verificar si el campo 'num_personas' está vacío
    if ($num_personas === "") {
        $num_personas = ""; 
    }
    if ($nom_personas === "") {
        $nom_personas = ""; 
    }
}

/*$destino = 'ihconsulting12@gmail.com'; // Cambia esto por tu dirección de correo electrónico
$asunto = 'Nuevo mensaje de formulario de contacto';

// Construir el cuerpo del correo electrónico
$cuerpo = '
    <html>
    <head> 
    <title> Prueba de email <title>
    </head>
    <body> 
    <h1> '.$asistencia.''.$num_personas.''.$nom_personas.''.$dedicatoria.' <h1>
    </body> 
';

if (mail($destino, $asunto, $cuerpo)) {
    echo "¡El mensaje ha sido enviado correctamente!";
} else {
    echo "Hubo un error al enviar el mensaje.";
}*/

$sqlquery = "INSERT INTO fiesta_15anios (confirmacion, num_personas, nombre_personas, dedicatoria)
VALUES ('$asistencia', '$num_personas', '$nom_personas', '$dedicatoria')";
    
if ($conn->query($sqlquery) === TRUE) {
    echo "Se ha enviado tu respuesta <a href='index.html'>volver</a>";
} else {
    echo "Ha ocurrido un error inesperado";
}
?>
