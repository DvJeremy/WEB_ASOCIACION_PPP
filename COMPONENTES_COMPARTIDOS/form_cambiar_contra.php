<?php 
include("../BACKEND/CONEXION/conexion.php");
session_start();
   if(isset($_SESSION['tex'])){
   $texto=$_SESSION['tex'];}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
</head>
<body>
    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>
    <div class="main-content" id="mainContent">

    <div class="container mt-5 d-flex justify-content-center">
        <div class="card  p-4 bg-light w-50" style="font-family:Century Gothic;">
            <h2 class="text-center mb-4">Cambiar Contraseña</h2>
            <form action="cambiar_contra.php" method="POST">
                <!-- Campo para la contraseña actual -->
                <div class="mb-3 w-50">
                    <label for="contraseña_actual" class="form-label">Contraseña Actual</label>
                    <input type="password" class="form-control" id="contraseña_actual" name="contraseña_actual" required>
                </div>
                <!-- Campo para la nueva contraseña -->
                <div class="mb-3 w-50">
                    <label for="nueva_contraseña" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="nueva_contraseña" name="nueva_contraseña" required>
                </div>
                <!-- Campo para confirmar la nueva contraseña -->
                <div class="mb-3 w-50">
                    <label for="confirmar_contraseña" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control" id="confirmar_contraseña" name="confirmar_contraseña" required>
                </div>
                <!-- Botones de cambiar contraseña y cancelar -->
                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                    <a href="index_administrador.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>

