<?php

session_start();
$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $crear_datos = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$contraseña')";

    $resultado = mysqli_query($conexion, $crear_datos);

    if ($resultado) {
        header("location: index.php");
    } else {
        echo "Error al crear el usuario: " . $conexion->error;
    }

    $conexion->close();
}


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$consulta_temp = "SELECT * FROM user_message_temp";

$resultado_temp = mysqli_query($conexion, $consulta_temp);

if ($row_temp = mysqli_fetch_assoc($resultado_temp)) {
    echo $row_temp['message'];
    header("location: " . $row_temp['redirect_page']);

    $borrar_temp = "DELETE FROM user_message_temp";
    mysqli_query($conexion, $borrar_temp);
}

$conexion->close();
?>
