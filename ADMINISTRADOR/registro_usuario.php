<?php 
include("../BACKEND/CONEXION/conexion.php");

// Consulta para obtener los tipos de socio
$sql = "SELECT id_tipo_socio, tipo_socio FROM tipos_socios";
$result = $conexion->query($sql);

// Guardar resultados en un array
$tipos_socio = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tipos_socio[] = $row;
    }}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/componentes_compartidos.css">
</head>
<body>
    <?php include '../COMPONENTES_COMPARTIDOS/navbar_admin.php'; ?>
    <?php include '../COMPONENTES_COMPARTIDOS/sidebar_admin.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/componentes_compartidos.js"></script>
<div class="main-content" id="mainContent">


    <div class="container card border shadow p-3 mb-1 bg-body-tertiary rounded mt-1">
        <form action="enviarform.php" method="post">
            <div class="row">
              <h4 class="card-title text-center mb-2 text-orange">Registro de Usuarios</h4>
              <div class="col-md-6"> 
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="nombre" id="campo_nombre" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Nombre</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="apellido" id="campo_apellido" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Apellidos</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="dni" id="campo_dni" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">DNI</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="cuenta" id="campo_cuenta" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Número de Cuenta</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="codigo" id="codigo" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Código Universidad</label>          
                  </div>
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="dependencia" id="campo_dependencia" placeholder="Escribir Dependencia">
                     <label class="form-label"  for="campo_nombre">Dependencia</label>          
                   </div>

                  <div class="form-group mb-3">
                     <label class="mb-2" for="exampleFormControlSelect1">Tipo Socio</label>
                     <select class="form-control" id="exampleFormControlSelect1" name="tipo_socio">
                     <?php foreach ($tipos_socio as $tipo): ?>
                         <option value="<?php echo $tipo['id_tipo_socio']; ?>">
                     <?php echo htmlspecialchars($tipo['tipo_socio']); ?>
                         </option>
                     <?php endforeach; ?>
                     </select>
                  </div>

                  <div class="mb-3">
                    <label for="fechaRegistro" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fechaRegistro" name="fecha" required>
                  </div>

                  <div class="mb-3">
                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                  </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="contacto" id="campo_contacto" placeholder="Escribir Número de Contacto">
                     <label class="form-label"  for="campo_contacto">Número Contacto</label>          
                   </div>

             </div>

               <div class="col-md-6">

                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="distrito" id="campo_distrito" placeholder="Escribir Distrito">
                     <label class="form-label"  for="campo_contacto">Distrito</label>          
                   </div>


                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="domicilio" id="campo_domicilio" placeholder="Escribir Domicilio">
                     <label class="form-label"  for="campo_nombre">Domicilio</label>          
                   </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="correo" id="campo_correo" placeholder="Escribe correo">
                     <label class="form-label"  for="campo_nombre">Correo</label>          
                   </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="usuario" id="campo_usuario" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Usuario</label>          
                  </div>
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="password" name="contra" id="campo_contra" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Contraseña</label>          
                  </div>
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="password" name="contra2" id="campo_contra2" placeholder="Escribe tu nombre">
                     <label class="form-label"  for="campo_nombre">Repita Contraseña</label>          
                  </div>
                  <div class="form-group mb-3">
                     <label class="mb-2" for="exampleFormControlSelect1">Tipo Usuario</label>
                     <select class="form-control" id="exampleFormControlSelect1" name="tipo_usuario">
                        <option value="Admin">Admin</option>
                        <option value="Usuario">Usuario</option>
                     </select>
                  </div>
                  <label class="form-label"  for="">Estado de usuario</label>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="estado" value="Activo" id="flexRadioDefault2" >
                     <label class="form-check-label" for="flexRadioDefault2">
                      Activo
                     </label>
                  </div>
                  <div class="form-check mb-3">
                     <input class="form-check-input" type="radio" name="estado" value="Inactivo" id="flexRadioDefault2" >
                     <label class="form-check-label" for="flexRadioDefault2">
                        Inactivo
                     </label>
                  </div>
                  <div class="col-md-4 offset-md-4 text-center">
                       <button class="btn btn-success btn-lg mt-5" type="submit">Registrar</button>
                  </div>          
               </div>          
            </div>
         </form>
    </div>
</div>
      

</body>
</html>