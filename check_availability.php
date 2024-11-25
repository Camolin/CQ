<?php 
// Incluimos el archivo de configuración
require_once("includes/config.php");

// Verificamos la disponibilidad del email del administrador
if(!empty($_POST["emailid"])) {
    // Obtenemos el email del formulario
    $email= $_POST["emailid"];
    
    // Validamos que sea un formato de email válido
    if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
        // Si no es válido mostramos error
        echo "error : No ingresaste un correo electrónico válido.";
    }
    else {
        // Consulta SQL para buscar si existe el email
        $sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email";
        // Preparamos la consulta
        $query= $dbh -> prepare($sql);
        // Vinculamos el parámetro email
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        // Ejecutamos la consulta
        $query-> execute();
        // Obtenemos los resultados
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        
        // Si encontramos resultados
        if($query -> rowCount() > 0) {
            // El email ya existe
            echo "<span style='color:red'> el correo ya existe .</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } else{
            // El email está disponible
            echo "<span style='color:green'> Correo electrónico disponible para registrarse.</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }
}
?>
