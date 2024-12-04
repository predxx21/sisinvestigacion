<?php
include("./auth.php");

// Verificar que el usuario está autenticado
if (!isset($_SESSION["codigo"])) {
    header('location: index.php');
    exit();
}

$codigo = $_SESSION["codigo"]; // Código del usuario logueado
$imagenRuta = "./storage/imginvestigador/" . $codigo . ".png";

// Verificar que se ha enviado un archivo
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
    $archivo = $_FILES["imagen"];
    $tipoArchivo = $archivo["type"];
    $rutaTemporal = $archivo["tmp_name"];

    // Validar el tipo de archivo (solo PNG)
    if ($tipoArchivo == "image/png") {
        // Mover el archivo a la ruta especificada, sobrescribiendo si ya existe
        if (move_uploaded_file($rutaTemporal, $imagenRuta)) {
            echo "La imagen se ha actualizado correctamente.";
            header('location: principal_i.php');
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error: Solo se permiten archivos PNG.";
    }
} else {
    echo "Error: No se ha seleccionado ningún archivo o ha ocurrido un error al subirlo.";
}
?>
