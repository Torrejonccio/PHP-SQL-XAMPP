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
    $calificacion = $row_resena['calificacion'];
    $comentario = $row_resena['comentario'];
} else {
    echo "Reseña no encontrada.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
</head>
<body>
    <h2>Editar Reseña</h2>
    <form action="proceso_edicion_resena.php" method="post">
        <input type="hidden" name="id_resena" value="<?php echo $id_resena; ?>">
        <label for="calificacion">Calificación:</label>
        <input type="number" name="calificacion" value="<?php echo $calificacion; ?>" required>

        <label for="comentario">Comentario:</label>
        <textarea name="comentario" required><?php echo $comentario; ?></textarea>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
