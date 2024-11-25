<?php
// Iniciamos la sesión para manejar el carrito
session_start();

// Verificamos si ya existe un carrito en la sesión
if (isset($_SESSION["carrito"])) {
    // Obtenemos el carrito existente
    $carrito_mio = $_SESSION["carrito"];
    // Si se recibió un nuevo producto por POST
    if (isset($_POST["titulo"])) {
        // Obtenemos los datos del producto
        $titulo = $_POST["titulo"];
        $precio = $_POST["precio"];
        $cantidad = $_POST["cantidad"];
        $num = 0;
        // Agregamos el nuevo producto al carrito
        $carrito_mio[] = array("titulo" => $titulo, "precio" => $precio, "cantidad" => $cantidad);
    }
} else {
    // Si no existe carrito, creamos uno nuevo con el producto recibido
    $titulo = $_POST["titulo"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $carrito_mio[] = array("titulo" => $titulo, "precio" => $precio, "cantidad" => $cantidad);
}

// Guardamos el carrito actualizado en la sesión
$_SESSION["carrito"] = $carrito_mio;

// Redirigimos a la página anterior
header("Location: " . $_SERVER["HTTP_REFERER"]);
