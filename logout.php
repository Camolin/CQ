<?php
// Iniciamos la sesión
session_start(); 

// Limpiamos el array de sesión
$_SESSION = array();

// Si hay cookies de sesión activas
if (ini_get("session.use_cookies")) {
    // Obtenemos los parámetros de la cookie
    $params = session_get_cookie_params();
    // Eliminamos la cookie de sesión
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Eliminamos la variable de login
unset($_SESSION['login']);

// Destruimos la sesión
session_destroy();

// Redirigimos al index
header("location:index.php"); 
?>
