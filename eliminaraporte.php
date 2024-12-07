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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilocuadros.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Eliminar Aporte</title>
</head>
<body>
    <center>
        <h2>Eliminar Aporte</h2>

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

        <!-- Confirmación de eliminación -->
        <div id="formEliminarAporte" style="margin-top: 20px; display: none;">
            <p id="descripcionAporte"></p>
            <button type="button" id="btnEliminar">Eliminar Aporte</button>
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
                            $('#formEliminarAporte').hide();
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
                            $('#descripcionAporte').text("¿Estás seguro de eliminar el aporte: " + aporte.descripcion + "?");
                            $('#formEliminarAporte').show();
                            $('#btnEliminar').data('idaporte', aporte.idaporte); // Guardar el ID del aporte en el botón
                        }
                    });
                } else {
                    $('#formEliminarAporte').hide();
                }
            });

            // Manejar la acción de eliminación
            $('#btnEliminar').on('click', function () {
                const idAporte = $(this).data('idaporte');
                if (confirm("¿Realmente deseas eliminar este aporte?")) {
                    $.ajax({
                        url: 'p_eliminaraporte.php',
                        method: 'POST',
                        data: { idaporte: idAporte },
                        success: function (response) {
                            alert(response); // Mostrar mensaje de éxito o error
                            window.location.href = 'verproyecto.php?idproyecto=<?php echo $idproyecto; ?>'; // Redirigir a verproyecto.php
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
