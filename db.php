<?php
$servername = "localhost";
$username = "root"; // Usuario por defecto en XAMPP
$dbname = "dbmap"; // El nombre de tu base de datos
$password = "";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
?>
