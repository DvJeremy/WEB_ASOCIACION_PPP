<?php
include '../../BACKEND/CONEXION/conexion.php';

// Consulta para obtener el monto total prestado
$query_monto_total = "SELECT SUM(monto) AS total FROM prestamos";
$result_monto_total = mysqli_query($conexion, $query_monto_total);
$data_monto_total = mysqli_fetch_assoc($result_monto_total);

// Consulta para obtener la cantidad de préstamos activos
$query_prestamos_activos = "SELECT COUNT(*) AS activos FROM prestamos WHERE estado_prestamo = 'activo'";
$result_prestamos_activos = mysqli_query($conexion, $query_prestamos_activos);
$data_prestamos_activos = mysqli_fetch_assoc($result_prestamos_activos);

// Consulta para obtener el beneficio total de los préstamos activos
$query_beneficio_total = "SELECT SUM(interes * cuotas) AS beneficio_total FROM prestamos WHERE estado_prestamo = 'activo'";
$result_beneficio_total = mysqli_query($conexion, $query_beneficio_total);
$data_beneficio_total = mysqli_fetch_assoc($result_beneficio_total);

// Consulta para obtener la cantidad de préstamos finalizados
$query_prestamos_finalizados = "SELECT COUNT(*) AS finalizados FROM prestamos WHERE estado_prestamo = 'cancelado'";
$result_prestamos_finalizados = mysqli_query($conexion, $query_prestamos_finalizados);
$data_prestamos_finalizados = mysqli_fetch_assoc($result_prestamos_finalizados);

// Retornar los resultados en formato JSON
echo json_encode([
    'monto_total_prestado' => $data_monto_total['total'],
    'prestamos_activos' => $data_prestamos_activos['activos'],
    'beneficio_total' => $data_beneficio_total['beneficio_total'],
    'prestamos_finalizados' => $data_prestamos_finalizados['finalizados']
]);
?>
