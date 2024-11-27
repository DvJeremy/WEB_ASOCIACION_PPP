<?php

include '../BACKEND/CONEXION/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener contadores
    if (isset($_POST['accion']) && $_POST['accion'] == 'obtener_contadores') {
        // ------ INICIO CONTADORES ------
        $data = [
            "prestado" => 0,
            "recaudado" => 0,
            "sociosTotales" => 0,
            "activos" => 0,
            "inactivos" => 0
        ];

        // Consulta para dinero prestado
        $queryPrestado = "SELECT SUM(monto) AS total FROM prestamos";
        $result = $conexion->query($queryPrestado);
        $data["prestado"] = $result ? (float)$result->fetch_assoc()['total'] : 0;

        // Consulta para dinero recaudado
        $queryRecaudado = "SELECT SUM(monto) AS total FROM cuota_afiliacion";
        $result = $conexion->query($queryRecaudado);
        $data["recaudado"] = $result ? (float)$result->fetch_assoc()['total'] : 0;

        // Consulta para socios totales
        $querySocios = "SELECT COUNT(*) AS total FROM socios";
        $result = $conexion->query($querySocios);
        $data["sociosTotales"] = $result ? (int)$result->fetch_assoc()['total'] : 0;

        // Consulta para socios activos
        $queryActivos = "SELECT COUNT(*) AS activos FROM usuarios WHERE estado_usuario = 'Activo'";
        $result = $conexion->query($queryActivos);
        $data["activos"] = $result ? (int)$result->fetch_assoc()['activos'] : 0;

        // Consulta para socios inactivos
        $queryInactivos = "SELECT COUNT(*) AS inactivos FROM usuarios WHERE estado_usuario = 'Inactivo'";
        $result = $conexion->query($queryInactivos);
        $data["inactivos"] = $result ? (int)$result->fetch_assoc()['inactivos'] : 0;

        echo json_encode($data);
        exit;
    }

    // ------ INICIO TABLA SOCIOS Y APORTES ---------
    if (isset($_POST['accion']) && $_POST['accion'] === 'obtener_socios_aportes') {
        $filtroBusqueda = isset($_POST['busqueda']) ? $conexion->real_escape_string($_POST['busqueda']) : ''; // Filtro de búsqueda
        $orden = isset($_POST['orden']) ? $_POST['orden'] : 'ninguno'; // Orden de los aportes
    
        // Construir la consulta SQL con los filtros y orden
        $query = "
            SELECT 
                socios.dni_socio, 
                socios.nombres, 
                socios.apellidos, 
                COALESCE(SUM(cuota_afiliacion.monto), 0) AS total_aportes
            FROM socios
            LEFT JOIN cuota_afiliacion 
            ON socios.dni_socio = cuota_afiliacion.dni_socio
            WHERE 
                (socios.nombres LIKE '%$filtroBusqueda%' 
                OR socios.apellidos LIKE '%$filtroBusqueda%' 
                OR socios.dni_socio LIKE '%$filtroBusqueda%')
            GROUP BY socios.dni_socio, socios.nombres, socios.apellidos";
    
        // Aplicar el orden a la consulta
        if ($orden == 'mayor') {
            $query .= " ORDER BY total_aportes DESC"; // Ordenar de mayor a menor
        } elseif ($orden == 'menor') {
            $query .= " ORDER BY total_aportes ASC"; // Ordenar de menor a mayor
        }
    
        $resultado = $conexion->query($query);
    
        if ($resultado) {
            $data = [];
            while ($fila = $resultado->fetch_assoc()) {
                $data[] = [
                    'dni_socio' => $fila['dni_socio'],      // DNI correcto
                    'nombres' => $fila['nombres'],          // Nombres correctos
                    'apellidos' => $fila['apellidos'],      // Apellidos correctos
                    'total_aportes' => (float) $fila['total_aportes'] // Total de aportes
                ];
            }
    
            echo json_encode(['estado' => 'ok', 'data' => $data]);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error en la consulta.']);
        }
    
        exit;
    }

    // ------ FIN TABLA SOCIOS Y APORTES ---------

    // ------ INICIO HISTORIAL DE ACTIVIDAD DE USUARIOS ---------
    if ($_POST['accion'] === 'obtener_historial_actividad') {
        $filtroBusqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : ''; // Filtro de búsqueda

        // Consulta para el historial de pagos
        $queryHistorial = "
            SELECT 
                socios.dni_socio, 
                socios.nombres, 
                socios.apellidos, 
                cuota_afiliacion.fecha_pago, 
                cuota_afiliacion.monto
            FROM cuota_afiliacion
            LEFT JOIN socios ON cuota_afiliacion.dni_socio = socios.dni_socio
            WHERE 
                (socios.nombres LIKE '%$filtroBusqueda%' 
                OR socios.apellidos LIKE '%$filtroBusqueda%' 
                OR socios.dni_socio LIKE '%$filtroBusqueda%')
            ORDER BY cuota_afiliacion.fecha_pago DESC
        ";

        $resultado = $conexion->query($queryHistorial);

        if ($resultado) {
            $data = [];
            while ($fila = $resultado->fetch_assoc()) {
                $data[] = [
                    'dni_socio' => $fila['dni_socio'],
                    'nombres' => $fila['nombres'],
                    'apellidos' => $fila['apellidos'],
                    'fecha_pago' => $fila['fecha_pago'],
                    'monto' => (float) $fila['monto']
                ];
            }

            echo json_encode(['estado' => 'ok', 'data' => $data]);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error en la consulta del historial.']);
        }

        exit;
    }
    // ------ FIN HISTORIAL DE ACTIVIDAD DE USUARIOS ---------

}

?>
