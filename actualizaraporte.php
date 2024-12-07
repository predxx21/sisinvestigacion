<?php
include('conexion.php');
include('auth.php');

// Verificar autenticación
if (!isset($_SESSION["codigo"])) {
    header('location: index.php');
    exit();
}

// Obtener el ID del proyecto
$idproyecto = isset($_GET['idproyecto']) ? intval($_GET['idproyecto']) : 0;
if ($idproyecto <= 0) {
    echo "ID de proyecto inválido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilocuadros.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Editar Aporte</title>
</head>
<body>
    <center>
        <h2>Editar Aporte</h2>

        <!-- Selección del tipo de aporte -->
        <form id="formTipoAporte">
            <label><input type="radio" name="tipoaporte" value="1"> Síntoma</label>
            <label><input type="radio" name="tipoaporte" value="2"> Causa</label>
            <label><input type="radio" name="tipoaporte" value="3"> Pronóstico</label>
            <label><input type="radio" name="tipoaporte" value="4"> Control de Pronóstico</label>
        </form>

        <!-- ComboBox dinámico -->
        <div id="comboAporte" style="margin-top: 20px; display: none;">
            <label for="aporteSelect">Selecciona un aporte:</label>
            <select id="aporteSelect">
                <option value="">-- Selecciona un aporte --</option>
            </select>
        </div>

        <!-- Formulario para editar -->
        <div id="formEditarAporte" style="margin-top: 20px; display: none;">
            <form method="POST" action="p_actualizaraporte.php">
                <input type="hidden" name="idaporte" id="idaporte">
                <input type="hidden" name="idproyecto" value="<?php echo $idproyecto; ?>">

                <label for="tipoaporte">Tipo de Aporte:</label>
                <select name="tipoaporte" id="tipoaporte">
                    <option value="1">Síntoma</option>
                    <option value="2">Causa</option>
                    <option value="3">Pronóstico</option>
                    <option value="4">Control de Pronóstico</option>
                </select><br><br>

                <label for="descripcion">Descripción:</label><br>
                <textarea name="descripcion" id="descripcion" rows="5" cols="40"></textarea><br><br>

                <button type="submit">Editar</button>
            </form>
        </div>
    </center>

    <script>
        $(document).ready(function () {
            // Detectar cambio en el tipo de aporte
            $('input[name="tipoaporte"]').on('change', function () {
                const tipoAporte = $(this).val();
                if (tipoAporte) {
                    // Cargar los aportes del tipo seleccionado
                    $.ajax({
                        url: 'obtener_aportes.php',
                        method: 'GET',
                        data: {
                            idproyecto: <?php echo $idproyecto; ?>,
                            tipoaporte: tipoAporte
                        },
                        success: function (data) {
                            const aportes = JSON.parse(data);
                            const select = $('#aporteSelect');
                            select.empty().append('<option value="">-- Selecciona un aporte --</option>');
                            aportes.forEach(aporte => {
                                select.append('<option value="' + aporte.idaporte + '">' + aporte.descripcion + '</option>');
                            });
                            $('#comboAporte').show();
                            $('#formEditarAporte').hide();
                        }
                    });
                }
            });

            // Detectar selección en el ComboBox
            $('#aporteSelect').on('change', function () {
                const idAporte = $(this).val();
                if (idAporte) {
                    // Cargar los datos del aporte seleccionado
                    $.ajax({
                        url: 'obtener_aporte_detalle.php',
                        method: 'GET',
                        data: { idaporte: idAporte },
                        success: function (data) {
                            const aporte = JSON.parse(data);
                            $('#idaporte').val(aporte.idaporte);
                            $('#tipoaporte').val(aporte.idtipoaporte);
                            $('#descripcion').val(aporte.descripcion);
                            $('#formEditarAporte').show();
                        }
                    });
                } else {
                    $('#formEditarAporte').hide();
                }
            });
        });
    </script>
</body>
</html>
