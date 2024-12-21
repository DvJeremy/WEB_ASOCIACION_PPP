<?php
include("../BACKEND/CONEXION/conexion.php");
session_start(); // Inicia o reanuda la sesión

if (isset($_SESSION['id'])) {
    // Si no hay sesión activa, redirige al login
    //header("Location: ../LOGIN/login.php");
    $user = $_SESSION["id"];

    $consulta = "SELECT username FROM usuarios WHERE username = '$user'";
    $resultado = mysqli_query($conexion, $consulta);

    $fila = mysqli_fetch_array($resultado);
    $uss  = $fila['username'];

    $texto = $uss;
    $_SESSION['tex'] = $texto;
}
?>

<head>
    <!-- Otros enlaces de CSS y meta etiquetas -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Librería de íconos -->
</head>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- CORE -->
    <div class="sidebar-section">
        <div class="sidebar-section">
            <div class="sidebar-heading">BIENVENIDO
                <div style="margin-top: 10px;">
                    <li style="color: white; font-weight: bold; list-style: none;font-family:Century Gothic;">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        |
                        <?php if (isset($texto)) {
                            echo $texto;
                        } ?>
                    </li>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                </li>
            </ul>
        </div>

        <div class="sidebar-heading">CORE</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="bi bi-speedometer2 me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- New sección registro familiar -->
    <div class="sidebar-section">
        <div class="sidebar-heading">FAMILIAR</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="../USUARIO/registro_familiar.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Registro Familiar">
                    <i class="bi bi-people me-2"></i>
                    <span>Registro Familiar</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- INTERFACE -->
    <div class="sidebar-section">
        <div class="sidebar-heading">CONSULTAR</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Información personal">
                    <i class="bi bi-grid me-2"></i>
                    <span>Información personal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Contribución">
                    <i class="bi bi-table me-2"></i>
                    <span>Contribución</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ADDONS -->
    <div class="sidebar-section">
        <div class="sidebar-heading">PRESTAMOS</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="../USUARIO/simular_usuario.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Simular">
                    <i class="bi bi-graph-up me-2"></i>
                    <span>Simular</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Solicitar">
                    <i class="bi bi-file-text me-2"></i>
                    <span>Solicitar</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Botón para colapsar/expandir el sidebar -->
<button id="sidebarCollapse" class="btn" aria-label="Colapsar/Expandir sidebar">
    <i class="bi bi-arrow-left-circle"></i>
</button>
