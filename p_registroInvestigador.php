<?php
include("conexion.php");

// Función para generar la contraseña aleatoria de 8 dígitos
function generapass(){


    //armate una plantilla

    $plantilla="qwertyuiopasdfghjklzxcvbnm1234567890";

    $password="";

    //substr(cadena,posicion,cantcaracteres)
    //rand(min,max)

    for ($i=1; $i<= 8; $i++) { 
    
        $password=$password.substr($plantilla,rand(1,36),1);

        
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
    $condicion = $_POST['condicion']; // ID de condición
    $denominacion = $_POST['denominacion']; // ID de denominación
    $carrera = $_POST['carrera']; // ID de carrera
    $dni = $_POST['txtdni'];

    // Generar contraseña aleatoria
    $password = generapass();

    // Obtener el ID del rol correspondiente al investigador
    $queryRol = "SELECT idrol FROM rol WHERE nombre = 'investigador'";
    $resultRol = mysqli_query($cn, $queryRol);

    if ($resultRol && $rowRol = mysqli_fetch_assoc($resultRol)) {
        $idrol = $rowRol['idrol'];
    } else {
        die("Error: No se pudo obtener el ID del rol para investigador.");
    }

    // Iniciar una transacción para asegurar la integridad de los datos
    mysqli_begin_transaction($cn);

    try {
        // Insertar en la tabla usuario
        $queryUsuario = "INSERT INTO usuario (codigo, password, idrol) VALUES ('$codigo', '$password', $idrol)";
        if (!mysqli_query($cn, $queryUsuario)) {
            throw new Exception("Error al registrar en la tabla usuario: " . mysqli_error($cn));
        }

        // Insertar en la tabla investigador
        $queryInvestigador = "INSERT INTO investigador (iddenominacion, idcondicion, idcarrera, dni, codigo) 
                              VALUES ($denominacion, $condicion, $carrera, '$dni', '$codigo')";
        if (!mysqli_query($cn, $queryInvestigador)) {
            throw new Exception("Error al registrar en la tabla investigador: " . mysqli_error($cn));
        }

        // Insertar en la tabla datosespecifico
        $queryDatosEspecifico = "INSERT INTO datoespecifico 
                                (nombre, apaterno, amaterno, celular, correo, direccion, estado, codigo) 
                                VALUES ('$nombre', '$apaterno', '$amaterno', NULL, NULL, NULL, 0, '$codigo')";
        if (!mysqli_query($cn, $queryDatosEspecifico)) {
            throw new Exception("Error al registrar en la tabla datosespecifico: " . mysqli_error($cn));
        }

        // Confirmar la transacción
        mysqli_commit($cn);

        // Mostrar mensaje de éxito
        echo "<script>alert('Investigador registrado correctamente.'); window.location.href='formularioInvestigador.php';</script>";
        header('location: index.php');
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        mysqli_rollback($cn);
        die($e->getMessage());
    }
} else {
    die("Error: Formulario no enviado correctamente.");
}
?>
