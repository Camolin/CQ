<?php
// Iniciamos la sesión para manejar variables de sesión del usuario
session_start();
// Desactivamos el reporte de errores por seguridad
error_reporting(0);
// Incluimos el archivo de configuración con las credenciales de la base de datos
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <!-- Título de la página -->
    <title>CQ | Nuestros merch</title>
    <!-- Meta tags para configuración de viewport y codificación -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Script para ocultar la barra de URL en dispositivos móviles -->
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Enlaces a hojas de estilo locales -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style_copy.css" rel='stylesheet' type='text/css' />
    <!-- Enlaces a fuentes de Google -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <!-- Enlace a Font Awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Scripts de jQuery y Bootstrap -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Enlace a Bootstrap 5 desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Archivos para animaciones -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <!-- Inicialización de la librería WOW para animaciones -->
    <script>
        new WOW().init();
    </script>
</head>

<body>
    <!-- Incluimos el header del sitio -->
    <?php include('includes/header.php'); ?>
    <!-- Banner -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
        </div>
    </div>
    <!-- /banner -->

    <?php
    // Obtenemos el carrito de la sesión o inicializamos un array vacío
    $carrito_mio = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
    // Inicializamos contadores
    $total_cantidad = 0;
    $total_precio = 0;

    // Si el carrito no está vacío, calculamos totales
    if (!empty($carrito_mio)) {
        foreach ($carrito_mio as $item) {
            if (isset($item['cantidad'])) {
                $total_cantidad += $item['cantidad'];
                $total_precio += ($item['precio'] * $item['cantidad']);
            }
        }
    }

    ?>

    <!-- Botón del carrito de compras -->
    <div class="container mt-3 mb-4">
        <div class="d-flex justify-content-start">
            <button type="button" class="btn btn-success position-relative rounded-circle p-3" data-bs-toggle="modal" data-bs-target="#modales">
                <i class="fa fa-shopping-cart fa-lg"></i>
            </button>
            <p>
            <?php echo $total_cantidad; ?>
            </p>
        </div>
    </div>

    <!-- Modal del carrito -->
    <div class="modal" id="modales" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Carrito de compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="p-2">
                            <ul class="list-group mb-3">
                                <?php
                                // Si existe el carrito en la sesión
                                if (isset($_SESSION["carrito"])) {
                                    $total = 0;
                                    // Recorremos los items del carrito
                                    for ($i = 0; $i < count($carrito_mio); $i++) {
                                        if ($carrito_mio[$i]["titulo"] != null) {
                                ?>
                                            <!-- Mostramos cada item del carrito -->
                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                <div class="row col-12">
                                                    <div class="col-6" style="align-items: left; color: #000000;">
                                                        <h6 class="my-0">Cantidad: <?php echo $carrito_mio[$i]["cantidad"]; ?>: <?php echo $carrito_mio[$i]["titulo"]; ?></h6>
                                                    </div>

                                                    <div class="col-6" style="align-items: right; color: #000000;">
                                                        <span class="text-muted" style="align-items: right; color: #000000;">Precio: <?php echo $carrito_mio[$i]["precio"]; ?></span>
                                                    </div>

                                                </div>

                                            </li>
                                <?php
                                            // Calculamos el total
                                            $total = $total + $carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"];
                                        }
                                    }
                                }
                                ?>
                                <!-- Mostramos el total del carrito -->
                                <li class="list-group-item d-flex justify-content-between">
                                    <span style="text-align: left; color: #000000;">Total (COP)</span>
                                    <strong style="text-align: right; color: #000000;">
                                        <?php
                                        // Calculamos el total final
                                        if (isset($_SESSION["carrito"])) {
                                            $total = 0;
                                            for ($i = 0; $i < count($carrito_mio); $i++) {
                                                if ($carrito_mio[$i] != null) {
                                                    $total = $total + $carrito_mio[$i]["precio"] * $carrito_mio[$i]["cantidad"];
                                                }
                                            }
                                        }
                                        echo $total;
                                        ?>
                                       
                                    </strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Footer del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="borrarc.php" method="POST">
                    <button type="submit" class="btn btn-success">Vaciar Carrito</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Contenido Principal -->
    <div class="rooms">
        <div class="container">
            <div class="room-bottom">
                <h3>Nuestros Productos</h3>
                <!-- Contenedor de productos -->
                <div class="row">
                    <!-- Tarjeta 1 - Camiseta -->
                    <div class="col-md-4 mb-4">
                        <div class="card wow fadeInLeft animated" data-wow-delay=".5s">
                            <form id="form" name="form" method="post" action="carrito.php">
                                <input name="precio" type="hidden" id="precio" value="45000">
                                <input name="titulo" type="hidden" id="titulo" value="Camiseta Chompi en Quibdó">
                                <input name="cantidad" type="hidden" id="cantidad" value="1" class="form-control">
                                <img src="images/2.png" class="card-img-top" alt="Producto 1">
                                <div class="card-body">
                                    <h5 class="card-title">Camiseta Chompi en Quibdó</h5>
                                    <p class="card-text">Camiseta 100% algodón con diseño exclusivo de Chompi.</p>
                                    <h6 class="text-success">COP 45,000</h6>
                                    <button class="btn btn-outline-success px-4 py-2 mt-3">
                                        <a href="#" style="text-decoration: none; color: green;">Comprar</a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tarjeta 2 - Gorra -->
                    <div class="col-md-4 mb-4">
                        <div class="card wow fadeInUp animated" data-wow-delay=".5s">
                            <form id="form" name="form" method="post" action="carrito.php">
                                <input name="precio" type="hidden" id="precio" value="35000">
                                <input name="titulo" type="hidden" id="titulo" value="Gorra Quibdó">
                                <input name="cantidad" type="hidden" id="cantidad" value="1" class="form-control">
                                <img src="images/5.png" class="card-img-top" alt="Producto 2">
                                <div class="card-body">
                                    <h5 class="card-title">Gorra Quibdó</h5>
                                    <p class="card-text">Gorra ajustable con el logo bordado de Chompi en Quibdó.</p>
                                    <h6 class="text-success">COP 35,000</h6>
                                    <button class="btn btn-outline-success px-4 py-2 mt-3">
                                        <a href="#" style="text-decoration: none; color: green;">Comprar</a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tarjeta 3 - Taza -->
                    <div class="col-md-4 mb-4">
                        <div class="card wow fadeInRight animated" data-wow-delay=".5s">
                            <form id="form" name="form" method="post" action="carrito.php">
                                <input name="precio" type="hidden" id="precio" value="25000">
                                <input name="titulo" type="hidden" id="titulo" value="Taza Chompi">
                                <input name="cantidad" type="hidden" id="cantidad" value="1" class="form-control">
                                <img src="images/3.png" class="card-img-top" alt="Producto 3">
                                <div class="card-body">
                                    <h5 class="card-title">Taza Chompi</h5>
                                    <p class="card-text">Taza cerámica con diseño colorido de Chompi en Quibdó.</p>
                                    <h6 class="text-success">COP 25,000</h6>
                                    <button class="btn btn-outline-success px-4 py-2 mt-3">
                                        <a href="#" style="text-decoration: none; color: green;">Comprar</a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Fila adicional de productos -->
                <div class="row justify-content-center align-items-center">
                    <!-- Tarjeta 4 - Llavero -->
                    <div class="col-md-4 mb-4">
                        <div class="card wow fadeInLeft animated" data-wow-delay=".5s">
                            <form id="form" name="form" method="post" action="carrito.php">
                                <input name="precio" type="hidden" id="precio" value="15000">
                                <input name="titulo" type="hidden" id="titulo" value="Llavero Chompi">
                                <input name="cantidad" type="hidden" id="cantidad" value="1" class="form-control">
                                <img src="images/4.png" class="card-img-top" alt="Producto 4">
                                <div class="card-body">
                                    <h5 class="card-title">Llavero Chompi</h5>
                                    <p class="card-text">Llavero metálico con diseño del logo de Chompi en Quibdó.</p>
                                    <h6 class="text-success">COP 15,000</h6>
                                    <button class="btn btn-outline-success px-4 py-2 mt-3">
                                        <a href="#" style="text-decoration: none; color: green;">Comprar</a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tarjeta 5 - Bolsa -->
                    <div class="col-md-4 mb-4">
                        <div class="card wow fadeInUp animated" data-wow-delay=".5s">
                            <form id="form" name="form" method="post" action="carrito.php">
                                <input name="precio" type="hidden" id="precio" value="55000">
                                <input name="titulo" type="hidden" id="titulo" value="Mochila Quibdó">
                                <input name="cantidad" type="hidden" id="cantidad" value="1" class="form-control">
                                <img src="images/1.png" class="card-img-top" alt="Producto 5">
                                <div class="card-body">
                                    <h5 class="card-title">Bolsa Quibdó</h5>
                                    <p class="card-text">Bolsa reciclable con estampado exclusivo de la ciudad.</p>
                                    <h6 class="text-success">COP 55,000</h6>
                                    <button class="btn btn-outline-success px-4 py-2 mt-3">
                                        <a href="#" style="text-decoration: none; color: green;">Comprar</a>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Contenido Principal -->

    <!-- Incluimos el footer y otros componentes -->
    <?php include('includes/footer.php'); ?>
    <!-- Formulario de registro -->
    <?php include('includes/signup.php'); ?>
    <!-- Formulario de inicio de sesión -->
    <?php include('includes/signin.php'); ?>
    <!-- Formulario de contacto -->
    <?php include('includes/write-us.php'); ?>

    <!-- Script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>