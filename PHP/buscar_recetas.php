<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filtro_nombre_ingrediente = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
    $filtro_tipo = isset($_POST['filtro_tipo']) ? $_POST['filtro_tipo'] : '';
    $filtro_veganos = isset($_POST['filtro_veganos']) ? "AND rec.apt_diabeticos = 1" : '';
    $filtro_celiacos = isset($_POST['filtro_celiacos']) ? "AND rec.tiene_gluten = 1" : '';
    $filtro_lactosa = isset($_POST['filtro_lactosa']) ? "AND rec.apt_intolerantes = 1" : '';

    $consulta = "SELECT rec.nombre AS nombre, 
                rec.imagen AS imagen,
                rec.tipo AS tipo,
                ROUND(AVG(res.calificacion)) AS promedio_calificaciones
                FROM recetas rec
                LEFT JOIN reseñas res ON rec.id_receta = res.id_receta
                LEFT JOIN recetas_ingredientes ri ON rec.id_receta = ri.id_receta
                LEFT JOIN ingredientes ing ON ri.id_ingrediente = ing.id_ingrediente
                WHERE (rec.nombre LIKE '%$filtro_nombre_ingrediente%' OR ing.nombre_ing LIKE '%$filtro_nombre_ingrediente%')
                $filtro_tipo
                $filtro_veganos
                $filtro_celiacos
                $filtro_lactosa
                GROUP BY rec.id_receta, rec.nombre, rec.imagen, rec.tipo";
} else {
    $consulta = "SELECT rec.nombre AS nombre, 
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
<html lang="es">

<head>
</head>

<body>
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
                        <option value="AND rec.tipo = 'entrada'">Entrada</option>
                        <option value="AND rec.tipo = 'fondo'">Fondo</option>
                        <option value="AND rec.tipo = 'postre'">Postre</option>
                    </select>
                    <label><input type="checkbox" name="filtro_veganos"> Apto para veganos</label>
                    <label><input type="checkbox" name="filtro_celiacos"> Apto para celiacos</label>
                    <label><input type="checkbox" name="filtro_lactosa"> Apto para intolerantes a la lactosa</label>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <?php
        while ($fila = $resultado_consulta->fetch_assoc()) {
        }
        ?>
    </div>

</body>

</html>
