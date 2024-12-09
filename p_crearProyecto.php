<?php
include("./auth.php");
include("conexion.php");


// Verificar que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $tipo_proyecto=$_POST['lsttipoproyecto'];
    echo $tipo_proyecto;
    $nombre_proyecto = $_POST['txtnombreP'];
    $nombre_empresa = $_POST['txtnombreE'];
    $direccion = $_POST['txtdireccion'];
    $periodo = $_POST['txtPeriodo'];
   
    

    
    try {
        if(!isset($_POST["idproyecto"])){

            $idinvestiga = $_POST["txtid"];
        // Insertar en la tabla usuario
        $queryProyecto = "INSERT INTO proyecto (pnombre, enombre, direccion,periodo,idinvestigador,idtipoproyecto) VALUES ('$nombre_proyecto', '$nombre_empresa','$direccion','$periodo',$idinvestiga,$tipo_proyecto)";
        }else{
            $id_proyecto=$_POST["idproyecto"];
            $queryProyecto = "update proyecto
SET  pnombre='$nombre_proyecto',
enombre='$nombre_empresa',
direccion='$direccion',
periodo='$periodo',
idtipoproyecto=$tipo_proyecto
where idproyecto=$id_proyecto";
        }
        if (!mysqli_query($cn, $queryProyecto)) {
            throw new Exception("Error al registrar en la tabla Proyecto: " . mysqli_error($cn));
        }

        // Confirmar la transacción
        mysqli_commit($cn);
        echo "Registro completado exitosamente.";
       header("location:verproyecto.php");
       
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($cn);
        die("Error en la transacción: " . $e->getMessage());
    }








} else {
    die("Acceso no permitido.");
}
