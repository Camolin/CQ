<?php
// Iniciar sesión
session_start();
// Desactivar reporte de errores
error_reporting(0);
// Incluir archivo de configuración
include('includes/config.php');
// Verificar si el usuario está logueado
if (strlen($_SESSION['alogin']) == 0) {
    // Redireccionar si no está logueado
    header('location:index.php');
} else {
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <!-- Título de la página -->
        <title>CQ | Administrador gestionar reservas</title>
        <!-- Meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Script para ocultar barra URL -->
        <script type="application/x-javascript">
            addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>

        <!-- Archivos CSS -->
        <link href="css/style_copy.css" rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="css/morris.css" type="text/css" />
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <!-- Estilos de tablas -->
        <link rel="stylesheet" type="text/css" href="css/table-style_copy.css" />
        <link rel="stylesheet" type="text/css" href="css/basictable.css" />
        <script type="text/javascript" src="js/jquery.basictable.min.js"></script>
        <!-- Configuración de tablas responsivas -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#table').basictable();

                $('#table-breakpoint').basictable({
                    breakpoint: 768
                });

                $('#table-swap-axis').basictable({
                    swapAxis: true
                });

                $('#table-force-off').basictable({
                    forceResponsive: false
                });

                $('#table-no-resize').basictable({
                    noResize: true
                });

                $('#table-two-axis').basictable();

                $('#table-max-height').basictable({
                    tableWrapper: true
                });
            });
        </script>
        <!-- Fuentes de Google -->
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!-- Iconos -->
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
        <!-- Estilos para mensajes de error y éxito -->
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>

        <!-- Bootstrap y otros estilos -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/style_copy.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Chart.js para gráficos -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    </head>

    <body>

        <body>
            <!-- Contenedor principal -->
            <div class="page-container">
                <div class="left-content">
                    <div class="mother-grid-inner">
                        <!-- Incluir header -->
                        <?php include('includes/header.php'); ?>
                        <div class="clearfix"> </div>
                    </div>
                    <!-- Breadcrumb -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Inicio</a><i class="fa fa-angle-right"></i>Gráficos</li>
                    </ol>
                    <!-- Contenedor de gráficos -->
                    <div class="agile-grids">
                        <div class="agile-tables">
                            <div class="w3l-table-info">
                                <h2>Gráficos de Chompi en Quibdó</h2>

                                <!-- Primera gráfica - Estado de reservas -->
                                <div style="width:100%; max-width:600px; margin:20px auto;">
                                    <canvas id="statusChart"></canvas>
                                </div>

                                <!-- Segunda gráfica - Lugares turísticos -->
                                <div style="width:100%; max-width:600px; margin:20px auto;">
                                    <canvas id="locationChart"></canvas>
                                </div>

                                <!-- Tercera gráfica - Tipos de paquetes -->
                                <div style="width:100%; max-width:600px; margin:20px auto;">
                                    <canvas id="packageTypeChart"></canvas>
                                </div>

                                <!-- Cuarta gráfica - Reservas por mes -->
                                <div style="width:100%; max-width:600px; margin:20px auto;">
                                    <canvas id="monthlyChart"></canvas>
                                </div>

                                <?php
                                // Consulta para el estado de reservas
                                $sql1 = "SELECT COUNT(*) as total, status FROM tblbooking GROUP BY status";
                                $query1 = $dbh->prepare($sql1);
                                $query1->execute();
                                $statusResults = $query1->fetchAll(PDO::FETCH_OBJ);

                                // Arrays para almacenar datos de estado
                                $statusLabels = array();
                                $statusData = array();
                                $statusColors = array('#65CEA7', '#FC8213', '#E74C3C');

                                // Procesar resultados de estado
                                foreach ($statusResults as $result) {
                                    if ($result->status == 0) {
                                        array_push($statusLabels, 'Pendientes');
                                    } else if ($result->status == 1) {
                                        array_push($statusLabels, 'Confirmados');
                                    } else {
                                        array_push($statusLabels, 'Cancelados');
                                    }
                                    array_push($statusData, $result->total);
                                }

                                // Consulta para lugares turísticos
                                $sql2 = "SELECT tbltourpackages.PackageName, COUNT(*) as total 
                            FROM tblbooking 
                            JOIN tbltourpackages ON tblbooking.PackageId = tbltourpackages.PackageId 
                            GROUP BY tbltourpackages.PackageName";
                                $query2 = $dbh->prepare($sql2);
                                $query2->execute();
                                $locationResults = $query2->fetchAll(PDO::FETCH_OBJ);

                                // Arrays para almacenar datos de ubicación
                                $locationLabels = array();
                                $locationData = array();

                                // Procesar resultados de ubicación
                                foreach ($locationResults as $result) {
                                    array_push($locationLabels, $result->PackageName);
                                    array_push($locationData, $result->total);
                                }

                                // Consulta para tipos de paquetes
                                $sql3 = "SELECT tbltourpackages.PackageType, COUNT(*) as total 
                            FROM tblbooking 
                            JOIN tbltourpackages ON tblbooking.PackageId = tbltourpackages.PackageId 
                            GROUP BY tbltourpackages.PackageType";
                                $query3 = $dbh->prepare($sql3);
                                $query3->execute();
                                $packageResults = $query3->fetchAll(PDO::FETCH_OBJ);

                                // Arrays para almacenar datos de paquetes
                                $packageLabels = array();
                                $packageData = array();

                                // Procesar resultados de paquetes
                                foreach ($packageResults as $result) {
                                    array_push($packageLabels, $result->PackageType);
                                    array_push($packageData, $result->total);
                                }

                                // Consulta para reservas por mes
                                $sql4 = "SELECT MONTH(FromDate) as mes, COUNT(*) as total 
                                        FROM tblbooking 
                                        GROUP BY MONTH(FromDate) 
                                        ORDER BY mes";
                                $query4 = $dbh->prepare($sql4);
                                $query4->execute();
                                $monthlyResults = $query4->fetchAll(PDO::FETCH_OBJ);

                                // Arrays para almacenar datos mensuales
                                $monthlyLabels = array();
                                $monthlyData = array();
                                
                                // Array de nombres de meses
                                $meses = array(
                                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 
                                    4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
                                    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 
                                    10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                );

                                // Procesar resultados mensuales
                                foreach ($monthlyResults as $result) {
                                    array_push($monthlyLabels, $meses[$result->mes]);
                                    array_push($monthlyData, $result->total);
                                }
                                ?>

                                <script>
                                    // Gráfica de estado de reservas
                                    var ctx1 = document.getElementById("statusChart").getContext("2d");
                                    new Chart(ctx1, {
                                        type: "pie",
                                        data: {
                                            labels: <?php echo json_encode($statusLabels); ?>,
                                            datasets: [{
                                                backgroundColor: <?php echo json_encode($statusColors); ?>,
                                                data: <?php echo json_encode($statusData); ?>
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Estado de Reservas de Paquetes Turísticos'
                                            }
                                        }
                                    });

                                    // Gráfica de lugares turísticos
                                    var ctx2 = document.getElementById("locationChart").getContext("2d");
                                    new Chart(ctx2, {
                                        type: "pie",
                                        data: {
                                            labels: <?php echo json_encode($locationLabels); ?>,
                                            datasets: [{
                                                backgroundColor: [
                                                    '#FF6384',
                                                    '#36A2EB',
                                                    '#FFCE56',
                                                    '#4BC0C0',
                                                    '#9966FF',
                                                    '#FF9F40'
                                                ],
                                                data: <?php echo json_encode($locationData); ?>
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Reservas por Destino Turístico'
                                            }
                                        }
                                    });

                                    // Gráfica de tipos de paquetes
                                    var ctx3 = document.getElementById("packageTypeChart").getContext("2d");
                                    new Chart(ctx3, {
                                        type: "pie",
                                        data: {
                                            labels: <?php echo json_encode($packageLabels); ?>,
                                            datasets: [{
                                                backgroundColor: [
                                                    '#8BC34A',
                                                    '#FFA800',
                                                    '#1b93e1',
                                                    '#e74c3c',
                                                    '#9C27B0',
                                                    '#FF5722'
                                                ],
                                                data: <?php echo json_encode($packageData); ?>
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Reservas por Tipo de Paquete'
                                            }
                                        }
                                    });

                                    // Gráfica de reservas por mes
                                    var ctx4 = document.getElementById("monthlyChart").getContext("2d");
                                    new Chart(ctx4, {
                                        type: "bar",
                                        data: {
                                            labels: <?php echo json_encode($monthlyLabels); ?>,
                                            datasets: [{
                                                label: 'Número de Reservas',
                                                backgroundColor: '#3498db',
                                                data: <?php echo json_encode($monthlyData); ?>
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Reservas por Mes'
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- Incluir footer -->
                    <?php include('includes/footer.php'); ?>
                </div>
            </div>
            <!-- Incluir menú lateral -->
            <?php include('includes/sidebarmenu.php'); ?>
        </body>

    </body>

    </html>
<?php } ?>