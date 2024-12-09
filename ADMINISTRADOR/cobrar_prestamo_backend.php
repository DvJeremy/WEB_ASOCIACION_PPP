<?php
include '../BACKEND/CONEXION/conexion.php';

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
$dni = isset($_GET['dni']) ? $_GET['dni'] : null;
$id_prestamo = isset($_GET['id_prestamo']) ? $_GET['id_prestamo'] : null;
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'cancelar' && $id_prestamo) {
    // Cancelar el préstamo
    $fecha_actual = date('Y-m-d');
    $sql = "UPDATE prestamos 
            SET estado_prestamo = 'cancelado', fecha_finalizacion = ? 
            WHERE id_prestamo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('si', $fecha_actual, $id_prestamo);
    if ($stmt->execute()) {
        // Cambiar estado de las cuotas a abonadas
        $sql_cuotas = "UPDATE informacion_prestamo 
                       SET estado_cuota = 'abonada' 
                       WHERE id_prestamo = ?";
        $stmt_cuotas = $conexion->prepare($sql_cuotas);
        $stmt_cuotas->bind_param('i', $id_prestamo);
        $stmt_cuotas->execute();
        
        echo json_encode(['success' => true, 'message' => 'Préstamo cancelado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al cancelar el préstamo.']);
    }
    $stmt->close();
    $stmt_cuotas->close();
    $conexion->close();
    exit();
}

if ($dni) {
    // Obtener información del socio para un DNI específico
    $sql = "SELECT p.id_prestamo, s.dni_socio, s.nombres, s.apellidos, p.monto, 
                   COUNT(i.id_cuota) AS cuotas_pendientes, p.cuota_mensual
            FROM socios s
            JOIN prestamos p ON s.dni_socio = p.dni_socio
            JOIN informacion_prestamo i ON p.id_prestamo = i.id_prestamo
            WHERE p.estado_prestamo = 'activo'
            AND i.estado_cuota = 'pendiente'  -- Solo contar cuotas pendientes
            AND s.dni_socio = ?
            GROUP BY p.id_prestamo, s.dni_socio, s.nombres, s.apellidos, p.monto";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $dni);
} else {
    // Obtener todos los socios con préstamos activos con filtro
    $sql = "SELECT p.id_prestamo, s.dni_socio, s.nombres, s.apellidos, p.monto, 
                   COUNT(i.id_cuota) AS cuotas_pendientes, p.cuota_mensual
            FROM socios s
            JOIN prestamos p ON s.dni_socio = p.dni_socio
            JOIN informacion_prestamo i ON p.id_prestamo = i.id_prestamo
            WHERE p.estado_prestamo = 'activo'
            AND i.estado_cuota = 'pendiente'  -- Solo contar cuotas pendientes
            AND (s.dni_socio LIKE ? OR s.nombres LIKE ? OR s.apellidos LIKE ?)
            GROUP BY p.id_prestamo, s.dni_socio, s.nombres, s.apellidos, p.monto";
    $stmt = $conexion->prepare($sql);
    $searchTerm = "%" . $filtro . "%";
    $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

$socios = [];
while ($row = $result->fetch_assoc()) {
    $socios[] = $row;
}

echo json_encode($socios);

$stmt->close();
$conexion->close();
?>
