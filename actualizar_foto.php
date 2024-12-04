<?php

include("cabecerainvestigador.php");
include("auth.php");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Foto</title>
    <link rel="stylesheet" href="css/actualizar.css">
</head>
<body>
    
    <main>
        <section class="update-section">
            <h2>Actualizar Foto de Perfil</h2>
            <form action="actualizarfoto.php" method="post" enctype="multipart/form-data">
                <label for="profile-pic">Escoge Foto:</label>
                <input type="file" id="profile-pic" name="profile-pic" accept="image/*" required>
                
                <button type="submit">Actualizar Foto</button>
            </form>
        </section>
    </main>
</body>
</html>
