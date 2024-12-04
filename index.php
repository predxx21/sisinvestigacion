<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Trabajo de Investigacion</title>
</head>
<body>


<center>
<img src="img/Logo_UNJFSC.png" width="180" height="180">
<br>
<h1>TRABAJO DE INVESTIGACION</h1>
<br><br>

<form action="p_login.php" method="post" autocomplete="off">

    <fieldset id="grupito">
        
            <input type="text" name="txtcodigo" id="txt" autocomplete="off" maxlength="9" placeholder="Codigo">
            <br><br>
            <input type="password" name="txtpass" id="pwd" autocomplete="off" maxlength="9" placeholder="Contraseña">
            <br><br>
            <input type="submit" value="Iniciar Sesion" id="btn">
            <br><br>
            <br><br>
            <a href="registroAsesor.php" id="btn-admin">
            ¿Eres Asesor y no tienes una cuenta? Registrate
            </a>
            <a href="registroInvestigador.php" id="btn-admin">
            ¿Eres Investigador y no tienes una cuenta? Registrate
            </a>

    </fieldset>

</form>

</center>
    
</body>
</html>