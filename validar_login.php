<?php
// Incluir la conexión a la base de datos
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $pin = $_POST['pin'];

    // Sanitizar los datos para evitar inyecciones SQL
    $nombre = $conn->real_escape_string($nombre);
    $pin = $conn->real_escape_string($pin);

    // Preparar la consulta SQL para verificar los datos
    $sql = "SELECT * FROM usuarios WHERE nombre='$nombre' AND pin='$pin'";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si los datos coinciden, iniciar sesión
        
        
        // Aquí agregamos el código HTML para la página de ayuda
        echo '
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda manejo de aplicaciones</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
            background: linear-gradient(135deg, #009FFA, #34B4FF); /* Fondo degradado vibrante */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-size: cover;
            animation: fadeIn 1.5s ease-in-out; /* Animación de entrada */
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Barra de navegación */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000000;
            padding: 15px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 4px solid #34B4FF; /* Línea decorativa debajo de la barra */
        }

        .navbar a {
            color: #FFFFFF;
            text-decoration: none;
            margin: 0 15px;
            padding: 10px 20px;
            font-size: 1.1em;
            border-radius: 25px;
            background-color: #34B4FF; /* Color azul para el fondo */
            transition: background-color 0.3s, transform 0.3s;
        }

        .navbar a:hover {
            background-color: #009FFA; /* Azul más oscuro para el hover */
            transform: scale(1.05);
        }

        .dropdown {
            position: relative;
        }

        .dropbtn {
            background-color: #34B4FF; /* Azul para el botón */
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1em;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .dropbtn:hover {
            background-color: #009FFA; /* Azul más oscuro para el hover */
            transform: scale(1.05);
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #000000;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1;
            border-radius: 8px;
        }

        .dropdown-content a {
            color: #FFFFFF;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: background-color 0.3s, transform 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #34B4FF; /* Azul brillante para el hover */
            transform: scale(1.05);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                display: block;
                margin: 10px 0;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                border-radius: 0;
                background-color: #000000;
            }
        }

        header {
    background-color: #000000;
    color: #FFFFFF;
    text-align: center;
    padding: 40px 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    border-bottom: 5px solid #34B4FF;
    transition: background-color 0.5s ease;
}

header:hover {
    background-color: #333333;
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px; /* Espacio entre logo y título */
}

.logo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

h1 {
    font-size: 3.5em;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: bold;
    color: #FFFFFF;
    position: relative;
    font-family: "Georgia", serif;
}


        main {
            padding: 40px 20px;
            text-align: center;
            flex: 1;
            animation: fadeInUp 1.5s ease-in-out;
            background: #FFFFFF; /* Fondo blanco */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            margin: 20px;
            position: relative;
            overflow: hidden;
        }

        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        main::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 150, 136, 0.1), rgba(255, 255, 255, 0));
            z-index: 0;
            pointer-events: none;
        }

        main p:first-of-type {
            font-size: 1.5em;
            font-weight: 500;
            margin-bottom: 20px;
            color: #009FFA;
            z-index: 1;
            position: relative;
        }

        main p {
            font-size: 1.2em;
            font-weight: 400;
            color: #000000;
            z-index: 1;
            position: relative;
        }

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 50px;
            gap: 30px;
        }

        .image-container figure {
            text-align: center;
            background-color: #f5f5f5;
            border: 2px solid #34B4FF;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            max-width: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            opacity: 0;
            animation: popIn 1s ease forwards;
        }

        @keyframes popIn {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .image-container figure:hover {
            transform: scale(1.05);
            background-color: #e0f2f1;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .image-container img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        figcaption {
            margin-top: 15px;
            font-size: 1.4em;
            font-weight: bold;
            color: #34B4FF;
            background-color: rgba(52, 180, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        figcaption:hover {
            background-color: rgba(52, 180, 255, 0.3);
        }

        footer {
            background-color: #000000;
            color: #FFFFFF;
            text-align: center;
            padding: 20px 10px;
            width: 100%;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1.5s ease-in-out;
            font-size: 1.2em;
        }

        footer p {
            margin: 0;
        }
        .crud-button {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    font-size: 1em;
    color: #ffffff;
    background-color: #34B4FF;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.crud-button:hover {
    background-color: #009FFA;
    transform: scale(1.05);
}

    </style>
</head>
<body>
    <div class="navbar">
        <a href="HOLA.HTML">Inicio</a>
        <a href="contact.html">Contacto</a>
        <a href="crud.php">Datos</a>
        <div class="dropdown">
            <button class="dropbtn">Otras Páginas</button>
            <div class="dropdown-content">
                <a href="nequi.html">Nequi</a>
                <a href="daviplata.html">DaviPlata</a>
                <a href="bancoalamano.html">Bancolombia</a>
            </div>
        </div>
    </div>

    <header>
        
        <div class="header-container">
            <img class="logo" src="imagenes/logo.png" alt="Logo">   <h1>Ayuda manejo de aplicaciones</h1>
    </header>
    
    <main>
        <p>Bienvenidos a nuestra página de ayuda para el manejo de aplicaciones de pago colombianas, aquí encontrarás ayudas para problemas e inquietudes que surjan al utilizar estas aplicaciones.</p>
        <p>Esta página y conjunto de ayudas están dirigidas a las personas de la tercera edad, personas con dificultades cognitivas o personas que simplemente no entienden el manejo de estas aplicaciones.</p>
        
        <div class="image-container">
            <figure>
                <a href="nequi.html">
                    <img class="nequi-logo" src="https://yt3.googleusercontent.com/PUxdGCPmFuVjuLjCF1si08dWFsjv2xYU9bgstKVMv-8iVm7pjrpL2xMyZksoxGBDTvSojW8y2UM=s900-c-k-c0x00ffffff-no-rj" alt="Nequi">
                </a>
                <figcaption>Nequi</figcaption>
            </figure>
            <figure>
                <a href="daviplata.html">
                    <img class="daviplata-logo" src="https://seeklogo.com/images/D/daviplata-logo-C6804BA51B-seeklogo.com.png" alt="DaviPlata">
                </a>
                <figcaption>DaviPlata</figcaption>
            </figure>
            <figure>
                <a href="bancoalamano.html">
                    <img class="bancolombia-logo" src="https://play-lh.googleusercontent.com/hdDlABmkyl9Xx745ejg4h9VKlEG8eH2r-tXuf3ndYKSJfDjwRfhNscMjM5C6sEQDtA4" alt="Bancolombia">
                </a>
                <figcaption>Bancolombia</figcaption>
            </figure>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 Ayuda manejo de aplicaciones</p>
    </footer>
</body>
</html>




        ';
    } else {
        // Si no hay coincidencias, mostrar un mensaje de error
        echo "Nombre o PIN incorrectos. Por favor, intenta nuevamente.";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
