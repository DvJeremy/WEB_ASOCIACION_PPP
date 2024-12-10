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
        <div class="sidebar-heading">BIENVENIDO
        <div style="margin-top: 10px;">
        <li style="color: white; font-weight: bold; list-style: none;font-family:Century Gothic;">
        <i class="bi bi-person-lines-fill me-2"></i>
            | 
            <?php if (isset($texto)) {
                        echo $texto;
                    } ?></li></div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">      
            </li>
        </ul>
    </div>

    <!-- INTERFACE -->
    <div class="sidebar-section">
        <div class="sidebar-heading">USUARIOS</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="../ADMINISTRADOR/registro_usuario.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Registrar">
                    <i class="bi bi-grid me-2"></i>
                    <span>Registrar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Administrar">
                    <i class="bi bi-table me-2"></i>
                    <span>Administrar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../ADMINISTRADOR/informes_admin.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Informes">
                    <i class="bi bi-file-text me-2"></i>
                    <span>Informes</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ADDONS -->
    <div class="sidebar-section">
        <div class="sidebar-heading">OPERACIONES</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="../ADMINISTRADOR/simular_admin.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Generar prestamo">
                    <i class="bi bi-graph-up me-2"></i>
                    <span>Generar prestamo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../ADMINISTRADOR/recaudar.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Recaudar">
                    <i class="bi bi-file-text me-2"></i>
                    <span>Recaudar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../ADMINISTRADOR/cobrar_prestamo.php" data-bs-toggle="tooltip" data-bs-placement="right" title="Cobrar prestamo">
                    <i class="bi bi-file-text me-2"></i>
                    <span>Cobrar prestamo</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Botón para colapsar/expandir el sidebar -->
<button id="sidebarCollapse" class="btn" aria-label="Colapsar/Expandir sidebar">
    <i class="bi bi-arrow-left-circle"></i>
</button>