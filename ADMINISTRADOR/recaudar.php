<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recaudar Cuota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
    <link rel="stylesheet" href="../CSS/recaudar.css">
</head>

<body>

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

    <div class="main-content" id="mainContent">
        <div class="container">
            <h1 class="my-4">Recaudar Cuota</h1>

            <!-- Filtro para la tabla -->
            <div class="mb-3">
                <input type="text" id="filtro-socios" class="form-control" placeholder="Buscar por DNI, nombres o apellidos">
            </div>

            <!-- Tabla de Socios -->
            <h3>Socios Activos</h3>
            <table class="table" id="tabla-socios">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los socios se cargarán aquí con JavaScript -->
                </tbody>
            </table>

            <br>
            <input type="file" id="cargarExcel" accept=".xlsx, .xls" />
            <button id="cargarListado" class="btn btn-primary">Cargar listado</button>

            <!-- Lista de Socios Seleccionados -->
            <h3 class="mt-4">Socios Seleccionados</h3>
            <ul class="list-group" id="lista-socios">
                <!-- Los socios seleccionados aparecerán aquí -->
            </ul>

            <div class="d-flex justify-content-end mt-4">
                <button id="recaudarButton" class="btn btn-primary">Recaudar</button>
            </div>
            <br><br>
        </div>

        <!-- Ventana emergente para seleccionar el monto -->
        <div class="modal fade" id="montoModal" tabindex="-1" aria-labelledby="montoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="montoModalLabel">Seleccionar Monto de Cuota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Seleccione el monto de la cuota que se le cobrará al socio:</p>
                        <button class="btn btn-primary" id="monto-20">S/ 20</button>
                        <button class="btn btn-primary" id="monto-40">S/ 40</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/recaudar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
</body>

</html>