<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_eliminacion'])) {
  $conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

  if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
  }

  $correo = $_SESSION['correo'];
  $eliminar_cuenta = "DELETE FROM usuarios WHERE correo = '$correo'";

  $resultado = mysqli_query($conexion, $eliminar_cuenta);

  if ($resultado) {
      session_destroy();
      header("Location: index.php");
      exit();
  } else {
      echo 'Error al eliminar la cuenta: ' . $conexion->error;
  }

  $conexion -> close();
}

$id_usuario = $_SESSION['id_usuario'];

$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

$consulta = "SELECT res.calificacion AS calificacion,
                    res.comentario AS comentario,
                    res.fecha AS fecha,
                    rec.nombre AS nombre_receta,
                    rec.imagen AS imagen_receta
              FROM reseñas res
              JOIN recetas rec ON res.id_receta = rec.id_receta
              WHERE res.id_usuario = '$id_usuario'
              ORDER BY res.fecha DESC
            ";

$resultado_consulta = $conexion -> query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="info_assets/css info/info.css">
    <link rel="stylesheet" href="info_assets/css info/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

</head>
<body>
<div class="container">
    <div class="main-body" >
    <a href="home.php" class="btn btn-primary">Volver</a>

				<div>&nbsp</div>
          <div class="row gutters-sm" >
            <div class="col-md-4 mb-3">
              <div class="card" >
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="info_assets/img info/bola.jpg" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                    <div class="mt-3">

                    <script>
                        function confirmarEliminacion() {
                          var confirmacion = confirm("¿Estás seguro de que deseas eliminar tu cuenta?");

                          if(confirmacion){
                           
                            document.getElementById('eliminarForm').submit();
                          }
                        }
                      </script>

                      <h4> <?php echo $_SESSION['nombre']; ?> </h4>  
                      <p class="text-secondary mb-1"> <?php echo $_SESSION['correo']; ?> </p>
                      <p class="text-muted font-size-sm">Última sesión: <?php echo $_SESSION['fecha_login']; ?> </p>
                      <p class="text-muted font-size-sm">Almuerzos disponibles: <?php echo $_SESSION['almuerzos']; ?> </p>

                      <button class="btn btn-primary" onclick="confirmarEliminacion()">Eliminar cuenta</button>

                      <form method="post" id="eliminarForm" style="display: none;">
                          <input type="hidden" name="confirmar_eliminacion" value="1">
                          <button type="submit" class="btn btn-primary">Confirmar Eliminación</button>
                      </form>

                      <a href="edit_info.php" class="btn btn-primary">Editar cuenta</a>
                      </div>              
                    </div>  
                  </div>         
                </div>
                <a href="favoritos_usuario.php?seccion=info.php" class="btn btn-primary" style="background-color: #7BBE60; color: #ffffff;;">Favoritos</a>
              </div>
          </div>    
        </div>
    </div>
<div class="container mt-5 mb-5">
  <div class="row g-2">
    
    <?php

    while($fila = $resultado_consulta -> fetch_assoc()){
      $nombre_receta = $fila['nombre_receta'];
      $imagen_receta = $fila['imagen_receta'];
      $fecha_reseña = $fila['fecha'];
      $comentario_reseña = $fila['comentario'];
      $calif_receta = $fila['calificacion'];

      echo'
      <div class="col-md-4">  
        <div class="card p-3 text-center px-4">   
          <div class="user-image">       
            <img src=" '. $imagen_receta .' " class="rounded-circle" width="100">
            <div class="user-content">
                  
              <h5 class="mb-0">' . $nombre_receta . '</h5>
              <span>' . $fecha_reseña . '</span>
              <p>' . $comentario_reseña . '</p>         

            </div>
            
            <div class="ratings">';
             
            for($i = 1; $i <= $calif_receta; $i++){
              echo'
                <i class="fa fa-star"></i>';  
            }
          echo'
            </div>   
          </div> 
        </div> 
      </div>'; 
    }
    ?>
  </div> 
</div>
</body>
</html>

