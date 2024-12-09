<?php
include("./auth.php");
include("./conexion.php");
include("./cabecerainvestigador.php");
$idproyecto = $_POST["lstproyecto"];

$sql = "select a.* from proyecto p, aporte a where p.idproyecto=a.idproyecto and p.idproyecto=$idproyecto";
$f = mysqli_query($cn, $sql);
$Sintomas = [];
$CAUSAS = [];
$PRONOSTICO = [];
$CONTROL = [];
while ($r = mysqli_fetch_assoc($f)) {
    switch ($r["idtipoaporte"]) {
        case 1:
            $Sintomas[] = $r["descripcion"];
            break;
        case 2:
            $CAUSAS[] = $r["descripcion"];
            break;
        case 3:
            $PRONOSTICO[] = $r["descripcion"];
            break;
        case 4:
            $CONTROL[] = $r["descripcion"];
            break;
        default:
            # code...
            break;
    }
}
?>


<table>
    <tr>
        <thead>
            <td>SINTOMAS</td>
            <td>CAUSAS</td>
            <td>PRONÓSTICO</td>
            <?php
           //cambiar para que no muestre el cuadro de pronostico// 
            ?>
            <td>CONTROL DE PRONOSTICO</td>
        </thead>
    </tr>
    <tr>
        <th>
            <ul>
                <?php foreach ($Sintomas as $sintoma) {

                ?>
                    <li>
                        <?php
                        echo $sintoma;
                        ?>
                    </li>




                <?php } ?>
            </ul>

        </th>
        <th>
            <ul>
                <?php foreach ($CAUSAS as $causa) {

                ?>
                    <li>
                        <?php
                        echo $causa;
                        ?>
                    </li>




                <?php } ?>
            </ul>

        </th>
        <th>
            <ul>
                <?php foreach ($PRONOSTICO as $pronostico) {

                ?>
                    <li>
                        <?php
                        echo $pronostico;
                        ?>
                    </li>




                <?php } ?>
            </ul>


        </th>

        <th>
            <ul>
                <?php foreach ($CONTROL as $control) {

                ?>
                    <li>
                        <?php
                        echo $control;
                        ?>
                    </li>




                <?php } ?>
            </ul>


        </th>


    </tr>
</table>
<a href="./mostrarrealidad.php?idproyecto=<?php
echo $idproyecto;
?>" target="_blank" rel="noopener noreferrer">Obtener Descripción de la realidad Problemática</a>