<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

$consulta = "SELECT
rec.id_receta,
rec.nombre,
rec.imagen,
rec.tipo,
ROUND(AVG(res.calificacion), 2) AS promedio_calificaciones
FROM
recetas rec
LEFT JOIN
reseñas res ON rec.id_receta = res.id_receta
GROUP BY
rec.id_receta, rec.nombre, rec.imagen, rec.tipo
ORDER BY
promedio_calificaciones DESC
LIMIT
10";


$resultado_consulta = $conexion->query($consulta);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SABOR USM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/lechuga.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    



</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="home.php">
                <img src="./assets/img/logo.png" style="max-width: 150px;">
            </a>

            

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
    
                </div>
                <div class="navbar align-self-center d-flex">
                    
                   

                    <a class="nav-icon position-relative text-decoration-none" href="favoritos_usuario.php?seccion=home.php">
                        <i class="fa fa-fw fa-bookmark text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>

                    <a class="nav-icon position-relative text-decoration-none" href="info.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>

					<div> 
						¡BIENVENIDO, <?php echo $_SESSION['nombre'];?>!  
					</div>

					<a class="nav-icon position-relative text-decoration-none">

				
					</a>
                        <div>
							<form action="logout.php" method="post">
          						<input type="submit" value="Cerrar sesión">
       						</form>
						</div>
					<!--  <?php echo $_SESSION['fecha_login']; ?> -->
                </div>
            </div>

        </div>
    </nav>

    <section class="bg-light">
        <div class="container py-5">
        <a href="home.php" class="btn btn-primary">Volver</a>
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">TOP 10 MEJORES RECETAS</h1>
 
            </div>
            
            <div class="row">
                
                <?php
                while($fila = $resultado_consulta -> fetch_assoc()){
                    
                    $id_receta = $fila['id_receta'];
                    $nombre_receta = $fila['nombre'];
                    $imagen_receta = $fila['imagen'];
                    $tipo_receta = $fila['tipo'];
                    $promedio_calificaciones = $fila['promedio_calificaciones'];

                    if($tipo_receta == 1){
                        $tipo_receta = "Entrada";
                    }
                    if($tipo_receta == 2){
                        $tipo_receta = "Fondo";
                    }
                    if($tipo_receta == 3){
                        $tipo_receta = "Postre";
                    }

                    echo'
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100">
                            <a href="detalle_receta.php?id_receta=' . $id_receta . '">
                                <img src=" '. $imagen_receta .' " class="card-img-top" alt="..."">
                            </a>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>';
                                    for($i = 1; $i <= $promedio_calificaciones; $i++){
                                        echo'
                                        <i class="text-warning fa fa-star"></i>';
                                    }
                                    echo'
                                    </li>
                                    <li class="text-muted text-right">' . $tipo_receta . '</li>
                                </ul>
                                <a href="detalle_receta.php?id_receta=' . $id_receta . '" class="h2 text-decoration-none text-dark">' . $nombre_receta . '</a>
                                <p class="card-text">

                                </p>
                                <a href="añadir_favoritos.php?id_receta=' . $id_receta . '"class="btn btn-primary">Guardar en favoritos</a>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>

</body>
</html>