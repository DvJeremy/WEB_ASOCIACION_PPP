<?php
// Conexión a la base de datos
include '../BACKEND/CONEXION/conexion.php';

// Consulta para obtener los socios activos
$query = "
    SELECT s.dni_socio, s.nombres, s.apellidos
    FROM socios s
    INNER JOIN usuarios u ON s.dni_socio = u.dni_socio
    WHERE u.estado_usuario = 'Activo'
";

// Ejecutar la consulta
$result = $conexion->query($query);

// Verificar si hay resultados
$socios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $socios[] = $row;
    }
} else {
    // Si no hay resultados, devolver un mensaje de error
    echo json_encode(["error" => "No hay socios activos."]);
    exit;
}

// Devolver los datos en formato JSON
echo json_encode($socios);

// Cerrar la conexión
$conexion->close();
?>
