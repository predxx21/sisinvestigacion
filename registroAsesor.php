<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloregistro.css">
    <title>Registro de Asesor</title>
</head>

<body>
    <div class="container">
        <h1 class="title">Registro de Asesor</h1>
        <form action="p_registroAsesor.php" method="post">
            <fieldset>
                <legend>Datos del Asesor</legend>

                <!-- Código -->
                <div class="form-group">
                    <label for="txtcodigo">Código</label>
                    <input type="text" name="txtcodigo" id="txtcodigo" autocomplete="off" placeholder="Ingrese su código" required>
                </div>

                <!-- DNI -->
                <div class="form-group">
                    <label for="txtdni">DNI</label>
                    <input type="text" name="txtdni" id="txtdni" autocomplete="off" placeholder="Ingrese su DNI" required pattern="\d{8}" title="Debe contener 8 dígitos">
                </div>

                <!-- Dina -->
                <div class="form-group">
                    <label for="txtdina">Dina</label>
                    <input type="text" name="txtdina" id="txtdina" autocomplete="off" placeholder="Ingrese a la Dina">
                </div>

                <!-- Nombre -->
                <div class="form-group">
                    <label for="txtnombre">Nombre</label>
                    <input type="text" name="txtnombre" id="txtnombre" autocomplete="off" placeholder="Ingrese su nombre" required>
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group">
                    <label for="txtapaterno">Apellido Paterno</label>
                    <input type="text" name="txtapaterno" id="txtapaterno" autocomplete="off" placeholder="Ingrese su apellido paterno" required>
                </div>

                <!-- Apellido Materno -->
                <div class="form-group">
                    <label for="txtamaterno">Apellido Materno</label>
                    <input type="text" name="txtamaterno" id="txtamaterno" autocomplete="off" placeholder="Ingrese su apellido materno" required>
                </div>

                <!-- Especialidad -->
                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <select name="especialidad" id="especialidad" required>
                        <option value="">Seleccione una especialidad</option>
                        <?php
                        $sql_especialidad = "SELECT idespecialidad, nombre FROM especialidad";
                        $result_especialidad = $cn->query($sql_especialidad);

                        if ($result_especialidad->num_rows > 0) {
                            while ($row = $result_especialidad->fetch_assoc()) {
                                echo "<option value='" . $row['idespecialidad'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay especialidades disponibles</option>";
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