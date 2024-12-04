<?php

include("auth.php");
include("./conexion.php");
include("cabecerainvestigador.php");
$INVESTIGADOR = $_SESSION["codigo"];
$query = "select * from usuario where codigo='$INVESTIGADOR'";
$f = mysqli_query($cn, $query);
$r = mysqli_fetch_assoc($f);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    <link rel="stylesheet" href="css/actualizar.css">
</head>

<body>

    <main>
        <section class="update-section">
            <h2>Actualizar Contraseña</h2>
            <form action="cambiarpass.php" method="post">
                <label for="txtnew_password">Nuevo Password:</label>
                <input type="password" id="txtnew_password" name="txtnew_password" placeholder="Ingresa nueva contraseña" maxlength="8" required value="<?php
                                                                                                                                            echo $r["password"];
                                                                                                                                            ?>">

                <label for="txtrepeat_password">Repetir Password:</label>
                <input type="password" id="txtrepeat_password" name="txtrepeat_password" placeholder="Repite tu contraseña" maxlength="8" required
                    value="<?php
                            echo $r["password"];

                            ?>">
                 <input type="hidden" name="txtid" value="<?php
                                                            echo $r["codigo"];
                 ?>">
                <button type="submit">Actualizar Contraseña</button>
            </form>
        </section>
    </main>
</body>

</html>