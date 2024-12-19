<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Cuotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
    <link rel="stylesheet" href="../CSS/informes_p.css">
    <link rel="stylesheet" href="../CSS/info_p.css">
</head>

<body>
    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <div class="main-content" id="mainContent">

        <div class="container my-4">
            <div class="row">
                <!-- Monto Total Prestado -->
                <div class="col-md-3">
                    <div class="card text-bg-primary mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Monto Total Prestado</h5>
                            <p class="card-text" id="montoTotalPrestado">S/ 0.00</p>
                        </div>
                    </div>
                </div>
                <!-- Préstamos Activos -->
                <div class="col-md-3">
                    <div class="card text-bg-success mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Préstamos Activos</h5>
                            <p class="card-text" id="prestamosActivos">0</p>
                        </div>
                    </div>
                </div>
                <!-- Beneficio Total -->
                <div class="col-md-3">
                    <div class="card text-bg-warning mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Beneficio Generado</h5>
                            <p class="card-text" id="beneficioTotal">S/ 0.00</p>
                        </div>
                    </div>
                </div>
                <!-- Préstamos Finalizados -->
                <div class="col-md-3">
                    <div class="card text-bg-danger mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Préstamos Finalizados</h5>
                            <p class="card-text" id="prestamosFinalizados">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h3 class="text-center">Informe de Préstamos</h3>
            <input type="text" id="filterInput" class="form-control" placeholder="Buscar por socio (DNI, nombre)">
            <div id="contenedorSocios" class="mt-4"></div>
        </div>

        <!-- Historial de Pagos (solo cuotas abonadas) -->
        <div class="container my-4">
            <h3 class="mb-4">Historial de Cobros</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>DNI</th>
                            <th>N° Cuota</th>
                            <th>Fecha de Cobro</th>
                            <th>Cuota Abonada</th>
                        </tr>
                    </thead>
                    <tbody id="tablaHistorial">
                        <!-- Los datos se cargarán aquí -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination" id="pagination">
                <!-- Paginación se generará aquí -->
            </ul>
        </nav>

    </div>

    <!-- Modal de detalles del préstamo -->
    <div class="modal fade" id="prestamoModal" tabindex="-1" aria-labelledby="prestamoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="prestamoModalLabel">Información del Préstamo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se insertarán los detalles del préstamo -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/tablas_p.js"></script>
    <script src="../JS/tac_p.js"></script>
    <script src="../JS/info_p.js"></script>
    <script src="../JS/contadores_p.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

</body>

</html>