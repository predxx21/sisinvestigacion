<?php
//session_start();
include('cabeceraasesor.php.php');
include('conexion.php');
include('auth.php'); // Verifica la autenticación

// Obtén el código del usuario desde la sesión
$codigo = $_SESSION['codigo'];

// Consulta para obtener la información del investigador
$sql = "
    SELECT 
        u.Codigo AS CodigoUsuario, 
        d.Codigo, 
        d.Nombre, 
        d.Apaterno, 
        d.Amaterno, 
        c.Nombre AS carrera
    FROM usuario u
    INNER JOIN datoespecifico d ON u.Codigo = d.Codigo
    INNER JOIN asesor a ON u.Codigo = a.Codigo
    INNER JOIN especialidad e ON a.idEspecialidad = e.idEspecialidad
    INNER JOIN carrera c ON e.idCarrera = c.idCarrera
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
$imagenRuta = "./storage/imgasesor/" . $codigo . ".png";

// Verifica si la imagen existe, de lo contrario, usa una imagen por defecto
if (!file_exists($imagenRuta)) {
    $imagenRuta = "imgasesor/default.png";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet de Investigador</title>
    <!--<link rel="stylesheet" href="css/estiload.css">-->
    <style>
        .carnet-container {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 5px solid black;
            border-radius: 20px;
            width: 500px;
            margin: 20px auto;
            padding: 10px;
        }

        .carnet-photo {
            flex: 1;
            text-align: center;
        }

        .carnet-photo img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid black;
        }

        .carnet-info {
            flex: 2;
            padding-left: 10px;
        }

        .carnet-info p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="carnet-container">
        <!-- Foto del investigador -->
        <div class="carnet-photo">
        <img src="<?php echo $imagenRuta . '?t=' . time(); ?>" alt="Foto del Asesor">
        </div>

        <!-- Información del investigador -->
        <div class="carnet-info">
            <p><strong>Codigo:</strong> <?php echo $datos['Codigo']; ?></p>
            <p><strong>Apellidos:</strong> <?php echo $datos['Apaterno'] . ' ' . $datos['Amaterno']; ?></p>
            <p><strong>Nombres:</strong> <?php echo $datos['Nombre']; ?></p>
            <p><strong>Especialidad:</strong> <?php echo $datos['carrera']; ?></p>
        </div>
    </div>
</body>

</html>
