<?php
include('conexion.php');

// Verificar parámetro
$idaporte = isset($_POST['idaporte']) ? intval($_POST['idaporte']) : 0;

if ($idaporte > 0) {
    // Eliminar el aporte
    $query = "DELETE FROM aporte WHERE idaporte = ?";
    $stmt = $cn->prepare($query);
    $stmt->bind_param('i', $idaporte);

    if ($stmt->execute()) {
        echo "Aporte eliminado correctamente.";
    } else {
        echo "Error al eliminar el aporte.";
    }
} else {
    echo "ID de aporte inválido.";
}
?>
