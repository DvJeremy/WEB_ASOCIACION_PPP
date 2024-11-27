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

        <!-- ------ INICIO TABLA SOCIOS Y FILTROS -------- -->
        <div class="row">
            <!-- Tabla de socios y aportes -->
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Socios y Aportes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tabla-socios">
                                <thead class="table-dark">
                                    <tr>
                                        <th>DNI</th>
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
            </div>
            
            <!-- Filtros -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Filtros</h5>
                    </div>
                    <div class="card-body">
                        <!-- Filtro de Fecha de Pago -->
                        <div class="mb-4">
                            <label for="fechaPago" class="form-label">Fecha de Pago</label>
                            <input type="date" id="fechaPago" class="form-control">
                        </div>

                        <!-- Otros Filtros -->
                        <div class="mb-4">
                            <label for="busqueda" class="form-label">Buscar</label>
                            <input type="text" id="busqueda" class="form-control" placeholder="DNI, Nombre o Apellido">
                        </div>

                        <!-- Ordenamiento -->
                        <div>
                            <label for="orden" class="form-label">Ordenar por Aportes</label>
                            <select id="orden" class="form-select">
                                <option value="ninguno">Ninguno</option>
                                <option value="mayor">Mayor a Menor</option>
                                <option value="menor">Menor a Mayor</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        <!-- ------ FIN TABLA SOCIOS Y FILTROS -------- -->
        
        <!-- ------ INICIO HISTORIAL DE ACTIVIDAD DE USUARIOS ------ -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Historial de Actividad de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tabla-historial">
                                <thead class="table-dark">
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Fecha de Pago</th>
                                        <th>Monto (S/)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Filas de la tabla generadas dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ------ FIN HISTORIAL DE ACTIVIDAD DE USUARIOS ------ -->

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../JS/informes.js"></script>

</body>
</html>