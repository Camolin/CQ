<?php
// Iniciar sesión
session_start();
// Desactivar reporte de errores
error_reporting(0);
// Incluir archivo de configuración
include('includes/config.php');
// Verificar si el usuario está logueado
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  // Obtener el ID del issue
  $iid = intval($_GET['iid']);
  // Si se envió el formulario
  if (isset($_POST['submit2'])) {
    $remark = $_POST['remark'];

    // Actualizar la observación en la base de datos
    $sql = "UPDATE tblissues SET AdminRemark=:remark WHERE  id=:iid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':remark', $remark, PDO::PARAM_STR);
    $query->bindParam(':iid', $iid, PDO::PARAM_STR);
    $query->execute();

    // Mensaje de éxito
    $msg = "Observación Actualizado exitosamente";
  }

?>
  <!-- Scripts JavaScript -->
  <script language="javascript" type="text/javascript">
    // Función para cerrar ventana
    function f2() {
      window.close();
    }
    ser

    // Función para imprimir
    function f3() {
      window.print(); 
    }
  </script>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Compatible con actualizaciones</title>
    <!-- Archivos CSS -->
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="anuj.css" rel="stylesheet" type="text/css">
  </head>

  <body>

    <!-- Contenedor principal -->
    <div style="margin-left:50px;">
      <!-- Formulario de actualización -->
      <form name="updateticket" id="updateticket" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <!-- Título -->
          <tr height="50">
            <td colspan="2" class="fontkink2" style="padding-left:0px;">
              <div class="fontpink2"> <b>Observación de actualización !</b></div>
            </td>

          </tr>

          <!-- Mensajes de error/éxito -->
          <tr>
            <td colspan="2" ">  <?php if ($error) { ?><div class=" errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
    </div><?php } else if ($msg) { ?><div class="succWrap"><strong>EXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?></td>

  </tr>

  <tbody>
    <?php
    // Consultar datos del issue
    $sql = "SELECT * from tblissues where id=:iid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':iid', $iid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Si hay resultados
    if ($query->rowCount() > 0) {
      foreach ($results as $result) {

        // Si no hay observación previa
        if ($result->AdminRemark == "") {
    ?>
          <!-- Formulario para nueva observación -->
          <tr>
            <td class="fontkink1">Observación:</td>
            <td class="fontkink" align="justify"><span class="fontkink">
                <textarea cols="50" rows="7" name="remark" required="required"></textarea>
              </span></td>
          </tr>
          <tr>
            <td class="fontkink1">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="fontkink"> </td>
            <td class="fontkink"> <input type="submit" name="submit2" value="update" size="40" style="cursor: pointer;" /></td>
          </tr>
        <?php } else { ?>
          <!-- Mostrar observación existente -->
          <tr>
            <td class="fontkink1"><b>Observación:</b></td>
            <td class="fontkink" align="justify"><?php echo htmlentities($result->AdminRemark); ?></td>
          </tr>
          <tr>
            <td class="fontkink1"><b>fecha observación:</b></td>
            <td class="fontkink" align="justify"><?php echo htmlentities($result->AdminremarkDate); ?></td>
          </tr>
    <?php }
      }
    } ?>

    </table>
    </form>
    </div>

  </body>

  </html>
<?php } ?>