<?php 
// Credenciales de la base de datos
// DB credentials.
define('DB_HOST','localhost'); // Host de la base de datos
define('DB_USER','root');      // Usuario de la base de datos
define('DB_PASS','');          // Contraseña de la base de datos 
define('DB_NAME','tms');       // Nombre de la base de datos

// Establecer conexión con la base de datos
// Establish database connection.
try
{
    // Crear nueva conexión PDO con los parámetros definidos
    // y configurar codificación UTF-8
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
    // Si hay error en la conexión, mostrar mensaje y salir
    exit("Error: " . $e->getMessage());
}
?>