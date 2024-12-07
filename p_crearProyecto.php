<?php
include("./auth.php");
include("conexion.php");


// Verificar que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_proyecto = $_POST['txtnombreP'];
    $nombre_empresa = $_POST['txtnombreE'];
    $direccion = $_POST['txtdireccion'];
    $periodo = $_POST['txtPeriodo'];
    $breve = $_POST['txtBreve'];
    

    $idinvestiga=$_POST["txtid"];
    echo $idinvestiga;
    try {
        // Insertar en la tabla usuario
        $queryProyecto = "INSERT INTO proyecto (pnombre, enombre, direccion,periodo,idinvestigador) VALUES ('$nombre_proyecto', '$nombre_empresa','$direccion','$periodo',' $idinvestiga')";

        if (!mysqli_query($cn, $queryProyecto)) {
            throw new Exception("Error al registrar en la tabla Proyecto: " . mysqli_error($cn));
        }

        // Confirmar la transacción
        mysqli_commit($cn);
        echo "Registro completado exitosamente.";
        header('location: verproyecto.php');
       
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($cn);
        die("Error en la transacción: " . $e->getMessage());
    }








} else {
    die("Acceso no permitido.");
}
