<?php
include('../../BACKEND/CONEXION/conexion.php');

// Obtener el filtro de búsqueda general
$filter = isset($_GET['filter']) ? "%" . $_GET['filter'] . "%" : '%';

// Consulta para obtener el historial de pagos (solo las cuotas abonadas)
$query_historial_pagos = "SELECT s.dni_socio, ip.n°_cuota AS numero_cuota, ip.fecha_cobro, ip.saldo_final AS cuota_abonada
                          FROM informacion_prestamo ip
                          LEFT JOIN prestamos p ON ip.id_prestamo = p.id_prestamo
                          LEFT JOIN socios s ON p.dni_socio = s.dni_socio
                          WHERE ip.estado_cuota = 'abonada' 
                          AND (CONCAT(s.nombres, ' ', s.apellidos) LIKE ? OR s.dni_socio LIKE ?)";

$stmt_historial = $conexion->prepare($query_historial_pagos);
$stmt_historial->bind_param("ss", $filter, $filter);
$stmt_historial->execute();
$result_historial = $stmt_historial->get_result();
$historial_pagos = $result_historial->fetch_all(MYSQLI_ASSOC);

// Devolver los datos en formato JSON
echo json_encode([
    'historial' => $historial_pagos
]);
?>
