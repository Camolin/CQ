<?php
// Iniciamos la sesión para acceder a las variables de sesión
session_start();

// Verificamos si existe un carrito en la sesión
if (isset($_SESSION['carrito'])) {
    // Si existe, lo eliminamos
    unset($_SESSION['carrito']); 
}

// Creamos un nuevo carrito vacío
$_SESSION['carrito'] = array();

// Redirigimos a la página de compras
header("Location: compras.php");

// Terminamos la ejecución del script
exit();
?>