<?php
include("./auth.php");
include("./conexion.php");
include("cabecerainvestigador.php");

$found_investigator =
    $_SESSION["codigo"];
$sql = "select * from investigador where codigo=$found_investigator";

$fila = mysqli_query($cn, $sql);

$r = mysqli_fetch_assoc($fila);



?>
<!DOCTYPE html>
<html lang="en"></html>

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
        <label for="txtnombreP">Nombre Proyecto:</label>
        <input type="text" name="txtnombreP">

        <label for="txtnombreE">Nombre Empresa:</label>
        <input type="text" name="txtnombreE">

        <label for="txtdireccion">Direccion:</label>
        <input type="text" name="txtdireccion">

        <label for="txtPeriodo">Periodo:</label>
        <input type="text" name="txtPeriodo">

        <label for="txtBreve">Breve:</label>
        <input type="text" name="txtBreve">
        <input type="hidden" name="txtid" value="<?php
        echo $r["idinvestigador"];
        ?>">
        <input type="submit" value="Crear Proyecto">    
    

    </form>
    </center>
</body>

</html>