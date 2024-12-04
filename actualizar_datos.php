<?php

include("cabecerainvestigador.php");
include("auth.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <link rel="stylesheet" href="css/actualizar.css">
</head>
<body>
   
    <main>
        <section class="update-section">
            <h2>Actualizar Datos Específicos</h2>
            <form action="p_actualizar.php" method="post">
                <label for="cell">Celular:</label>
                <input type="text" id="cell" name="cell" placeholder="Ingresa tu celular" required>
                
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" placeholder="Ingresa tu dirección" required>
                
                <button type="submit">Actualizar Datos</button>
            </form>
        </section>
    </main>
</body>
</html>
