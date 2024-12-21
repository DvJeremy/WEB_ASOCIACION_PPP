<?php
include("../BACKEND/CONEXION/conexion.php");

$buscar = "";
$consultaBase = "SELECT * FROM usuarios
                 INNER JOIN socios ON usuarios.dni_socio = socios.dni_socio
                 INNER JOIN tipos_socios ON socios.id_tipo_socio = tipos_socios.id_tipo_socio";

// Si no se realiza una búsqueda, simplemente usa la consulta base.
$consulta = $consultaBase;
$params = [];

// Verificar si se ha enviado el formulario de búsqueda
if (isset($_POST['buscar'])) {
    $buscar = trim($_POST['buscar']);
    if (!empty($buscar)) {
        if (is_numeric($buscar)) {
            // Buscar por ID si el valor es numérico
            $consulta .= " WHERE usuarios.id_usuario = ?";
            $params[] = (int)$buscar;
        } else {
            // Búsqueda general en múltiples campos
            $consulta .= " WHERE usuarios.username LIKE ? 
                           OR socios.nombres LIKE ? 
                           OR socios.apellidos LIKE ? 
                           OR socios.dni_socio LIKE ?";
            $likeBuscar = "%" . $buscar . "%";
            $params = array_fill(0, 4, $likeBuscar);
        }
    }
}

// Preparar la consulta
$stmt = $conexion->prepare($consulta);

if ($stmt) {
    // Asignar los parámetros si existen
    if (!empty($params)) {
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    die("Error al preparar la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <!-- Bootstrap CSS -->
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
        <h1 class="text-center mb-4">Registro de Usuarios</h1>
        <form method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por ID, username, nombre o DNI" value="<?= htmlspecialchars($buscar) ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Tipo Usuario</th>
                    <th>Estado</th>
                    <th style="width: 250px;">Opciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Verificar si hay registros
            if ($result->num_rows > 0) {
                // Iterar y mostrar los registros
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$row['id_usuario']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['tipo_usuario']}</td>
                    <td>{$row['estado_usuario']}</td>
                    <td style='width: 300px;'>
                        <a href='actualizar_usuario.php?id={$row['id_usuario']}&dni_socio={$row['dni_socio']}&id_tipo_socio={$row['id_tipo_socio']}' class='btn btn-warning btn-sm me-3'>Actualizar</a>";
            if (strcasecmp($row['estado_usuario'], 'inactivo') == 0) {
                echo "<a href='activar_usuario.php?id={$row['id_usuario']}' class='btn btn-success btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas activar este usuario?\");'>Activar</a>";
            } else {
                echo "<a href='inactivar_usuario.php?id={$row['id_usuario']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas inactivar este usuario?\");'>Inactivar</a>";
            }
            echo "</td></tr>";
        }
    } else {
        // Mensaje en caso de no tener registros
        echo "<tr><td colspan='5' class='text-center'>No hay usuarios registrados.</td></tr>";
    }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>