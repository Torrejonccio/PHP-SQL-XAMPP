<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filtro_nombre_ingrediente = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
    $filtro_tipo = isset($_POST['filtro_tipo']) ? $_POST['filtro_tipo'] : '';
    $filtro_veganos = isset($_POST['filtro_veganos']) ? "AND rec.vegano = 1" : '';
    $filtro_celiacos = isset($_POST['filtro_celiacos']) ? "AND rec.tiene_gluten = 1" : '';
    $filtro_diabeticos = isset($_POST['filtro_diabeticos']) ? "AND rec.apt_diabeticos = 1" : '';
    $filtro_lactosa = isset($_POST['filtro_lactosa']) ? "AND rec.apt_intolerantes = 1" : '';

  
    if (!empty($filtro_nombre_ingrediente)) {
        $consulta = "SELECT rec.nombre AS nombre,
                    rec.id_receta AS id_receta,
                    rec.imagen AS imagen,
                    rec.tipo AS tipo,
                    ROUND(AVG(res.calificacion)) AS promedio_calificaciones
                    FROM recetas rec
                    LEFT JOIN reseñas res ON rec.id_receta = res.id_receta
                    LEFT JOIN recetas_ingredientes ri ON rec.id_receta = ri.id_receta
                    LEFT JOIN ingredientes ing ON ri.id_ingrediente = ing.id_ingrediente
                    WHERE (rec.nombre LIKE '%$filtro_nombre_ingrediente%' OR ing.nombre_ing LIKE '%$filtro_nombre_ingrediente%')
                    GROUP BY rec.id_receta, rec.nombre, rec.imagen, rec.tipo";
    } elseif (!empty($filtro_tipo)) {
        $consulta = "SELECT rec.nombre AS nombre, 
                    rec.id_receta AS id_receta,
                    rec.imagen AS imagen,
                    rec.tipo AS tipo,
                    ROUND(AVG(res.calificacion)) AS promedio_calificaciones
                    FROM recetas rec
                    LEFT JOIN reseñas res ON rec.id_receta = res.id_receta
                    WHERE rec.tipo = $filtro_tipo
                    GROUP BY rec.id_receta, rec.nombre, rec.imagen, rec.tipo";
    }
    else {

        $consulta = "SELECT rec.nombre AS nombre, 
                    rec.id_receta AS id_receta,
                    rec.imagen AS imagen,
                    rec.tipo AS tipo,
                    ROUND(AVG(res.calificacion)) AS promedio_calificaciones
                    FROM recetas rec
                    LEFT JOIN reseñas res ON rec.id_receta = res.id_receta
                    WHERE 1=1
                    $filtro_veganos
                    $filtro_celiacos
                    $filtro_diabeticos
                    $filtro_lactosa
                    GROUP BY rec.id_receta, rec.nombre, rec.imagen, rec.tipo";
    }
} else {

    $consulta = "SELECT rec.nombre AS nombre,
                rec.id_receta AS id_receta, 
                rec.imagen AS imagen,
                rec.tipo AS tipo,
                ROUND(AVG(res.calificacion)) AS promedio_calificaciones
                FROM recetas rec
                LEFT JOIN reseñas res ON rec.id_receta = res.id_receta
                GROUP BY rec.id_receta, rec.nombre, rec.imagen, rec.tipo";
}

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
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="mejores_recetas.php">Top 10 mejores recetas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="peores_recetas.php">Top 10 peores recetas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="votacion_semanal.php">Votación semanal</a>
                        </li>           
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    </div>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">

                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>

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
                    </div>
            </div>

        </div>
    </nav>
    

    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="busqueda" placeholder="Ingresar por nombre o ingrediente:">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                    <select name="filtro_tipo">
                        <option value="">Todos los tipos</option>
                        <option value="1">Entrada</option>
                        <option value="2">Fondo</option>
                        <option value="3">Postre</option>
                    </select>

                    <label><input type="checkbox" name="filtro_veganos"> Apto para veganos</label>
                    <label><input type="checkbox" name="filtro_celiacos"> No apto para celíacos</label>
                    <label><input type="checkbox" name="filtro_lactosa"> Apto para intolerantes a la lactosa</label>
                    <label><input type="checkbox" name="filtro_diabeticos"> Apto para diabéticos</label>
                </div>
            </form>
        </div>
    </div>






    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">RECETAS</h1>
                    <div id="mensajeTemporal">
                        <?php
                        if (isset($_GET['mensaje'])) {
                            echo $_GET['mensaje'];
                        }
                        ?>
                     </div>
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




    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>

