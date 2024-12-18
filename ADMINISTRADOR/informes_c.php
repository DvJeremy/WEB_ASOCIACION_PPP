<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Cuotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
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

        <div class="container mt-4">
            <div class="row">
                <!-- Filtro y opciones de paginación -->
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="search">Buscar por DNI, nombre o apellido</label>
                            <input type="text" id="search" class="form-control" placeholder="Buscar por nombre, apellido o DNI">
                        </div>

                        <div class="form-group">
                            <label for="limit">Agrupar por registros por página</label>
                            <select id="limit" class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="offset">Seleccionar página</label>
                            <select id="offset" class="form-control">
                                <option value="0">Página 1</option>
                                <option value="5">Página 2</option>
                                <option value="10">Página 3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Aportes -->
                <div class="col-md-12 mb-4">
                    <h4>Aportes Totales de los Socios</h4>
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Aporte Total</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAportesBody">
                            <!-- Los datos se cargarán aquí -->
                        </tbody>
                    </table>
                </div>

                <!-- Tabla de Historial de Cuotas -->
                <div class="col-md-12">
                    <h4>Historial de Cuotas</h4>
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody id="tablaHistorialBody">
                            <!-- Los datos se cargarán aquí -->
                        </tbody>
                    </table>
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
