<?php
// Incluir archivos necesarios
include('cabecerainvestigador.php');
include('conexion.php');
include('auth.php'); // Verifica la autenticación

// Verificar que el usuario esté autenticado
if (!isset($_SESSION["codigo"])) {
    header('location: index.php');
    exit();
}

// Obtener el código del usuario desde la sesión
$codigo = $_SESSION["codigo"];

// Consulta para obtener el idinvestigador desde la tabla investigador
$sql_investigador = "SELECT idinvestigador FROM investigador WHERE Codigo = '$codigo'";
$result_investigador = mysqli_query($cn, $sql_investigador);

// Verificar si se obtuvo el idinvestigador
if ($result_investigador && mysqli_num_rows($result_investigador) > 0) {
    $row_investigador = mysqli_fetch_assoc($result_investigador);
    $idinvestigador = $row_investigador['idinvestigador'];
} else {
    echo "No se encontró el investigador para este usuario.";
    exit();
}

// Consulta para obtener los proyectos del investigador
$sql_proyectos = "
    SELECT p.idproyecto, p.pnombre, p.enombre, p.direccion, p.periodo
    FROM proyecto p
    WHERE p.idinvestigador = '$idinvestigador'
";
$result_proyectos = mysqli_query($cn, $sql_proyectos);

// Verificar si se encontraron proyectos
if (mysqli_num_rows($result_proyectos) > 0) {
    // Mostrar los proyectos en una tabla
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Nombre del Proyecto</th>
                    <th>Dirección</th>
                    <th>Actualizar Proyecto</th>
                    <th>Cuadro de Diagnóstico</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = mysqli_fetch_assoc($result_proyectos)) {
        // Enlaces para actualizar el proyecto y ver el cuadro de diagnóstico
        $actualizar_link = "actualizaproyecto.php?idproyecto=" . $row['idproyecto'];
        $alimentar_link = "alimentar.php?idproyecto=" . $row['idproyecto'];
        
        echo "<tr>
                <td>" . htmlspecialchars($row['pnombre']) . "</td>
                <td>" . htmlspecialchars($row['direccion']) . "</td>
                <td><a href='$actualizar_link'>Actualizar Proyecto</a></td>
                <td><a href='$alimentar_link'>Cuadro de Diagnóstico</a></td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No se han encontrado proyectos para este investigador.";
}

mysqli_close($cn);
?>
