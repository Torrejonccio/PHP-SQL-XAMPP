<?php
session_start();
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
<a href="home.php" class="btn btn-primary">Volver</a>

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
                </div>
            </div>

        </div>
        
    </nav>


</body>
</html>