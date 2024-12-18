<?php
include('../../BACKEND/CONEXION/conexion.php');

// Inicializar el array de respuesta
$response = [];

// Filtros y paginación
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5; // Número de registros por página
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Paginación (desplazamiento)
$searchAportes = isset($_GET['search_aportes']) ? mysqli_real_escape_string($conexion, $_GET['search_aportes']) : '';
$searchHistorial = isset($_GET['search_historial']) ? mysqli_real_escape_string($conexion, $_GET['search_historial']) : '';
$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'DESC'; // Orden de aportes
$orderDate = isset($_GET['orderDate']) ? $_GET['orderDate'] : 'DESC'; // Orden de fecha

// Consulta 1: Aportes totales de los socios
$queryAportes = "
    SELECT s.dni_socio, CONCAT(s.nombres, ' ', s.apellidos) AS nombre_completo, SUM(c.monto) AS aporte_total
    FROM cuota_afiliacion c
    JOIN socios s ON c.dni_socio = s.dni_socio
    WHERE s.nombres LIKE '%$searchAportes%' OR s.apellidos LIKE '%$searchAportes%' OR s.dni_socio LIKE '%$searchAportes%'
    GROUP BY s.dni_socio
    ORDER BY aporte_total $orderBy
";
$resultAportes = mysqli_query($conexion, $queryAportes);
$response['aportes'] = [];

if ($resultAportes) {
    while ($row = mysqli_fetch_assoc($resultAportes)) {
        $response['aportes'][] = [
            'dni_socio' => $row['dni_socio'],
            'nombre_completo' => $row['nombre_completo'],
            'aporte_total' => number_format($row['aporte_total'], 2)
        ];
    }
}

// Consulta 2: Historial de cuotas
$queryHistorial = "
    SELECT s.nombres, s.apellidos, c.fecha_pago, c.monto
    FROM cuota_afiliacion c
    JOIN socios s ON c.dni_socio = s.dni_socio
    WHERE s.nombres LIKE '%$searchHistorial%' OR s.apellidos LIKE '%$searchHistorial%' OR c.dni_socio LIKE '%$searchHistorial%' 
    ORDER BY c.fecha_pago $orderDate
    LIMIT $limit OFFSET $offset
";
$resultHistorial = mysqli_query($conexion, $queryHistorial);
$response['historial'] = [];

if ($resultHistorial) {
    while ($row = mysqli_fetch_assoc($resultHistorial)) {
        $response['historial'][] = [
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
            'fecha_pago' => $row['fecha_pago'],
            'monto' => number_format($row['monto'], 2)
        ];
    }
}

// Total de registros para el historial
$queryTotalHistorial = "
    SELECT COUNT(*) AS total
    FROM cuota_afiliacion c
    JOIN socios s ON c.dni_socio = s.dni_socio
    WHERE s.nombres LIKE '%$searchHistorial%' OR s.apellidos LIKE '%$searchHistorial%' OR c.dni_socio LIKE '%$searchHistorial%'
";
$resultTotalHistorial = mysqli_query($conexion, $queryTotalHistorial);

if ($resultTotalHistorial) {
    $totalHistorial = mysqli_fetch_assoc($resultTotalHistorial)['total'];
    $response['total_historial'] = $totalHistorial;
} else {
    $response['total_historial'] = 0;
}

// Enviar respuesta en formato JSON
echo json_encode($response);
?>
