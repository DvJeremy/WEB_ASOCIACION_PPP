<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Cuotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
    <link rel="stylesheet" href="../CSS/informes.css">
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

        <div class="container">
            <div class="row">
                <!-- Filtro y controles de paginación -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Informe de Aportes y Historial</h3>
                        </div>
                        <div class="card-body">
                            <div class="row row-gap">
                                <!-- Filtro de búsqueda general -->
                                <div class="col-md-3">
                                    <label for="search" class="form-label">Buscar por DNI, Nombre o Apellido</label>
                                    <input type="text" id="search" class="form-control" placeholder="Buscar...">
                                </div>
                                <!-- Filtro de número de registros -->
                                <div class="col-md-2">
                                    <label for="limit" class="form-label">Mostrar Registros</label>
                                    <select id="limit" class="form-select">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                </div>
                                <!-- Filtro de paginación -->
                                <div class="col-md-2">
                                    <label for="offset" class="form-label">Página</label>
                                    <select id="offset" class="form-select">
                                        <option value="0">1</option>
                                        <option value="5">2</option>
                                        <option value="10">3</option>
                                        <option value="15">4</option>
                                    </select>
                                </div>
                                <!-- Filtro de orden de aportes -->
                                <div class="col-md-2">
                                    <label for="orderBy" class="form-label">Orden de Aportes</label>
                                    <select id="orderBy" class="form-select">
                                        <option value="DESC">Descendente</option>
                                        <option value="ASC">Ascendente</option>
                                    </select>
                                </div>
                                <!-- Filtro de orden de fecha -->
                                <div class="col-md-2">
                                    <label for="orderDate" class="form-label">Orden de Fecha</label>
                                    <select id="orderDate" class="form-select">
                                        <option value="DESC">Descendente</option>
                                        <option value="ASC">Ascendente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Aportes Totales -->
                <div class="col-12">
                    <div class="table-container">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5>Aportes Totales de los Socios</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>DNI</th>
                                            <th>Nombre Completo</th>
                                            <th>Aporte Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaAportesBody">
                                        <!-- Aquí se cargarán los datos de los aportes -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Historial de Pagos -->
                <div class="col-12 mt-4">
                    <div class="table-container">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h5>Historial de Pagos</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nombre Completo</th>
                                            <th>Fecha de Pago</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaHistorialBody">
                                        <!-- Aquí se cargarán los datos del historial de pagos -->
                                    </tbody>
                                </table>
                            </div>
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
