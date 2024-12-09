<?php
include("./auth.php");
include("./conexion.php");
include("./cabecerainvestigador.php");
$sql="select * from proyecto";
$f=mysqli_query($cn,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="./vercuadro.php" method="post">
<label for="txtidproyecto">Ver el cuadro de diagnostico de</label>
  <select name="lstproyecto" id="lstproyecto">
<?php while ($r = mysqli_fetch_assoc($f)) { ?>
<option value="<?php
    echo $r["idproyecto"]
    ?>"><?php 
    echo $r["pnombre"]
    ?></option>

<?php }?>

  </select>
  <input type="submit"  value="Visualizar">
   </form> 
</body>
</html>