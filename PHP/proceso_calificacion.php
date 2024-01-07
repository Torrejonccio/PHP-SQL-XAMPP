<?php
session_start();

$id_usuario = $_SESSION['id_usuario'];
$id_receta = $_POST['id_receta'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_receta = $_POST['id_receta'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $fecha = date("Y-m-d H:i:s");

    if (empty($calificacion)) {
        echo "Por favor, proporcione una calificación antes de agregar un comentario.";
    } else {
        $conexion = mysqli_connect("localhost", "root", "", "sabor_usm");
        $consulta_insertar = "INSERT INTO reseñas (id_receta, id_usuario, calificacion, comentario, fecha) 
                             VALUES ('$id_receta', '$id_usuario', '$calificacion', '$comentario', '$fecha')";
        
        $resultado_insertar = $conexion->query($consulta_insertar);

        if ($resultado_insertar) {
            echo "¡Calificación y reseña agregadas con éxito!";
        } else {
            echo "Error al agregar la calificación y reseña: " . $conexion->error;
        }

        $conexion->close();
    }
} else {
    echo "Acceso no permitido.";
}

header("location: home.php");
?>


