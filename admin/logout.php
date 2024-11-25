<?php
// Iniciar la sesión
session_start(); 

// Limpiar el array de sesión
$_SESSION = array();

// Si se usan cookies de sesión
if (ini_get("session.use_cookies")) {
    // Obtener los parámetros de la cookie
    $params = session_get_cookie_params();
    
    // Eliminar la cookie de sesión
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Eliminar la variable de sesión del login
unset($_SESSION['alogin']);

// Destruir la sesión
session_destroy();

// Redireccionar al index
header("location:index.php"); 
?>
