<?php
include('conexion.php');
session_start(); // Asegúrate de llamar a session_start()

// Verificar que el usuario esté autenticado
if (!isset($_SESSION["codigo"])) {
    header('location: index.php');
    exit();
}

$codigo = $_SESSION["codigo"]; // Código del usuario logueado

// Obtener los datos enviados desde el formulario
$celular = $_POST['cell'];
$correo = $_POST['email'];
$direccion = $_POST['address'];

// Validar que los campos no estén vacíos
if (empty($celular) || empty($correo) || empty($direccion)) {
    echo "Error: Todos los campos son obligatorios.";
    exit();
}

// Actualizar los datos en la tabla datoespecifico
$sql = "UPDATE datoespecifico 
        SET celular = ?, correo = ?, direccion = ?, estado = 1
        WHERE codigo = ?";
$stmt = $cn->prepare($sql);
$stmt->bind_param("sssi", $celular, $correo, $direccion, $codigo);

if ($stmt->execute()) {
    echo "Los datos se han actualizado correctamente.";
    // Redirigir a otra página o mostrar un mensaje de éxito
    header('location: principal_i.php');
} else {
    echo "Error al actualizar los datos: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>
