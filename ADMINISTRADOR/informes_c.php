<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Cuotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
    <link rel="stylesheet" href="../CSS/informes_c.css">
</head>

<body>
    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <div class="main-content" id="mainContent">

        <div class="container mt-4">
            <div class="row">
                <!-- Contador de monto total recaudado -->
                <div class="col-md-6">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Monto Total Recaudado</h5>
                            <h3 id="contadorRecaudado" class="text-primary">S/ 0.00</h3>
                        </div>
                    </div>
                </div>
                <!-- Contador de número total de contribuyentes -->
                <div class="col-md-6">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Número Total de Contribuyentes</h5>
                            <h3 id="contadorContribuyentes" class="text-success">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
        <!-- Filtros generales -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4>Filtros Generales</h4>
            </div>
            <div class="card-body">
                <div class="row row-gap-3">
                    <!-- Filtro de búsqueda general -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">Buscar por DNI, Nombre o Apellido</label>
                        <input type="text" id="search" class="form-control" placeholder="Buscar...">
                    </div>
                    <!-- Filtro de orden de aportes -->
                    <div class="col-md-4">
                        <label for="orderBy" class="form-label">Orden de Aportes Totales</label>
                        <select id="orderBy" class="form-select">
                            <option value="DESC">Mayor a menor</option>
                            <option value="ASC">Menor a mayor</option>
                        </select>
                    </div>
                    <!-- Filtro de orden de fechas -->
                    <div class="col-md-4">
                        <label for="orderDate" class="form-label">Orden por Fecha de Pagos</label>
                        <select id="orderDate" class="form-select">
                            <option value="DESC">Más recientes</option>
                            <option value="ASC">Más antiguos</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Aportes -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4>Aportes Totales</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre Completo</th>
                                <th>Total Aportado (S/)</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAportesBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabla de Historial -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h4>Historial de Pagos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Pago</th>
                                <th>Monto (S/)</th>
                            </tr>
                        </thead>
                        <tbody id="tablaHistorialBody"></tbody>
                    </table>
                </div>
            </div>
            <!-- Filtros específicos de agrupación -->
            <div class="card-footer bg-light">
                <div class="row">
                    <!-- Límite de registros -->
                    <div class="col-md-4">
                        <label for="limitHistorial" class="form-label">Registros por Página</label>
                        <select id="limitHistorial" class="form-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <!-- Paginación -->
                    <div class="col-md-4">
                        <label for="offsetHistorial" class="form-label">Página</label>
                        <select id="offsetHistorial" class="form-select"></select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="../JS/tablas_c.js"></script>
    <script src="../JS/contadores_c.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

</body>

</html>
