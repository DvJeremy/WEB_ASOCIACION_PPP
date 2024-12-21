<?php
include("../BACKEND/CONEXION/conexion.php");

// Verificamos si el parámetro id está presente
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consulta para actualizar el estado del usuario a 'inactivo'
    $sql = "UPDATE usuarios SET estado_usuario = 'Inactivo' WHERE id_usuario = ?";

    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($sql);
    if ($stmt) {
        // Asociar el parámetro y ejecutar
        $stmt->bind_param("i", $id_usuario);
        if ($stmt->execute()) {
            echo "<script>alert('El usuario ha sido marcado como inactivo.'); window.location.href = 'crud_usuario.php';</script>";
        } else {
            echo "Error al actualizar el estado: " . $stmt->error;
        }
        $stmt->close();
    } else {
        die("Error al preparar la consulta: " . $conexion->error);
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
