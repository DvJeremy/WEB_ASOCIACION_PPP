<?php
session_start(); // Inicia o reanuda la sesión

if (!isset($_SESSION['user_id'])) {
    // Si no hay sesión activa, redirige al login
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet Alumno - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)),
                        url('background.jpg') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: rgba(147, 201, 186, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            color: #f4d03f;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }
        .logo {
            width: 120px;
            height: 120px;
            margin-bottom: 1rem;
        }
        .btn-login {
            background-color: #474787;
            border: none;
            padding: 0.8rem;
            width: 100%;
            color: white;
            border-radius: 25px;
            margin-top: 1rem;
        }
        .btn-login:hover {
            background-color: #2d2d5a;
        }
        .form-control {
            border-radius: 25px;
            padding: 0.8rem 1.2rem;
        }
    </style>
</head>
<body>
<div class="datos-confirmar">
		<p>Datos Ingresados</p>
		    <?php
            						
			echo "<b>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;</b> ";echo $_POST['nombre'];
            echo "</br>";
			echo "<b>Correo :</b> ";echo $_POST['correo'];
			echo "</br>";
            ?>
			<div>
    <div class="container">
        <div class="login-card">
            <div class="text-center">
                <img src="logo.png" alt="Logo Sistema" class="logo">
                <h1 class="login-title">Intranet Alumno</h1>
                <h2 class="text-white h4 mb-4">Sistema Único de Matrícula</h2>
            </div>
            
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Usuario" required>
                </div>
                
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Contraseña" required>
                </div>
                
                <button type="submit" class="btn btn-login">
                    Iniciar Sesión
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>