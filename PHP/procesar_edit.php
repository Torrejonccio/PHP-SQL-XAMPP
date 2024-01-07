<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_correo = $_POST['nuevo_correo'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    $conexion = mysqli_connect("localhost", "root", "", "sabor_usm");

    if($conexion->connect_error){
        die("Error de conexión: ".$conexion->connect_error);
    }

    $actualizar_datos= "UPDATE usuarios 
                        SET nombre = '$nuevo_nombre',
                            correo = '$nuevo_correo',
                            contraseña = '$nueva_contraseña' 
                        WHERE correo = '$_SESSION[correo]'";

    $resultado = mysqli_query($conexion, $actualizar_datos);

    if ($resultado){
        echo "Nombre actualizado correctamente";
        $_SESSION['nombre'] = $nuevo_nombre;
        $_SESSION['correo'] = $nuevo_correo;
        $_SESSION['contraseña'] = $nueva_contraseña;
        header("location: info.php");
    } else {
        echo "Error al actualizar el nombre: ".$conexion->error;
    }
    
    

    $conexion->close();
}
?>