<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); 
    exit();
}

$id_resena = $_GET['id_resena'];

$consulta_resena = "SELECT * FROM reseñas WHERE id_reseña = $id_resena";
$resultado_resena = $conexion->query($consulta_resena);

if ($resultado_resena->num_rows > 0) {
    $row_resena = $resultado_resena->fetch_assoc();
    $id_autor_resena = $row_resena['id_usuario'];

    $id_usuario_actual = $_SESSION['id_usuario'];

    if ($id_autor_resena == $id_usuario_actual) {
        $consulta_eliminar_resena = "DELETE FROM reseñas WHERE id_reseña = $id_resena";
        $resultado_eliminar_resena = $conexion->query($consulta_eliminar_resena);

        if ($resultado_eliminar_resena) {
            echo "Reseña eliminada con éxito.";
        } else {
            echo "Error al eliminar la reseña: " . $conexion->error;
        }
    } else {
        echo "No tienes permisos para eliminar esta reseña.";
    }
} else {
    echo "Reseña no encontrada.";
    exit();
}

header("Location: detalle_receta.php?id_receta={$row_resena['id_receta']}");
?>
