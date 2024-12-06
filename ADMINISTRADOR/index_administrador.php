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

    $texto = " | " . "Usuario: " . $uss;
    $_SESSION['tex'] = $texto;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
</head>

<body>

    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

    <!-- Contenido Principal -->
    <div class="main-content" id="mainContent">
        <h1>HOLA MUNDO</h1>
        <div class="sesion">
            <ul>
                <li><?php if (isset($texto)) {
                        echo "<html>";
                        echo "<a class='boton' href='form_cambiar_contra.php' >Cerrar Sesion</a>";
                        echo "</html>";
                    } else {
                        echo "<html>";
                        echo "<a class='boton' href='login/menuregistro.php' >Iniciar Sesion</a>";
                        echo "</html>";
                    }  ?></li>
                <li><?php if (isset($texto)) {
                        echo $texto;
                    } ?></li>
            </ul>
        </div>
        <!-- Aquí va el contenido de tu dashboard -->
    </div>
    <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>-->
</body>

</html>