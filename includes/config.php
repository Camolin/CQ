<?php 
// DB credentials.
// Define las credenciales de la base de datos
define('DB_HOST','localhost'); // Host de la base de datos
define('DB_USER','root');      // Usuario de la base de datos
define('DB_PASS','');          // Contraseña de la base de datos 
define('DB_NAME','tms');       // Nombre de la base de datos

// Establish database connection.
// Establece la conexión con la base de datos
try
{
    // Crea una nueva instancia de PDO para conectar a la base de datos MySQL
    // Configura el conjunto de caracteres a UTF-8
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
    // Si hay un error en la conexión, muestra el mensaje y termina la ejecución
    exit("Error: " . $e->getMessage());
}
?>