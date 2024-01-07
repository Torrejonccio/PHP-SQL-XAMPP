<?php
session_start();
$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resena = $_POST['id_resena'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    $id_usuario_actual = $_SESSION['id_usuario'];
    $consulta_validar_autor = "SELECT id_usuario FROM reseñas WHERE id_reseña = $id_resena";
    $resultado_validar_autor = $conexion->query($consulta_validar_autor);

    if ($resultado_validar_autor->num_rows > 0) {
        $row_resena = $resultado_validar_autor->fetch_assoc();
        $id_autor_resena = $row_resena['id_usuario'];

        if ($id_autor_resena == $id_usuario_actual) {
            $consulta_actualizar_resena = "UPDATE reseñas SET calificacion = '$calificacion', comentario = '$comentario' WHERE id_reseña = $id_resena";
            $resultado_actualizar_resena = $conexion->query($consulta_actualizar_resena);

            if ($resultado_actualizar_resena) {
                echo "Reseña actualizada con éxito.";
            } else {
                echo "Error al actualizar la reseña: " . $conexion->error;
            }
        } else {
            echo "No tienes permisos para editar esta reseña.";
        }
    } else {
        echo "Reseña no encontrada.";
    }
} else {
    echo "Acceso no permitido.";
}

$consulta_id_receta = "SELECT id_receta FROM reseñas WHERE id_reseña = $id_resena";
$resultado_id_receta = $conexion -> query($consulta_id_receta);

$id_receta = $resultado_id_receta -> fetch_assoc()['id_receta'];

header("Location: detalle_receta.php?id_receta=$id_receta");
?>
