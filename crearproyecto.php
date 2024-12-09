<?php
include("./auth.php");
include("./conexion.php");
include("cabecerainvestigador.php");
if (isset($_GET["idproyecto"])) {
    //obtengo el id//
    $id_proyecto = $_GET["idproyecto"];
    //realizo la consulta para mostrar  los datos//
    $sql_pr = "select * from proyecto where idproyecto=$id_proyecto";

    $fila_pr = mysqli_query(
        $cn,
        $sql_pr
    );

    $r_pr = mysqli_fetch_assoc($fila_pr);
}
$found_investigator =
    $_SESSION["codigo"];
$sql = "select * from investigador where codigo=$found_investigator";

$fila = mysqli_query($cn, $sql);

$r = mysqli_fetch_assoc($fila);



?>
<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloform.css">

    <title>Document</title>
</head>

<body>
    <br>
    <center>
        <form action="./p_crearProyecto.php" method="post">
            <label for="lsttipoproyecto">Tipo Proyecto:</label>
            <select name="lsttipoproyecto" id="lsttipoproyecto">
                <?php
                $sqld = "select * from tipoproyecto ";
                $fd = mysqli_query($cn, $sqld);

                if (isset($id_proyecto)) {
                    //EDIT//
                    $tipo_proyecto = $r_pr["idtipoproyecto"];
                    $sql_tp = "select * from tipoproyecto where idtipoproyecto=$tipo_proyecto";

                    $fila_tp = mysqli_query(
                        $cn,
                        $sql_tp
                    );

                    $r_tp = mysqli_fetch_assoc($fila_tp);
                ?>
                    <option value="<?php echo $r_tp["idtipoproyecto"] ?>" selected>
                        <?php echo $r_tp["nombre"] ?>
                    </option>

                    <?php
                    while ($r_t = mysqli_fetch_assoc($fd)) {
                        if ($r_tp["nombre"] != $r_t["nombre"]) {


                    ?>
                            <option value="<?php echo $r_t["idtipoproyecto"] ?>"><?php
                                                                                    echo $r_t["nombre"];

                                                                                    ?></option>
                        <?php

                        }
                    }
                } else {
                    //CREATE//
                    while ($r_t = mysqli_fetch_assoc($fd)) {

                        ?>
                        <option value="<?php echo $r_t["idtipoproyecto"] ?>"><?php
                                                                                echo $r_t["nombre"];

                                                                                ?></option>
                <?php
                    }
                }

                ?>
            </select>
            <label for="txtnombreP">Nombre Proyecto:</label>
            <input type="text" name="txtnombreP"
                value="<?php echo isset($id_proyecto) ? htmlspecialchars($r_pr["pnombre"]) : null; ?>">
            <!--Puedes usar trim para los espacios-->
            <label for="txtnombreE">Nombre Empresa:</label>
            <input type="text" name="txtnombreE" value="<?php echo isset($id_proyecto) ? htmlspecialchars($r_pr["enombre"]) : null;  ?>">

            <label for="txtdireccion">Direccion:</label>
            <input type="text" name="txtdireccion" value="<?php echo isset($id_proyecto) ? htmlspecialchars($r_pr["direccion"]) : null; ?>">

            <label for="txtPeriodo">Periodo:</label>
            <input type="text" name="txtPeriodo"
                value="<?php
                        //&& = si es verdadero evalua la segunda(si id_proyecto esta definido evalua la segunda pero si es false evalua la primera y devuelve nada)
                        // || = si es verdadero evalua el primero(Si id_proyecto esta definido manda nada pero si es false evalua la segunda condicon)
                        echo isset($id_proyecto) ? htmlspecialchars($r_pr["periodo"]) : null;
                        ?>">
            <input type="hidden" name="txtid" value="<?php
                                                        echo $r["idinvestigador"];
                                                        ?>">
            <?php if (isset($id_proyecto)): ?>
                <input type="hidden" name="idproyecto" value="<?php echo htmlspecialchars($r_pr["idproyecto"]); ?>">
            <?php endif; ?>
            <input type="submit" value="
            <?php
            $changes = isset($_GET["idproyecto"]) ? "Editar proyecto" : "Crear Proyecto";
            echo $changes;
            ?>
            ">


        </form>
    </center>
</body>

</html>