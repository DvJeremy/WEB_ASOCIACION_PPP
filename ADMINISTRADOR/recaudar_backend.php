<?php
// Conexión a la base de datos
include '../BACKEND/CONEXION/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodificar el JSON recibido
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['socios']) || !is_array($input['socios'])) {
        echo json_encode(["error" => "Datos inválidos."]);
        exit;
    }

    $socios = $input['socios'];
    $fechaPago = date('Y-m-d'); // Fecha actual

    // Iniciar transacción
    $conexion->begin_transaction();

    try {
        foreach ($socios as $socio) {
            $dni = $conexion->real_escape_string($socio['dni']);
            $monto = intval($socio['monto']);

            // Insertar en la tabla cuota_afiliacion
            $query = "
                INSERT INTO cuota_afiliacion (dni_socio, monto, fecha_pago)
                VALUES ('$dni', $monto, '$fechaPago')
            ";
            if (!$conexion->query($query)) {
                throw new Exception("Error al insertar cuota: " . $conexion->error);
            }
        }

        // Confirmar transacción
        $conexion->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conexion->rollback();
        echo json_encode(["error" => $e->getMessage()]);
    }

    $conexion->close();
    exit;
}

// Código para manejar solicitudes GET
$query = "
    SELECT s.dni_socio, s.nombres, s.apellidos
    FROM socios s
    INNER JOIN usuarios u ON s.dni_socio = u.dni_socio
    WHERE u.estado_usuario = 'Activo'
";

$result = $conexion->query($query);

$socios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $socios[] = $row;
    }
} else {
    echo json_encode(["error" => "No hay socios activos."]);
    exit;
}

echo json_encode($socios);
$conexion->close();
?>
