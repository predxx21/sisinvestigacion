<?php
include('conexion.php');

$idproyecto = intval($_GET['idproyecto']);
$tipoaporte = intval($_GET['tipoaporte']);

$sql = "SELECT idaporte, descripcion FROM aporte WHERE idproyecto = $idproyecto AND idtipoaporte = $tipoaporte";
$result = mysqli_query($cn, $sql);

$aportes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $aportes[] = $row;
}

echo json_encode($aportes);
mysqli_close($cn);
?>
