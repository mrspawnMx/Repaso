<?php
session_start();
include("cone.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password_ingresada = $_POST['password'];
    $stmt = $conexion->prepare(
        "SELECT id, nombre, password
        FROM usuarios
        WHERE nombre = ?"
    );
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        // Verificar contraseña
        if (
            password_verify(
                $password_ingresada,
                $usuario['password']
            )
        ) {
            $_SESSION['Usuario_id'] = $usuario['id'];
            $_SESSION['Usuario_nombre'] = $usuario['nombre'];

            echo "¡Inicio de sesión exitoso! Bienvenido, "
                . htmlspecialchars($usuario['nombre']);

        } else {

            echo "Contraseña incorrecta.";
        }
    } else {

        echo "El usuario no existe.";
    }
    $stmt->close();
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="banner-container">
        <img src="Imagen/umby.webp" alt="Imagen de inicio de sesión">
    </div>
    <form action="login.php" method="POST">
    <form action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <label for="nombre">
            Nombre de Usuario:
        </label>
        <br>

        <input
            type="text"
            id="nombre"
            name="nombre"
            required>
        <br><br>
        <label for="password">
            Contraseña:
        </label>
        <br>

        <input
            type="password"
            id="password"
            name="password"
            required>
        <br><br>
        <button type="submit">
            Ingresar
        </button>
        <br><br>
        <a href="registro.php">
            ¿No tienes cuenta? Regístrate aquí
        </a>
    </form>
</body>
</html>