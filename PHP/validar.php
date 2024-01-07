<?php
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

session_start();

$_SESSION['correo'] = $correo;
$_SESSION['contraseña'] = $contraseña;

$conexion = mysqli_connect("localhost", "root", "", "sabor_usm");
$consulta = "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";

$resultado = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($resultado)){
    $fecha_act = date('Y-m-d H:i:s');
    if(isset($_SESSION['fecha_login'])){
        $consulta_fech = "UPDATE usuarios SET ultima_sesion = '$fecha_act' WHERE correo = '$correo'";
        mysqli_query($conexion, $consulta_fech);
    }
    else{
        $_SESSION['fecha_login'] = $fecha_act;
    }

    $consulta2 = "SELECT nombre, cant_almuerzos, id_usuario FROM usuarios WHERE correo = '$correo'";
    $resultado2 = mysqli_query($conexion, $consulta2);

    if(!$resultado2){
        die("Error".$conexion->error);
    }
    else{
        $fila = mysqli_fetch_assoc($resultado2);

        $nombre = $fila['nombre'];
        $cant_almuerzos = $fila['cant_almuerzos'];
        $id_usuario = $fila['id_usuario'];
    }

    $_SESSION['nombre'] = $nombre;
    $_SESSION['almuerzos'] = $cant_almuerzos;
    $_SESSION['id_usuario'] = $id_usuario;


    header("location: home.php");
}

else{    
    ?>
    <?php
    include("index_error.php");
    ?>
    
    <?php
}

mysqli_free_result($resultado);
$conexion->close();
?>


