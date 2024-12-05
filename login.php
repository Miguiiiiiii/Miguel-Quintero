<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>
    <style>
        /* Estilos generales del cuerpo */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6e7f80, #c2d1d6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
            flex-direction: column;
        }

        /* Contenedor principal del formulario */
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        /* Contenedor para el logo en forma de círculo */
        .logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Título del formulario */
        h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        /* Estilo de los campos de entrada */
        input[type="text"],
        input[type="number"] {
            width: 90%;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #34B4FF;
            outline: none;
        }

        /* Estilo del botón de envío */
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #34B4FF;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #34B4FF;
        }

        /* Estilo para la zona de olvido de contraseña o enlaces adicionales */
        .forgot-password {
            margin-top: 20px;
            font-size: 14px;
        }

        .forgot-password a {
            color: #34B4FF;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="imagenes/logo.png" alt="Logo"> <!-- Reemplaza con la ruta de tu imagen -->
    </div>
    <div class="login-container">
        <h2>Inicia Sesion</h2>
        <form action="validar_login.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="number" name="pin" placeholder="PIN" required><br>
            <input type="submit" value="Iniciar sesión">
        </form>
        <div class="forgot-password">
            <p><a href="index.php">¿No estas registrado? Registrate</a></p>
        </div>
    </div>
</body>
</html>
