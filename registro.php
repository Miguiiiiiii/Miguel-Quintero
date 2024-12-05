<?php
// Incluir la conexión a la base de datos
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $pin = $_POST['pin'];

    // Sanitizar los datos para evitar inyecciones SQL
    $nombre = $conn->real_escape_string($nombre);
    $telefono = $conn->real_escape_string($telefono);
    $pin = $conn->real_escape_string($pin);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (nombre, telefono, pin) VALUES ('$nombre', '$telefono', '$pin')";

    // Ejecutar la consulta y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>






