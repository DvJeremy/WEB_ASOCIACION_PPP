<?php
include("../BACKEND/CONEXION/conexion.php");

if (isset($_REQUEST["id"])) {
    $id_usuario = $_REQUEST["id"];

    // Verificamos si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recoger los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $cuenta = $_POST['cuenta'];
        $codigo = $_POST['codigo'];
        $dependencia = $_POST['dependencia'];
        $tipo_socio = $_POST['tipo_socio'];
        $fecha = $_POST['fecha'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $contacto = $_POST['contacto'];
        $distrito = $_POST['distrito'];
        $domicilio = $_POST['domicilio'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $contra = $_POST['contra'];
        $nueva_contra = $_POST['contra2']; // Nueva contraseña
        $tipo_usuario = $_POST['tipo_usuario'];
        $estado = $_POST['estado'];

        // Comprobamos si la nueva contraseña no está vacía
        if (!empty($nueva_contra)) {
            // Hashear la nueva contraseña
            $nueva_contra = password_hash($nueva_contra, PASSWORD_DEFAULT);
        } else {
            // Si no hay nueva contraseña, mantenemos la contraseña actual
            $nueva_contra = $contra;
        }

        // Consulta SQL para actualizar los datos del usuario
        $consulta = "
            UPDATE usuarios
            INNER JOIN socios ON usuarios.dni_socio = socios.dni_socio
            SET 
                usuarios.username = ?,
                usuarios.contra = ?,
                usuarios.tipo_usuario = ?,
                usuarios.estado_usuario = ?,
                socios.nombres = ?,
                socios.apellidos = ?,
                socios.dni_socio = ?,
                socios.numero_cuenta = ?,
                socios.codigo_universidad = ?,
                socios.dependencia = ?,
                socios.fecha_ingreso = ?,
                socios.fecha_nacimiento = ?,
                socios.num_contacto = ?,
                socios.distrito = ?,
                socios.domicilio = ?,
                socios.correo = ?,
                socios.id_tipo_socio = ? 
            WHERE usuarios.id_usuario = ?
        ";

        // Preparar la consulta
        $stmt = $conexion->prepare($consulta);
        if ($stmt) {
            // Asociar los parámetros
            $stmt->bind_param(
                "sssssssssssssssssi", 
                $usuario, 
                $nueva_contra, 
                $tipo_usuario, 
                $estado, 
                $nombre, 
                $apellido, 
                $dni, 
                $cuenta, 
                $codigo, 
                $dependencia, 
                $fecha, 
                $fechaNacimiento, 
                $contacto, 
                $distrito, 
                $domicilio, 
                $correo, 
                $tipo_socio, 
                $id_usuario
            );

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Los datos se han actualizado correctamente.";
                header("location: index_administrador.php");
            } else {
                echo "Error al actualizar los datos: " . $stmt->error;
            }

            // Cerrar la consulta
            $stmt->close();
        } else {
            die("Error al preparar la consulta: " . $conexion->error);
        }
    }

    // Consulta para obtener los datos actuales del usuario
    $consulta = "
        SELECT 
            usuarios.id_usuario,
            usuarios.username,
            usuarios.contra,
            usuarios.tipo_usuario,
            usuarios.estado_usuario,
            socios.nombres,
            socios.apellidos,
            socios.dni_socio,
            socios.numero_cuenta,
            socios.codigo_universidad,
            socios.dependencia,
            socios.fecha_ingreso,
            socios.fecha_nacimiento,
            socios.num_contacto,
            socios.distrito,
            socios.domicilio,
            socios.correo,
            socios.id_tipo_socio
        FROM usuarios
        INNER JOIN socios ON usuarios.dni_socio = socios.dni_socio
        WHERE usuarios.id_usuario = ?
    ";
    $stmt = $conexion->prepare($consulta);
    if ($stmt) {
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $con = $resultado->fetch_assoc();
        } else {
            die("No se encontró ningún usuario con el ID proporcionado.");
        }
        $stmt->close();
    } else {
        die("Error al preparar la consulta: " . $conexion->error);
    }
} else {
    die("ID de usuario no válido o no proporcionado.");
}
?>
