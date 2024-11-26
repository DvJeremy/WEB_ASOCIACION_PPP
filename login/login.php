<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-4 ">
        <div class="card rounded-5 shadow bg-light" style="min-height: 450px;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <h3 class="card-title text-center mb-4" style="font-family:Century Gothic; font-weight: bold;">Iniciar Sesión</h3>
                <i class="fa-solid fa-user-large fa-4x" style="color: #0b5289;"></i>
                <form class="w-100" action="enviardatos.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label" style="font-family:Century Gothic;">Usuario</label>
                        <input type="text" name="user" class="form-control" id="username" placeholder="Ingrese el usuario">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-family:Century Gothic;">Contraseña</label>
                        <input type="password" name="pass" class="form-control rounded-3" id="password" placeholder="Ingrese la contraseña">
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="btnEntrar" class="btn btn-primary btn-lg rounded-5" style="background-color: #003366; border-color: #003366;">Ingresar</button>
                    </div>    
                </form>
                <div class="text-center mt-3">
                 <!--<p>¿No tienes cuenta? <a href="registro.php" class="text-decoration-none fw-bold" style="color: #d35400;">Regístrate aquí</a></p>-->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>