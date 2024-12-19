<?php
// Incluir la conexión a la base de datos
include '../../BACKEND/CONEXION/conexion.php';

// Obtener el ID del préstamo y tipo desde la solicitud
$idPrestamo = $_GET['id'];
$tipo = $_GET['tipo'];

$response = array();

// Verificar el tipo de préstamo (activo o cancelado)
if ($tipo === 'activo') {
    // Obtener los detalles del préstamo activo
    $query = "
        SELECT p.monto, p.cuota_mensual, p.tasa, p.amortizacion, p.fecha_emision, p.cuotas, p.estado_prestamo,
               GROUP_CONCAT(i.n°_cuota ORDER BY i.n°_cuota) AS cuotas_pagadas,
               GROUP_CONCAT(i.fecha_cobro ORDER BY i.n°_cuota) AS fechas_cobro,
               SUM(i.saldo_final) AS total_pagado
        FROM prestamos p
        LEFT JOIN informacion_prestamo i ON p.id_prestamo = i.id_prestamo
        WHERE p.id_prestamo = ?
        GROUP BY p.id_prestamo
    ";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idPrestamo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Calcular el interés si no se obtuvo del resultado
        $interes = ($row['monto'] * $row['tasa']) / 100;

        // Filtrar cuotas pagadas (que tengan fecha de cobro)
        $cuotasPagadas = array_filter(explode(",", $row['cuotas_pagadas']), function($cuota, $index) use ($row) {
            return !empty(explode(",", $row['fechas_cobro'])[$index]); // Filtrar las cuotas que tienen fecha de cobro
        }, ARRAY_FILTER_USE_BOTH);

        $fechasCobro = array_filter(explode(",", $row['fechas_cobro']), function($fecha) {
            return !empty($fecha); // Asegurarse de que la fecha de cobro no sea nula
        });

        // Calcular el saldo pendiente
        $cuotasAbonadas = count($cuotasPagadas);
        $saldoPendiente = $row['monto'] - ($row['cuota_mensual'] * $cuotasAbonadas);

        // Calcular las cuotas restantes
        $cuotasRestantes = $row['cuotas'] - $cuotasAbonadas;

        // Preparar la respuesta
        $response = array(
            'monto' => $row['monto'],
            'cuota_mensual' => $row['cuota_mensual'],
            'interes' => $interes,
            'amortizacion' => $row['amortizacion'],
            'fecha_emision' => $row['fecha_emision'],
            'cuotas_pagadas' => $cuotasAbonadas,
            'saldo_pendiente' => $saldoPendiente,
            'cuotas_restantes' => $cuotasRestantes,
            'historial_pagos' => array_map(function($fecha, $cuota) {
                return array('fecha_cobro' => $fecha, 'numero_cuota' => $cuota);
            }, $fechasCobro, $cuotasPagadas)
        );
    } else {
        $response['error'] = "Préstamo no encontrado o no tiene pagos registrados.";
    }

} else if ($tipo === 'cancelado') {
    // Obtener los detalles del préstamo cancelado
    $query = "
        SELECT p.monto, p.cuota_mensual, p.tasa, p.amortizacion, p.fecha_emision, p.fecha_finalizacion, p.estado_prestamo,
               GROUP_CONCAT(i.n°_cuota ORDER BY i.n°_cuota) AS cuotas_pagadas,
               GROUP_CONCAT(i.fecha_cobro ORDER BY i.n°_cuota) AS fechas_cobro,
               SUM(i.saldo_final) AS total_pagado
        FROM prestamos p
        LEFT JOIN informacion_prestamo i ON p.id_prestamo = i.id_prestamo
        WHERE p.id_prestamo = ? AND p.estado_prestamo = 'cancelado'
        GROUP BY p.id_prestamo
    ";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idPrestamo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Calcular el interés si no se obtuvo del resultado
        $interes = ($row['monto'] * $row['tasa']) / 100;

        // Preparar la respuesta
        $response = array(
            'monto' => $row['monto'],
            'cuota_mensual' => $row['cuota_mensual'],
            'interes' => $interes,
            'amortizacion' => $row['amortizacion'],
            'fecha_emision' => $row['fecha_emision'],
            'fecha_finalizacion' => $row['fecha_finalizacion'],
            'total_pagado' => $row['total_pagado'],
            'historial_pagos' => array_map(function($fecha, $cuota) {
                return array('fecha_cobro' => $fecha, 'numero_cuota' => $cuota);
            }, explode(",", $row['fechas_cobro']), explode(",", $row['cuotas_pagadas']))
        );
    } else {
        $response['error'] = "Préstamo no encontrado o ya no está cancelado.";
    }
}

// Enviar la respuesta en formato JSON
echo json_encode($response);
?>
