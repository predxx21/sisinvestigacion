<?php
include('conexion.php');

$idaporte = intval($_GET['idaporte']);

$sql = "SELECT idaporte, descripcion, idtipoaporte FROM aporte WHERE idaporte = $idaporte";
$result = mysqli_query($cn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode([]);
}

mysqli_close($cn);
?>
