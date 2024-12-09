<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/alimentarestilo.css">
    <title>Alimentar Proyecto</title>
</head>

<body>
    <center>
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

        // Obtener el idproyecto desde el enlace (query string)
        if (!isset($_GET['idproyecto'])) {
            echo "No se ha especificado un proyecto.";
            exit();
        }
        $idproyecto = $_GET['idproyecto'];

        // Procesar el formulario si se envió
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descripcion = mysqli_real_escape_string($cn, $_POST['descripcion']);
            $idtipoaporte = intval($_POST['idtipoaporte']);

            // Validar que se seleccionó un tipo de aporte
            if ($idtipoaporte > 0 && !empty($descripcion)) {
                $sql_insert = "
                    INSERT INTO aporte (descripcion, idtipoaporte, idproyecto)
                    VALUES ('$descripcion', '$idtipoaporte', '$idproyecto')
                ";
                if (mysqli_query($cn, $sql_insert)) {
                    echo "<p>Registro agregado correctamente.</p>";
                } else {
                    echo "<p>Error al registrar el aporte: " . mysqli_error($cn) . "</p>";
                }
            } else {
                echo "<p>Por favor, completa todos los campos.</p>";
            }
        }
        ?>

        <!-- Formulario para alimentar el proyecto -->
        <form method="POST" action="alimentarproyecto.php?idproyecto=<?php echo htmlspecialchars($idproyecto); ?>">
            <table>
                <tr>
                    <td>
                        <!-- Opciones de tipo de aporte -->
                        <label><input type="radio" name="idtipoaporte" value="1"> Síntoma</label>
                        <label><input type="radio" name="idtipoaporte" value="2"> Causa</label>
                        <label><input type="radio" name="idtipoaporte" value="3"> Pronóstico</label>
                        <?php
                        $sql = "select * from proyecto where idproyecto=$idproyecto";
                        $f = mysqli_query($cn, $sql);
                        $r = mysqli_fetch_assoc($f);
                        $idtipoproyecto = $r["idtipoproyecto"];
                        $Sql_tip = "select * from tipoproyecto where idtipoproyecto=$idtipoproyecto";
                        $f_t = mysqli_query($cn, $Sql_tip);
                        $r_t = mysqli_fetch_assoc($f_t);

                        if (($r_t["nombre"] != "Descriptivo")) {


                        ?>
                            <label><input type="radio" name="idtipoaporte" value="4"> Control de Pronóstico</label>

                        <?php } ?>

                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- Área de descripción -->
                        <textarea name="descripcion" rows="5" cols="50" placeholder="Descripción"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- Botón para enviar -->
                        <button type="submit">Alimentar</button>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>

</html>