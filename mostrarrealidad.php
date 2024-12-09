<?php
include("./auth.php");

include("./conexion.php");
include("./cabecerainvestigador.php");
//obtener el id del investigador por si queremos usar//
$id_investigador = $_SESSION["codigo"];
$idproyecto = $_GET["idproyecto"];


//consulta de 1 a muchos para obtener todos los aportes relacionados a un proyecto(puedes usar inner join, join o where cuando comparas esas dos tablas realizas una combinacion de esas 2 tablas donde coincidan :))
$sql = "select a.*,p.* from proyecto p, aporte a where p.idproyecto=a.idproyecto and p.idproyecto=$idproyecto";
$f = mysqli_query($cn, $sql);
//creamos arreglos para capturar los datos//
$sintomas = [];
$causas = [];
$pronostico = [];


//realizo la consulta para mostrar  los datos//
$sql_pr = "select * from proyecto where idproyecto=$idproyecto";
$fila_pr = mysqli_query(
    $cn,
    $sql_pr
);
$r_pr = mysqli_fetch_assoc($fila_pr);
//buscamos el tipo de proyecto del cual esta relacionado//
$id_tipoproyecto = $r_pr["idtipoproyecto"];
$sql_tipo = "select * from tipoproyecto where idtipoproyecto=$id_tipoproyecto";
$fila_tp = mysqli_query($cn, $sql_tipo);
$r_tp = mysqli_fetch_assoc($fila_tp);
if ($r_tp["nombre"] == "Descriptivo") {
} else if ($r_tp["nombre"] == "Propositivo") {

    $control = "";
}



while ($r = mysqli_fetch_assoc($f)) {
    switch ($r["idtipoaporte"]) {
        case 1:
            $sintomas[] = $r["descripcion"];
            break;
        case 2:
            $causas[] = $r["descripcion"];
            break;
        case 3:
            $pronostico[] = $r["descripcion"];
            break;
        case 4:
            $control = $r["descripcion"];

            break;
        default:

            break;
    }
}








//obtener otra consulta para datos del pryecto//
$query = "select * from proyecto where idproyecto=$idproyecto";
$fl = mysqli_query($cn, $query);
$r_p = mysqli_fetch_assoc($fl);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>REALIDAD PROBLEMATICA</h2>
    <ul>
        <li><strong>La empresa:</strong> <?php echo $r_p["enombre"] ?>.</li>
        <li><strong>Observaciones:</strong> Se identificaron los siguientes problemas:
            <ul>
                <?php
                $x = 1;
                foreach ($sintomas as $sintoma) {


                ?>
                    <li>S<?php echo ($x) ?>:<?php
                                            echo htmlspecialchars(trim($sintoma . ","));
                                            ?></li>
                <?php
                    $x++;
                }
                ?>

            </ul>
        </li>

        <li><strong>Causas:</strong> Estos problemas se deben a:
            <ul>
                <?php
                $x = 1;
                foreach ($causas as $causa) {


                ?>
                    <li>C<?php echo ($x) ?>:<?php
                                            echo htmlspecialchars(trim($causa . ","));
                                            ?></li>
                <?php
                    $x++;
                }
                ?>

            </ul>
        </li>

        <li><strong>Impacto Fuerte:</strong>De continuar así, se esperan consecuencias como:
            <ul>
                <?php
                $x = 1;
                foreach ($pronostico as $pro) {


                ?>
                    <li>C<?php echo ($x) ?>:<?php
                                            echo htmlspecialchars(trim($pro . ","));
                                            ?></li>
                <?php
                    $x++;
                }
                ?>

            </ul>
        </li>
        <?php
        if ($r_tp["nombre"] == "Propositivo") {


        ?>
            <li><strong>Propuesta de mejora:</strong> La presente investigación propone implementar [VI] para mejorar [VD] en la empresa durante el período <?php echo htmlspecialchars(trim($r_p["periodo"])) ?>.</li>
        <?php
        }
        ?>




    </ul>

</body>

</html>