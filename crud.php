<?php
// Incluir la conexión a la base de datos
include('db.php');

// Verificar si se ha enviado una acción
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $pin = $_POST['pin'] ?? null;
    $pin_ingresado = $_POST['pin_ingresado'] ?? null;  // Para la validación del PIN
    $nombre = $_POST['nombre'] ?? null;
    $telefono = $_POST['telefono'] ?? null;

    // Validar si el PIN es correcto antes de eliminar
    if (isset($_POST['eliminar']) && $id) {
        // Obtener el PIN de la base de datos
        $sql = "SELECT pin FROM usuarios WHERE id='$id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        if ($user && $user['pin'] == $pin) {
            // Eliminar el usuario si el PIN es correcto
            $sql_delete = "DELETE FROM usuarios WHERE id='$id'";
            $conn->query($sql_delete);
            $mensaje = "Usuario eliminado exitosamente.";
        } else {
            // Si el PIN es incorrecto
            $mensaje = "El PIN no es correcto. No se pudo eliminar el usuario.";
        }
    }

    // Si se hace clic en editar, verificar el PIN antes de mostrar el formulario de edición
    if (isset($_POST['editar']) && $id) {
        // Obtener el PIN de la base de datos
        $sql = "SELECT pin FROM usuarios WHERE id='$id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        if ($user && $user['pin'] == $pin_ingresado) {
            // Mostrar el formulario de edición si el PIN es correcto
            $sql_select = "SELECT * FROM usuarios WHERE id='$id'";
            $result_select = $conn->query($sql_select);
            $usuario = $result_select->fetch_assoc();
        } else {
            // Si el PIN es incorrecto
            $mensaje = "El PIN no es correcto. No se puede editar el usuario.";
        }
    }

    // Actualizar el usuario si el PIN es correcto
    if (isset($_POST['actualizar']) && $id) {
        $sql_update = "UPDATE usuarios SET nombre='$nombre', telefono='$telefono' WHERE id='$id'";
        $conn->query($sql_update);
        $mensaje = "Usuario actualizado exitosamente.";
    }
}

// Obtener todos los registros
$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #34B4FF;
            color: white;
        }

        input[type="submit"] {
            background-color: #34B4FF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #009FFA;
        }

        .mensaje {
            margin-top: 20px;
            padding: 10px;
            background-color: #ffdddd;
            color: red;
            border: 1px solid red;
            border-radius: 4px;
        }

        .mensaje-success {
            background-color: #ddffdd;
            color: green;
            border: 1px solid green;
        }
    </style>
</head>
<body>
    <h1>Administrar Usuarios</h1>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (isset($mensaje)): ?>
        <div class="mensaje <?php echo isset($user['pin']) && $user['pin'] == $pin ? 'mensaje-success' : ''; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['telefono']; ?></td>
                <td>
                    <!-- Botón para mostrar el campo PIN para eliminar -->
                    <form action="crud.php" method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="confirmar_eliminar" value="Eliminar">
                    </form>

                    <!-- Formulario para confirmar la eliminación con PIN -->
                    <?php if (isset($_POST['confirmar_eliminar']) && $_POST['id'] == $row['id']): ?>
                        <form action="crud.php" method="POST" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label for="pin">Ingrese el PIN para eliminar:</label>
                            <input type="number" name="pin" required>
                            <input type="submit" name="eliminar" value="Confirmar Eliminación">
                        </form>
                    <?php endif; ?>

                    <!-- Botón de editar que pide el PIN -->
                    <form action="crud.php" method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="confirmar_editar" value="Editar">
                    </form>

                    <!-- Formulario para confirmar la edición con PIN -->
                    <?php if (isset($_POST['confirmar_editar']) && $_POST['id'] == $row['id']): ?>
                        <form action="crud.php" method="POST" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label for="pin_ingresado">Ingrese el PIN para editar:</label>
                            <input type="number" name="pin_ingresado" required>
                            <input type="submit" name="editar" value="Confirmar Edición">
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </table>

    <!-- Formulario de edición si el PIN es correcto -->
    <?php if (isset($usuario)): ?>
        <h2>Editar Usuario</h2>
        <form action="crud.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" placeholder="Nombre" required>
            <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" placeholder="Teléfono" required>
            <input type="number" name="pin" value="<?php echo $usuario['pin']; ?>" placeholder="PIN" required>
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php endif; ?>
</body>
</html>
