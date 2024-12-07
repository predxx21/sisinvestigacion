<?php
// Incluir archivos necesarios
include('conexion.php');
include('auth.php'); // Verifica la autenticación

// Verificar que el usuario esté autenticado
if (!isset($_SESSION["codigo"])) {
    header('location: index.php');
    exit();
}

// Verificar que los datos necesarios fueron enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idproyecto'], $_POST['idtipoaporte'], $_POST['descripcion'])) {
    // Escapar y asignar variables
    $idproyecto = intval($_POST['idproyecto']);
    $idtipoaporte = intval($_POST['idtipoaporte']);
    $descripcion = mysqli_real_escape_string($cn, $_POST['descripcion']);

    // Validar datos
    if ($idproyecto > 0 && $idtipoaporte > 0 && !empty($descripcion)) {
        // Consulta para insertar el registro en la tabla aporte
        $sql_insert = "
            INSERT INTO aporte (descripcion, idtipoaporte, idproyecto)
            VALUES ('$descripcion', '$idtipoaporte', '$idproyecto')
        ";

        // Ejecutar la consulta
        if (mysqli_query($cn, $sql_insert)) {
            // Redirigir a verproyecto.php
            header("Location: verproyecto.php");
            exit();
        } else {
            // Mostrar error si la consulta falla
            echo "Error al agregar el registro: " . mysqli_error($cn);
        }
    } else {
        echo "Por favor, completa todos los campos correctamente.";
    }
} else {
    echo "Solicitud inválida.";
}

// Cerrar la conexión
mysqli_close($cn);
?>
