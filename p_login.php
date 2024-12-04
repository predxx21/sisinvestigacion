<?php
session_start();
include('conexion.php');

// Obtén los datos del formulario
$usuario = $_POST["txtcodigo"];
$password = $_POST["txtpass"];

// Consulta para verificar usuario y contraseña
$sql = "SELECT Codigo, idrol FROM usuario WHERE Codigo = '$usuario' AND password = '$password'";
$result = mysqli_query($cn, $sql);
$r = mysqli_fetch_assoc($result);

if ($r) {
    // Guarda el código del usuario y otros datos en variables de sesión
    $_SESSION["codigo"] = $r["Codigo"]; // Variable principal que usarás
    $_SESSION["idrol"] = $r["idrol"];
    $_SESSION["auth"] = 1;

    // Redirige según el rol
    switch ($r["idrol"]) {
        case '1': // Rol de investigador
            header('location: principal_i.php');
            break;
        case '2': // Otro rol (administrador, etc.)
            header('location: principal_a.php');
            break;
        default:
            header('location: index.php'); 
    }
} else {
    // Si el login falla, redirige al formulario con un mensaje de error
    header('location: index.php?error=1');
}
?>
