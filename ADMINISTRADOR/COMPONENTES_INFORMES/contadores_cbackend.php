<?php
include('../../BACKEND/CONEXION/conexion.php'); // Conexión a la base de datos

$response = [];

// Consulta 1: Monto total recaudado
$queryMonto = "SELECT SUM(monto) AS total_recaudado FROM cuota_afiliacion";
$resultMonto = mysqli_query($conexion, $queryMonto);

if ($resultMonto) {
    $rowMonto = mysqli_fetch_assoc($resultMonto);
    $response['total_recaudado'] = $rowMonto['total_recaudado'] ?: 0;
} else {
    $response['total_recaudado'] = 'Error';
}

// Consulta 2: Número total de contribuyentes únicos
$queryContribuyentes = "SELECT COUNT(DISTINCT dni_socio) AS total_contribuyentes FROM cuota_afiliacion";
$resultContribuyentes = mysqli_query($conexion, $queryContribuyentes);

if ($resultContribuyentes) {
    $rowContribuyentes = mysqli_fetch_assoc($resultContribuyentes);
    $response['total_contribuyentes'] = $rowContribuyentes['total_contribuyentes'] ?: 0;
} else {
    $response['total_contribuyentes'] = 'Error';
}

// Enviar respuesta en formato JSON
echo json_encode($response);
?>
