<?php
session_start();

$id_receta = $_GET['id_receta'];
$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

$consulta_receta = "SELECT * FROM recetas WHERE id_receta = $id_receta";
$resultado_consulta = $conexion->query($consulta_receta);

$fila = $resultado_consulta->fetch_assoc();

$nombre_receta = $fila['nombre'];
$imagen = $fila['imagen'];
$tipo = $fila['tipo'];
$tiempo_prep = $fila['tiempo_prep'];
$instrucciones = $fila['instrucciones'];
$apt_diabeticos = $fila['apt_diabeticos'];
$apt_intolerantes = $fila['apt_intolerantes'];
$tiene_gluten = $fila['tiene_gluten'];
$vegano = $fila['vegano'];

$tipos_receta = ["", "Entrada", "Fondo", "Postre"];
$tipo = $tipos_receta[$tipo];

function obtenerIcono($valor) {
    return ($valor == 1) ? 'fas fa-check' : 'fas fa-times';
}

$consulta_ingredientes = "
    SELECT i.nombre_ing AS nombre_ingrediente, ri.cantidad
    FROM recetas_ingredientes ri
    JOIN ingredientes i ON ri.id_ingrediente = i.id_ingrediente
    WHERE ri.id_receta = $id_receta
";

$resultado_ingredientes = $conexion->query($consulta_ingredientes);

$consulta_reseñas = "SELECT * FROM reseñas WHERE id_receta = $id_receta";
$resultado_reseñas = $conexion->query($consulta_reseñas);


?>





<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?php echo $nombre_receta; ?></title>
	<link rel="stylesheet" type="text/css" href="css/detalle_rec.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
</head>
<body>
    <div class="col-lg-8">
        <a href="home.php" class="btn btn-primary">Volver</a>
        <div>&nbsp;</div>
        <div class="recipe-card">
            <aside>
                <img src="<?php echo $imagen; ?>" alt="" style="width: 496px; height: auto;"/>
       
            </aside>
            <article>
                <h2><?php echo $nombre_receta; ?></h2>
                <h3><?php echo $tipo; ?></h3>
                <ul>
                    <li><span class="icon"><i class="fas fa-clock"></i></span><span><?php echo $tiempo_prep; ?> min</span></li>
                    <li><span class="icon"><i class="<?php echo obtenerIcono($vegano); ?>"></i></span><span>Vegano</span></li>
                    <li><span class="icon"><i class="<?php echo obtenerIcono(!$tiene_gluten); ?>"></i></span><span>Apto para celíacos</span></li>
                </ul>
                <ul>
                    <li><span class="icon"><i class="<?php echo obtenerIcono($apt_diabeticos); ?>"></i></span><span>Apto para diabéticos</span></li>
                    <li><span class="icon"><i class="<?php echo obtenerIcono($apt_intolerantes); ?>"></i></span><span>Apto para intolerantes a la lactosa</span></li>
                </ul>
                <h3>Ingredientes:</h3>
                <ul>
                    <?php
                    while ($row_ingrediente = $resultado_ingredientes->fetch_assoc()) {
                        echo '<li>' . $row_ingrediente['nombre_ingrediente'] . ': ' . $row_ingrediente['cantidad'] . '</li>';
                    }
                    ?>
                </ul>
                <p><?php echo $instrucciones; ?></p>
            </article>

            

            <div class="calificacion-reseña">
                <h3>Calificar y Reseñar</h3>
                <div>&nbsp;</div>
                <form action="proceso_calificacion.php" method="post">
                    <label for="calificacion">Calificación:</label>
                    <select name="calificacion" id="calificacion" required>
                        <option value="1">1 estrella</option>
                        <option value="2">2 estrellas</option>
                        <option value="3">3 estrellas</option>
                        <option value="4">4 estrellas</option>
                        <option value="5">5 estrellas</option>
                    </select>

                    <label for="comentario">Comentario:</label>
                    <textarea name="comentario" id="comentario" rows="4" cols="50"></textarea>
                    <input type="hidden" name="id_receta" value="<?php echo $id_receta; ?>">
                    <button type="submit">Enviar</button>
                </form>
                <h3>Reseñas de la receta:</h3>
                <ul>
                    <?php
                    while ($row_resena = $resultado_reseñas->fetch_assoc()) {
                        $es_autor = ($row_resena['id_usuario'] == $_SESSION['id_usuario']);
                        $usuario_res = $row_resena['id_usuario'];

                        

                        $nombre_usuario = "SELECT * FROM usuarios WHERE id_usuario = $usuario_res";

                        $resultado_usuario = $conexion->query($nombre_usuario);
                        $nombre_usuario = $resultado_usuario->fetch_assoc()['nombre'];
                        $enlace_editar = ($es_autor) ? '<a href="editar_resena.php?id_resena=' . $row_resena['id_reseña'] . '">Editar</a>' : '';
                        $enlace_eliminar = ($es_autor) ? '<a href="eliminar_resena.php?id_resena=' . $row_resena['id_reseña'] . '">Eliminar</a>' : '';

                        echo '<hr>';
                        echo '<div>' . $nombre_usuario . '</div>';
                        echo '<div>Calificación: ' . $row_resena['calificacion'] . '</div>';
                        echo '<div>Comentario: ' . $row_resena['comentario'] . '</div>';
                        echo '<div>Fecha: ' . $row_resena['fecha'] . '</div>';
                        echo '<div>' . $enlace_editar . ' ' . $enlace_eliminar . '</div>';
                        
                    }
                    ?>
                </ul>
            </div>
        </div>      
    </div>   
</body>
</html>
