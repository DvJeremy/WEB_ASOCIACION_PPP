<?php
include '../BACKEND/CONEXION/conexion.php';

$type = $_GET['type'] ?? '';

if ($type === 'socios') {
    $query = "SELECT dni_socio AS dni, CONCAT(nombres, ' ', apellidos) AS name FROM socios";
} elseif ($type === 'garantes') {
    $query = "SELECT dni_garante AS dni, CONCAT(nombres, ' ', apellidos) AS name FROM garantes";
} else {
    echo json_encode([]);
    exit;
}

$result = $conexion->query($query);
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>
