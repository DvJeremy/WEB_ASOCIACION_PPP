<?php
include("../BACKEND/CONEXION/conexion.php");

// Verificar si el parámetro id está presente
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consulta para actualizar el estado del usuario a 'activo'
    $sql = "UPDATE usuarios SET estado_usuario = 'Activo' WHERE id_usuario = ?";

    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($sql);
    if ($stmt) {
        // Asociar el parámetro y ejecutar
        $stmt->bind_param("i", $id_usuario);
        if ($stmt->execute()) {
            echo "<script>alert('El usuario ha sido activado exitosamente.'); window.location.href = 'crud_usuario.php';</script>";
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
