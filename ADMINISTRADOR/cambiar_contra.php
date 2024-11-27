<?php
// Conexión a la base de datos
include("../BACKEND/CONEXION/conexion.php");
//session_start();

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contraseña_actual = $_POST['contraseña_actual'];
    $nueva_contraseña = $_POST['nueva_contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    // Obtiene el ID del usuario de la sesión (debe estar iniciada)
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];

    // Verifica que las contraseñas coincidan
    if ($nueva_contraseña !== $confirmar_contraseña) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        exit();
    }

    // Obtiene la contraseña actual del usuario desde la base de datos
    $query = "SELECT Contraseña FROM usuario WHERE ID = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user || !password_verify($contraseña_actual, $user['Contraseña'])) {
        echo "<script>alert('La contraseña actual es incorrecta.'); window.history.back();</script>";
        exit();
    }

    // Cifra la nueva contraseña
    $nueva_contraseña_hash = password_hash($nueva_contraseña, PASSWORD_DEFAULT);

    // Actualiza la contraseña en la base de datos
    $update_query = "UPDATE usuario SET Contraseña = ? WHERE ID = ?";
    $update_stmt = $conexion->prepare($update_query);
    $update_stmt->bind_param('si', $nueva_contraseña_hash, $user_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Contraseña cambiada exitosamente.'); window.location.href='index_administrador.php';</script>";
    } else {
        echo "<script>alert('Error al cambiar la contraseña.'); window.history.back();</script>";
    }
}
?>