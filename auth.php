<?php
session_start();

// Verifica si la sesión está activa
if (!isset($_SESSION["auth"]) || $_SESSION["auth"] != 1) {
    header('location: index.php');
    exit();
}

// También verifica si el código está definido (opcional)
if (!isset($_SESSION["codigo"])) {
    header('location: index.php');
    exit();
}
?>
