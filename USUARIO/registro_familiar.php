<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Beneficiario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
    <link rel="stylesheet" href="../CSS/registro_familiar.css"> <!-- Enlace al nuevo CSS -->
</head>
<body>
    <?php include '../COMPONENTES_COMPARTIDOS/navbar_usuario.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_usuario.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>

<div class="main-content" id="mainContent">
    <div class="container card border shadow p-3 mb-1 bg-body-tertiary rounded mt-1">
        <form action="enviar_beneficiario.php" method="post">
            <div class="row">
                <h4 class="card-title text-center mb-2 text-orange">Registro de Beneficiario</h4>
                <!-- Columna izquierda -->
                <div class="col-md-6"> 
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="nombres" id="campo_nombres" placeholder="Escribe los nombres" required>
                        <label class="form-label" for="campo_nombres">Nombres</label>          
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="apellidos" id="campo_apellidos" placeholder="Escribe los apellidos" required>
                        <label class="form-label" for="campo_apellidos">Apellidos</label>          
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="dni" id="campo_dni" placeholder="Escribe el DNI" required>
                        <label class="form-label" for="campo_dni">DNI</label>          
                    </div>
                    
                    <div class="form-floating mb-2">
                        <select class="form-control" name="edad" id="campo_edad"  required>
                            <option value="" disabled selected>Selecciona edad</option>
                            <?php for ($i = 1; $i <= 100; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?> años</option>
                            <?php } ?>
                        </select>
                        <label class="form-label" for="campo_edad">Edad</label>          
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="direccion" id="campo_direccion" placeholder="Escribe la dirección" required>
                        <label class="form-label" for="campo_direccion">Dirección</label>          
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="contacto" id="campo_contacto" placeholder="Escribe el número de contacto" required>
                        <label class="form-label" for="campo_contacto">Número de contacto</label>          
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="email" name="correo" id="campo_correo" placeholder="Escribe el correo electrónico" required>
                        <label class="form-label" for="campo_correo">Correo</label>          
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="parentesco" id="campo_parentesco" placeholder="Escribe el parentesco" required>
                        <label class="form-label" for="campo_parentesco">Parentesco</label>          
                    </div>
                </div>

                <!-- Botón de registro -->
                <div class="col-md-4 offset-md-4 text-center">
                    <button class="btn btn-success btn-lg mt-4" type="submit">Registrar</button>
                </div>          
            </div>
        </form>
    </div>
</div>
</body>
</html>
