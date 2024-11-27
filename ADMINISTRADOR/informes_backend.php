<?php

include '../BACKEND/CONEXION/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        $result = $conn->query($queryPrestado);
        $data["prestado"] = $result ? (float)$result->fetch_assoc()['total'] : 0;

        // Consulta para dinero recaudado
        $queryRecaudado = "SELECT SUM(monto) AS total FROM cuota_afiliacion";
        $result = $conn->query($queryRecaudado);
        $data["recaudado"] = $result ? (float)$result->fetch_assoc()['total'] : 0;

        // Consulta para socios totales
        $querySocios = "SELECT COUNT(*) AS total FROM socios";
        $result = $conn->query($querySocios);
        $data["sociosTotales"] = $result ? (int)$result->fetch_assoc()['total'] : 0;

        // Consulta para socios activos
        $queryActivos = "SELECT COUNT(*) AS activos FROM usuarios WHERE estado_usuario = 'Activo'";
        $result = $conn->query($queryActivos);
        $data["activos"] = $result ? (int)$result->fetch_assoc()['activos'] : 0;

        // Consulta para socios inactivos
        $queryInactivos = "SELECT COUNT(*) AS inactivos FROM usuarios WHERE estado_usuario = 'Inactivo'";
        $result = $conn->query($queryInactivos);
        $data["inactivos"] = $result ? (int)$result->fetch_assoc()['inactivos'] : 0;

        echo json_encode($data);
        exit;
    }

    // ------ INICIO TABLA SOCIOS Y APORTES ---------
    if ($_POST['accion'] === 'obtener_socios_aportes') {
        $query = "
            SELECT 
                socios.nombres AS nombres, 
                socios.apellidos AS apellidos, 
                COALESCE(SUM(cuota_afiliacion.monto), 0) AS total_aportes
            FROM socios
            LEFT JOIN cuota_afiliacion 
            ON socios.dni_socio = cuota_afiliacion.dni_socio
            GROUP BY socios.dni_socio, socios.nombres, socios.apellidos
            ORDER BY total_aportes DESC";

        $resultado = $conn->query($query);

        if ($resultado) {
            $data = [];
            while ($fila = $resultado->fetch_assoc()) {
                $data[] = [
                    'nombres' => $fila['nombres'],
                    'apellidos' => $fila['apellidos'],
                    'total_aportes' => (float) $fila['total_aportes']
                ];
            }

            echo json_encode(['estado' => 'ok', 'data' => $data]);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error en la consulta.']);
        }

        exit;
    }
    // ------ FIN TABLA SOCIOS Y APORTES ---------
}

?>
