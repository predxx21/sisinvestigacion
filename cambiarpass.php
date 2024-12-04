<?php
include("./auth.php");
include("./conexion.php");
$new_password = $_POST["txtnew_password"];
$repeat_password = $_POST["txtrepeat_password"];
$id = $_POST["txtid"];
echo $id;
echo $new_password;
echo $repeat_password;
if($new_password==$repeat_password){
    $sql = "UPDATE usuario SET password='$new_password' WHERE codigo=$id";


    mysqli_query($cn, $sql);



    header('location: principal_i.php');
}else{
 
}


?>