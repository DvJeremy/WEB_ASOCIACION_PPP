<?php
// Incluir archivo de conexión
include('../BACKEND/CONEXION/conexion.php');

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si la conexión es válida
if (!$conexion) {
    echo json_encode(['status' => 'error', 'message' => 'Conexión a la base de datos fallida']);
    exit;
}

// Obtener datos de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Validar datos recibidos
if (!isset($data['monto'], $data['cuotas'], $data['cuotaMensual'], $data['tasa'], $data['interes'], $data['amortizacion'], $data['dniSocio'])) {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit;
}

// Asignar valores
$monto = $data['monto'];
$cuotas = $data['cuotas'];
$cuotaMensual = $data['cuotaMensual'];
$tasa = $data['tasa'];
$interes = $data['interes'];
$amortizacion = $data['amortizacion'];
$dniSocio = $data['dniSocio'];
$dniGarante1 = isset($data['dniGarante1']) ? $data['dniGarante1'] : null;
$dniGarante2 = isset($data['dniGarante2']) ? $data['dniGarante2'] : null;

$fechaEmision = date('Y-m-d'); // Fecha actual
$estadoPrestamo = 'pendiente'; // Estado inicial
$fechaFinalizacion = null; // Inicialmente null

// Preparar consulta para insertar en la tabla prestamos
$stmt = $conexion->prepare("INSERT INTO prestamos (monto, fecha_emision, cuotas, cuota_mensual, tasa, interes, amortizacion, estado_prestamo, fecha_finalizacion, dni_socio, dni_garante1, dni_garante2) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Error al preparar consulta']);
    exit;
}

// Enlazar parámetros
$stmt->bind_param("dsidddddssis", $monto, $fechaEmision, $cuotas, $cuotaMensual, $tasa, $interes, $amortizacion, $estadoPrestamo, $fechaFinalizacion, $dniSocio, $dniGarante1, $dniGarante2);

// Ejecutar la consulta
if ($stmt->execute()) {
    $idPrestamo = $stmt->insert_id; // Obtener el ID del préstamo generado
    echo json_encode(['status' => 'success', 'message' => 'Préstamo registrado con éxito', 'id_prestamo' => $idPrestamo]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al insertar préstamo']);
}

// Cerrar conexiones
$stmt->close();
$conexion->close();
?>
