<?php
include('../../BACKEND/CONEXION/conexion.php');

// Verifica la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Filtro de búsqueda (si se proporciona)
$filter = isset($_GET['filter']) ? "%" . $_GET['filter'] . "%" : '%';

// Consulta SQL que obtiene los préstamos activos y cancelados, con filtro por nombre, apellidos o DNI
$query = "
    SELECT s.dni_socio, CONCAT(s.nombres, ' ', s.apellidos) AS socio, 
           p.id_prestamo, p.monto, p.fecha_emision, p.fecha_finalizacion, p.estado_prestamo
    FROM prestamos p
    JOIN socios s ON p.dni_socio = s.dni_socio
    WHERE CONCAT(s.nombres, ' ', s.apellidos) LIKE ? OR s.dni_socio LIKE ?";

// Prepara y ejecuta la consulta
$stmt = $conexion->prepare($query);
$stmt->bind_param("ss", $filter, $filter);
$stmt->execute();
$result = $stmt->get_result();

// Agrupar los resultados
$activos = [];
$cancelados = [];

while ($row = $result->fetch_assoc()) {
    if ($row['estado_prestamo'] == 'activo') {
        $activos[] = $row;
    } else {
        $cancelados[] = $row;
    }
}

// Devolver los resultados como JSON
echo json_encode([
    'activos' => $activos,
    'cancelados' => $cancelados
]);

?>
