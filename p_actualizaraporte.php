<?php
include('conexion.php');

$idaporte = intval($_POST['idaporte']);
$idproyecto = intval($_POST['idproyecto']);
$tipoaporte = intval($_POST['tipoaporte']);
$descripcion = mysqli_real_escape_string($cn, $_POST['descripcion']);

$sql = "
    UPDATE aporte 
    SET descripcion = '$descripcion', idtipoaporte = $tipoaporte 
    WHERE idaporte = $idaporte AND idproyecto = $idproyecto
";

if (mysqli_query($cn, $sql)) {
    header("Location: verproyecto.php");
} else {
    echo "Error al actualizar el aporte: " . mysqli_error($cn);
}

mysqli_close($cn);
?>
