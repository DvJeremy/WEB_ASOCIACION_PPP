<?php
// Conexión a la base de datos
include '../BACKEND/CONEXION/conexion.php';

// Consulta para obtener socios activos
$query = "
    SELECT s.dni_socio, s.nombre_socio, s.apellidos_socio
    FROM socios s
    INNER JOIN usuarios u ON s.id_usuario = u.id_usuario
    WHERE u.estado_usuario = 'Activo'
";

$result = $conexion->query($query);

// Verificar si hay resultados
$socios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $socios[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode($socios);

// Cerrar la conexión
$conexion->close();
?>
