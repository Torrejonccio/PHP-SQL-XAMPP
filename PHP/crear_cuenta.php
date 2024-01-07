<?php

session_start();

$seccionOrigen = isset($_GET['seccion']) ? $_GET['seccion'] : '';


$enlaceVolver = "$seccionOrigen";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="info_assets/css info/info.css">
    <link rel="stylesheet" href="info_assets/css info/bootstrap.min.css">

  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>
<body>
<div class="container">
	
		<div class="main-body">
			<div style="width: 1600px;" class="row">
				<div class="col-lg-8">
				<a href="<?php echo $enlaceVolver; ?>" class="btn btn-primary">Volver</a>
				<div>&nbsp</div>
					<div class="card">
						<form method="post" action="procesar_crea.php">
							<div class="card-body">
								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Nombre</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" class="form-control" name="nombre">
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Correo</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" class="form-control" name="correo">
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-3">
										<h6 class="mb-0">Contraseña</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<input type="text" class="form-control" name="contraseña">
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9 text-secondary">
										<input type="submit" class="btn btn-primary px-4" value="Crear usuario">
									</div>
								</div>
							</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>


</body>
</html>