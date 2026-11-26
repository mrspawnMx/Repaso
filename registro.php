<?php
include("cone.php");

// Procesar cuando el formulario envia por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];

    // Se encripta la contraseña
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Consulta preparada
    $stmt = $conexion->prepare(
        "INSERT INTO usuarios
        (nombre, apellido_paterno, apellido_materno, password)
        VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssss",
        $nombre,
        $apellido_paterno,
        $apellido_materno,
        $password
    );

    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error al registrar: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <form action="registro.php" method="POST">

        <h2>Formulario de Registro</h2>

        <label for="nombre">Nombre:</label><br>
        <input
            type="text"
            id="nombre"
            name="nombre"
            required
        >
        <br><br>

        <label for="apellido_paterno">
            Apellido Paterno:
        </label><br>

        <input
            type="text"
            id="apellido_paterno"
            name="apellido_paterno"
            required
        >
        <br><br>

        <label for="apellido_materno">
            Apellido Materno:
        </label><br>

        <input
            type="text"
            id="apellido_materno"
            name="apellido_materno"
            required
        >
        <br><br>

        <label for="password">
            Contraseña:
        </label><br>

        <input
            type="password"
            id="password"
            name="password"
            required
        >
        <br><br>

        <button type="submit">
            Registrar
        </button>

    </form>

</body>
</html>
