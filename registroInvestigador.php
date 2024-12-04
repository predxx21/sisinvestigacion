<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloregistro.css">
    <title>Registro de Investigador</title>
</head>

<body>
    <div class="container">
        <h1>Registro de Investigador</h1>
        <form action="p_registroInvestigador.php" method="post">
            <fieldset>
                <legend>Introduzca sus datos</legend>

                <div class="form-group">
                    <label for="txtcodigo">Código</label>
                    <input type="text" name="txtcodigo" id="txtcodigo" autocomplete="off" placeholder="Ingrese su código">
                </div>

                <div class="form-group">
                    <label for="txtdni">DNI</label>
                    <input type="text" name="txtdni" id="txtdni" autocomplete="off" placeholder="Ingrese su DNI">
                </div>

                <div class="form-group">
                    <label for="txtnombre">Nombre</label>
                    <input type="text" name="txtnombre" id="txtnombre" autocomplete="off" placeholder="Ingrese su nombre">
                </div>

                <div class="form-group">
                    <label for="txtapaterno">Apellido Paterno</label>
                    <input type="text" name="txtapaterno" id="txtapaterno" autocomplete="off" placeholder="Ingrese su apellido paterno">
                </div>

                <div class="form-group">
                    <label for="txtamaterno">Apellido Materno</label>
                    <input type="text" name="txtamaterno" id="txtamaterno" autocomplete="off" placeholder="Ingrese su apellido materno">
                </div>

                <div class="form-group">
                    <label for="carrera">Carrera</label>
                    <select name="carrera" id="carrera">
                        <?php
                        $queryCarrera = "SELECT idcarrera, nombre FROM carrera";
                        $resultCarrera = mysqli_query($cn, $queryCarrera);

                        if ($resultCarrera) {
                            while ($row = mysqli_fetch_assoc($resultCarrera)) {
                                echo "<option value='" . $row['idcarrera'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay carreras disponibles</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="condicion">Condición</label>
                    <select name="condicion" id="condicion">
                        <?php
                        $queryCondicion = "SELECT idcondicion, estado FROM condicion";
                        $resultCondicion = mysqli_query($cn, $queryCondicion);

                        if ($resultCondicion) {
                            while ($row = mysqli_fetch_assoc($resultCondicion)) {
                                echo "<option value='" . $row['idcondicion'] . "'>" . $row['estado'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay condiciones disponibles</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="denominacion">Denominación</label>
                    <select name="denominacion" id="denominacion">
                        <?php
                        $queryDenominacion = "SELECT iddenominacion, nombre FROM denominacion";
                        $resultDenominacion = mysqli_query($cn, $queryDenominacion);

                        if ($resultDenominacion) {
                            while ($row = mysqli_fetch_assoc($resultDenominacion)) {
                                echo "<option value='" . $row['iddenominacion'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay denominaciones disponibles</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" id="btn">Registrarse</button>

                <br>
                <a href="index.php" id="btn-admin">
                Regresar a la Sesion
                </a>
            </fieldset>
        </form>
    </div>
</body>

</html>

