<?php
include('cabecerainvestigador.php');
include('conexion.php');
include('auth.php'); // Verifica la autenticación

// Obtén el código del usuario desde la sesión
$codigo = $_SESSION['codigo'];

// Consulta para obtener la información del investigador junto con el estado
$sql = "
    SELECT 
        u.Codigo AS CodigoUsuario, 
        d.Codigo, 
        d.Nombre, 
        d.Apaterno, 
        d.Amaterno, 
        c.Nombre AS Carrera, 
        co.Estado AS Condicion,
        d.celular, 
        d.correo, 
        d.direccion, 
        d.estado
    FROM usuario u
    INNER JOIN datoespecifico d ON u.Codigo = d.Codigo
    INNER JOIN investigador i ON u.Codigo = i.Codigo
    INNER JOIN carrera c ON i.idCarrera = c.idCarrera
    INNER JOIN condicion co ON i.idCondicion = co.idCondicion
    WHERE u.Codigo = '$codigo'
";

$result = mysqli_query($cn, $sql);
$datos = mysqli_fetch_assoc($result);

// Si no se encuentran datos
if (!$datos) {
    echo "No se encontró información para este usuario.";
    exit();
}

// Ruta de la imagen del investigador
$imagenRuta = "./storage/imginvestigador/" . $codigo . ".png";

// Verifica si la imagen existe, de lo contrario, usa una imagen por defecto
if (!file_exists($imagenRuta)) {
    $imagenRuta = "imginvestigador/default.png";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet de Investigador</title>
    <link rel="stylesheet" href="css/carnet.css">
</head>

<body>
    <div class="carnet-container">
        <div class="carnet-header">Carnet de Investigador</div>
        
        <!-- Foto del investigador -->
        <div class="carnet-photo">
            <img src="<?php echo $imagenRuta . '?t=' . time(); ?>" alt="Foto del Investigador">
        </div>

        <!-- Información del investigador -->
        <div class="carnet-info">
            <p><strong>Código:</strong> <?php echo $datos['Codigo']; ?></p>
            <p><strong>Apellidos:</strong> <?php echo $datos['Apaterno'] . ' ' . $datos['Amaterno']; ?></p>
            <p><strong>Nombres:</strong> <?php echo $datos['Nombre']; ?></p>
            <p><strong>Especialidad:</strong> <?php echo $datos['Carrera']; ?></p>
            <p><strong>Condición:</strong> <?php echo $datos['Condicion']; ?></p>
        </div>
    </div>

    <?php if ($datos['estado'] == 1) { ?>
        <!-- Información adicional para estado 1 -->
        <div class="carnet-container">
            <div class="extra-info">
                <p><strong>Celular:</strong> <?php echo $datos['celular']; ?></p>
                <p><strong>Correo:</strong> <?php echo $datos['correo']; ?></p>
                <p><strong>Dirección:</strong> <?php echo $datos['direccion']; ?></p>
            </div>
        </div>
    <?php } ?>

    <!-- Código QR opcional -->
    <!--<div class="qr-code">
        <img src="path_to_qr_code_image.png" alt="QR Code">
    </div>-->
</body>

</html>
