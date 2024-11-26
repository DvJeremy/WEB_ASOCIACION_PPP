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

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_usuario.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_usuario.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

    <!-- Contenido Principal -->
    <div class="main-content" id="mainContent">
        <?php include '../COMPONENTES_COMPARTIDOS/simulador.php'; ?>
        <!-- Aquí va el contenido de tu dashboard -->
    </div>

</body>
</html>