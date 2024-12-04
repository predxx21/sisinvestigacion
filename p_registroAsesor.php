<?php
include("conexion.php");

// Función para generar la contraseña aleatoria de 8 dígitos
function generapass() {
    $plantilla = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $password = "";

    for ($i = 1; $i <= 8; $i++) { 
        $password .= substr($plantilla, rand(0, strlen($plantilla) - 1), 1);
    }

    return $password;
}

// Verificar que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $codigo = $_POST['txtcodigo'];
    $nombre = $_POST['txtnombre'];
    $apaterno = $_POST['txtapaterno'];
    $amaterno = $_POST['txtamaterno'];
    $dina = $_POST['txtdina'];
    $dni = $_POST['txtdni'];
    $idespecialidad = $_POST['especialidad']; // ID de la especialidad enviado directamente desde el formulario

    // Generar contraseña aleatoria
    $password = generapass();

    // Obtener el ID del rol correspondiente al asesor
    $queryRol = "SELECT idrol FROM rol WHERE nombre = 'asesor'";
    $resultRol = mysqli_query($cn, $queryRol);

    if ($resultRol && $rowRol = mysqli_fetch_assoc($resultRol)) {
        $idrol = $rowRol['idrol'];
    } else {
        die("Error: No se pudo obtener el ID del rol para asesor.");
    }

    // Iniciar una transacción para asegurar la integridad de los datos
    mysqli_begin_transaction($cn);

    try {
        // Insertar en la tabla usuario
        $queryUsuario = "INSERT INTO usuario (codigo, password, idrol) VALUES ('$codigo', '$password', $idrol)";
        if (!mysqli_query($cn, $queryUsuario)) {
            throw new Exception("Error al registrar en la tabla usuario: " . mysqli_error($cn));
        }

        // Insertar en la tabla datospecifico
        $queryDatosEspecifico = "INSERT INTO datoespecifico (nombre, apaterno, amaterno, celular, correo, direccion, estado, codigo) 
                                 VALUES ('$nombre', '$apaterno', '$amaterno', NULL, NULL, NULL, 0, '$codigo')";
        if (!mysqli_query($cn, $queryDatosEspecifico)) {
            throw new Exception("Error al registrar en la tabla datoespecifico: " . mysqli_error($cn));
        }

        // Insertar en la tabla asesor
        $queryAsesor = "INSERT INTO asesor (dina, dni, idespecialidad, codigo) 
                        VALUES ('$dina', '$dni', $idespecialidad, '$codigo')";
        if (!mysqli_query($cn, $queryAsesor)) {
            throw new Exception("Error al registrar en la tabla asesor: " . mysqli_error($cn));
        }

        // Confirmar la transacción
        mysqli_commit($cn);
        echo "Registro completado exitosamente.";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($cn);
        die("Error en la transacción: " . $e->getMessage());
    }
} else {
    die("Acceso no permitido.");
}
?>
