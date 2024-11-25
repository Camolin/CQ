<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <!-- Título de la página -->
    <title>CQ | Paquetes más vistos</title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Script para ocultar URL en móviles -->
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Hojas de estilo -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style_copy.css" rel='stylesheet' type='text/css' />
    <!-- Fuentes de Google -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Animaciones -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body>
    <!-- Incluimos el header -->
    <?php include('includes/header.php'); ?>
    <!-- Banner -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
        </div>
    </div>
    <!-- Sección de paquetes -->
    <div class="rooms">
        <div class="container">
            <div class="room-bottom">
                <h3>Paquetes Turísticos Más Populares</h3>

                <?php
                // Consulta SQL para obtener los paquetes más reservados
                $sql = "SELECT tp.*, COUNT(tb.PackageId) as reservas 
                        FROM tbltourpackages tp 
                        LEFT JOIN tblbooking tb ON tp.PackageId = tb.PackageId 
                        GROUP BY tp.PackageId 
                        ORDER BY reservas DESC";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                // Si hay resultados, los mostramos
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                        <!-- Contenedor de cada paquete -->
                        <div class="rom-btm">
                            <!-- Imagen del paquete -->
                            <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                                <img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
                            </div>
                            <!-- Detalles del paquete -->
                            <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                                <h4>Nombre del paquete: <?php echo htmlentities($result->PackageName); ?></h4>
                                <h6>Tipo de paquete: <?php echo htmlentities($result->PackageType); ?></h6>
                                <p><b>Ubicación:</b> <?php echo htmlentities($result->PackageLocation); ?></p>
                                <p><b>Características:</b> <?php echo htmlentities($result->PackageFetures); ?></p>
                                <p><b>Reservas totales:</b> <?php echo htmlentities($result->reservas); ?></p>
                            </div>
                            <!-- Precio y botón de detalles -->
                            <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                                <h5>COP <?php echo htmlentities($result->PackagePrice); ?></h5>
                                <button class="btn btn-outline-success responsive-btn">
                                    <a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId); ?>" class="responsive-link">Detalles</a>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php }
                } else { ?>
                    <!-- Mensaje si no hay paquetes disponibles -->
                    <div class="alert alert-info">No hay paquetes disponibles.</div>
                <?php } ?>
            </div>


        </div>
    </div>

    <!-- Incluimos el footer y modales -->
    <?php include('includes/footer.php'); ?>
    <!-- Modal de registro -->
    <?php include('includes/signup.php'); ?>
    <!-- Modal de inicio de sesión -->
    <?php include('includes/signin.php'); ?>
    <!-- Modal de contacto -->
    <?php include('includes/write-us.php'); ?>
</body>
<!-- Script de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>