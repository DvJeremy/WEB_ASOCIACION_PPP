<?php
// Incluir la conexión a la base de datos
include '../BACKEND/CONEXION/conexion.php';

// Obtener el parámetro de búsqueda (filtro) o el DNI
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$dni = isset($_GET['dni']) ? $_GET['dni'] : '';

// Si se recibe un DNI, buscar el socio por ese DNI
if ($dni) {
    $sql = "SELECT s.dni_socio, s.nombres, s.apellidos, p.monto, COUNT(i.id_cuota) AS cuotas_pendientes, p.monto / COUNT(i.id_cuota) AS cuota_mensual
            FROM socios s
            JOIN prestamos p ON s.dni_socio = p.dni_socio
            JOIN informacion_prestamo i ON p.id_prestamo = i.id_prestamo
            WHERE p.estado_prestamo = 'activo' AND s.dni_socio = ?
            GROUP BY s.dni_socio, s.nombres, s.apellidos, p.monto";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $result = $stmt->get_result();
    $socio = $result->fetch_assoc();

    // Devolver los resultados como JSON
    echo json_encode($socio);
} else {
    // Si no se recibe un DNI, se hace la búsqueda normal con el filtro
    $sql = "SELECT s.dni_socio, s.nombres, s.apellidos, p.monto, COUNT(i.id_cuota) AS cuotas_pendientes, p.monto / COUNT(i.id_cuota) AS cuota_mensual
            FROM socios s
            JOIN prestamos p ON s.dni_socio = p.dni_socio
            JOIN informacion_prestamo i ON p.id_prestamo = i.id_prestamo
            WHERE p.estado_prestamo = 'activo'
            AND (s.dni_socio LIKE ? OR s.nombres LIKE ? OR s.apellidos LIKE ?)
            GROUP BY s.dni_socio, s.nombres, s.apellidos, p.monto
            ORDER BY s.apellidos, s.nombres";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    $searchTerm = "%" . $filtro . "%";
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Crear un array para almacenar los resultados
    $socios = [];
    while ($row = $result->fetch_assoc()) {
        $socios[] = $row;
    }

    // Devolver los resultados como JSON
    echo json_encode($socios);
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
