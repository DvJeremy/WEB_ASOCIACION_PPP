<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
    <link rel="stylesheet" href="../CSS/generar_p.css">
</head>
<body>

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

    <!-- Contenido Principal -->
    <div class="main-content" id="mainContent">

    <div class="container my-4">
        <h2 class="mb-4">Generar Préstamo</h2>
        
        <!-- Contenedor de filtros y tablas -->
        <div class="row">
            <!-- Filtro y Tabla de Socios -->
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input 
                            type="text" 
                            id="searchSocioInput" 
                            class="form-control" 
                            placeholder="Buscar Socio por DNI, nombres o apellidos"
                        >
                    </div>
                </div>
                <h4>Seleccionar Socio</h4>
                <div class="table-responsive" id="socioContainer">
                    <table id="socioTable" class="table table-bordered table-striped">
                        <tbody>
                            <!-- Los datos de los socios se cargarán dinámicamente aquí -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Filtro y Tabla de Garantes -->
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input 
                            type="text" 
                            id="searchGaranteInput" 
                            class="form-control" 
                            placeholder="Buscar Garante por DNI, nombres o apellidos"
                        >
                    </div>
                </div>
                <h4>Seleccionar Garantes</h4>
                <div class="table-responsive" id="garanteContainer">
                    <table id="garanteTable" class="table table-bordered table-striped">
                        <tbody>
                            <!-- Los datos de los garantes se cargarán dinámicamente aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Contenedor de Tags -->
        <div id="tagsContainer" class="mt-4">
            <!-- Los tags dinámicos aparecerán aquí -->
        </div>
    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../JS/generar_p.js"></script>

</body>
</html>
