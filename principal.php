<?php



include("cabecera.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1" cellspacing="0" align="center" bgcolor="lightblue" width="600">
    <tr>
        <td rowspan="6" align="center" valign="middle" >
            <img src="imgalumnos/<?php echo $r["codalumno"]?>.png" width="200" height="200">
        </td>
        <td align="right">DNI</td>
        <td><?php echo $r["codalumno"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">APELLIDO PATERNO</td>
        <td><?php echo $r["apaterno"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">APELLIDO MATERNO</td>
        <td><?php echo $r["amaterno"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">NOMBRES</td>
        <td><?php echo $r["nombre"];  ?></td>
    </tr>
    <tr>
        
        <td align="right">ESPECIALIDAD</td>
        <td><?php echo $r["escuela"];  ?></td>
    </tr>
    <tr>
    
        <td align="right">CONDICION</td>
        <td><?php echo $r["aula"];  ?></td>
    </tr>
</table>
    
</body>
</html>