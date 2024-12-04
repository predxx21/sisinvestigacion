<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Imagen</title>
</head>
<body>
    <h1>Actualizar Imagen de Perfil</h1>
    <form action="p_actualizarimg_i.php" method="POST" enctype="multipart/form-data">
        <label for="imagen">Seleccionar una imagen (PNG):</label><br>
        <input type="file" name="imagen" id="imagen" accept=".png" required><br><br>
        <button type="submit">Actualizar Imagen</button>
    </form>
</body>
</html>
