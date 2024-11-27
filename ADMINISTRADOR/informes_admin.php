<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
</head>
<body>

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

    <!-- Contenido Principal -->
    <div class="main-content" id="mainContent">
            <br><br>
                <!-- ------ INICIO CONTADORES ------ -->
                <div class="row text-center mb-5">
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Dinero Prestado</h5>
                        <p class="card-text h2" id="dineroPrestado">S/ 0.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Dinero Recaudado</h5>
                        <p class="card-text h2" id="dineroRecaudado">S/ 0.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title">Socios Totales</h5>
                        <p class="card-text h2" id="sociosTotales">0</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger shadow">
                    <div class="card-body">
                        <h5 class="card-title">Socios Activos/Inactivos</h5>
                        <p class="card-text h2" id="sociosActivosInactivos">0/0</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ------ FIN CONTADORES ------ -->

        <!-- ------ INICIO TABLA SOCIOS Y APORTES --------- -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Socios y Aportes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tabla-socios">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Total Aportes (S/)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas de la tabla generadas dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ------ FIN TABLA SOCIOS Y APORTES --------- -->

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../JS/informes.js"></script>

</body>
</html>