<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préstamos - Cobrar Cuotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
</head>

<body>

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

    <div class="main-content" id="mainContent">
        <!-- Filtro para buscar socios -->
        <div class="container mt-4">
            <h4>Filtrar Socios</h4>
            <form id="filterForm">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" id="filtro" class="form-control" placeholder="Buscar por DNI, Nombres o Apellidos">
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de socios con préstamos activos -->
        <div class="container mt-4">
            <h4>Socios con Préstamos Activos</h4>
            <table class="table table-striped" id="sociosTable">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Monto del Préstamo</th>
                        <th>Cuotas Pendientes</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se cargarán los socios desde el backend -->
                </tbody>
            </table>
        </div>

        <!-- Lista de socios seleccionados -->
        <div class="container mt-4">
            <h4>Socios Seleccionados para Cobro</h4>
            <ul id="selectedSocios" class="list-group">
                <!-- Los socios seleccionados se agregarán aquí -->
            </ul>
        </div>
    </div>

    <script src="../JS/cobrar_prestamo.js"></script>

</body>

</html>