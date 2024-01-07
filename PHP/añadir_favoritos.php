<?php
session_start();

$id_receta = $_GET['id_receta'];
$id_usuario = $_SESSION['id_usuario'];

$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

$consulta = "CALL AgregarRecetaFavorita($id_usuario, $id_receta); SELECT @mensaje AS mensaje;";
$resultado = $conexion->multi_query($consulta);

$conexion->next_result(); 
$mensaje = $conexion->store_result()->fetch_assoc()['mensaje'];

echo $mensaje;

header("Location: home.php?mensaje=" . urlencode($mensaje));
exit();

$conexion->close();
?>


