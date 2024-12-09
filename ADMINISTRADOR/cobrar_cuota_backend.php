<?php
include '../BACKEND/CONEXION/conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$id_prestamo = isset($data['id_prestamo']) ? $data['id_prestamo'] : null;
$dni_socio = isset($data['dni_socio']) ? $data['dni_socio'] : null;

if ($id_prestamo && $dni_socio) {
    // Seleccionar la cuota más antigua pendiente
    $sql = "SELECT id_cuota, n°_cuota FROM informacion_prestamo 
            WHERE id_prestamo = ? AND estado_cuota = 'pendiente' ORDER BY n°_cuota ASC LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id_prestamo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Obtener la cuota más antigua pendiente
        $row = $result->fetch_assoc();
        $id_cuota = $row['id_cuota'];
        $n_cuota = $row['n°_cuota'];

        // Obtener la fecha actual para registrar el cobro
        $fecha_cobro = date('Y-m-d');

        // Actualizar el estado de la cuota a 'abonada' y registrar la fecha de cobro
        $sql_update = "UPDATE informacion_prestamo SET estado_cuota = 'abonada', fecha_cobro = ? WHERE id_cuota = ?";
        $stmt_update = $conexion->prepare($sql_update);
        if ($stmt_update) {
            $stmt_update->bind_param('ss', $fecha_cobro, $id_cuota); // Bind the fecha_cobro
            $stmt_update->execute();
        }

        // Verificar si estamos en la última cuota
        $sql_verificar = "SELECT MAX(n°_cuota) AS ultima_cuota FROM informacion_prestamo WHERE id_prestamo = ?";
        $stmt_verificar = $conexion->prepare($sql_verificar);
        $stmt_verificar->bind_param('i', $id_prestamo);
        $stmt_verificar->execute();
        $result_verificar = $stmt_verificar->get_result();
        $row_verificar = $result_verificar->fetch_assoc();

        // Si la cuota actual es la última, cambiar el estado del préstamo a 'cancelado'
        if ($n_cuota == $row_verificar['ultima_cuota']) {
            // Si estamos en la última cuota, cambiar el estado del préstamo
            $fecha_finalizacion = date('Y-m-d');
            $sql_cancelar = "UPDATE prestamos SET estado_prestamo = 'cancelado', fecha_finalizacion = ? WHERE id_prestamo = ?";
            $stmt_cancelar = $conexion->prepare($sql_cancelar);
            $stmt_cancelar->bind_param('si', $fecha_finalizacion, $id_prestamo);
            if ($stmt_cancelar->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Cuota cobrada correctamente. El préstamo ha sido cancelado.',
                    'prestamo_cancelado' => true
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Hubo un error al actualizar el estado del préstamo.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Cuota cobrada correctamente.',
                'prestamo_cancelado' => false
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No hay cuotas pendientes para este préstamo.']);
    }
    
    $stmt->close();
    $conexion->close();
}
?>
