<?php
include("../BACKEND/CONEXION/conexion.php");

// Verificar si el parámetro id_usuario está presente y es un número válido
if (isset($_REQUEST["id"])) {
    $id_usuario = $_REQUEST["id"];

    // Consulta segura con parámetros preparados
    $consulta = "
        SELECT * FROM usuarios
        INNER JOIN socios ON usuarios.dni_socio = socios.dni_socio
        INNER JOIN tipos_socios ON socios.id_tipo_socio = tipos_socios.id_tipo_socio
        WHERE usuarios.id_usuario = ?
    ";
    // Preparar la consulta
    $stmt = $conexion->prepare($consulta);
    if ($stmt) {
        // Asociar el parámetro
        $stmt->bind_param("i", $id_usuario);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $resultado = $stmt->get_result();

        // Verificar si hay resultados
        if ($resultado->num_rows > 0) {
            $con = $resultado->fetch_assoc();
        } else {
            die("No se encontró ningún usuario con el ID proporcionado.");
        }

        // Cerrar la consulta
        $stmt->close();
    } else {
        die("Error al preparar la consulta: " . $conexion->error);
    }
} else {
    die("ID de usuario no válido o no proporcionado.");
}
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
        <form action="actualizarform.php" method="post">
            <div class="row">
              <h4 class="card-title text-center mb-2 text-orange">Actualizar Usuarios</h4>
              <div class="col-md-6"> 
                 <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="id" id="campo_nombre" placeholder="Escribe tu nombre" value="<?php if(isset($con['id_usuario'])): echo $con['id_usuario']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">ID</label>          
                  </div>
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="nombre" id="campo_nombre" placeholder="Escribe tu nombre" value="<?php if(isset($con['nombres'])): echo $con['nombres']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Nombre</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="apellido" id="campo_apellido" placeholder="Escribe tu nombre" value="<?php if(isset($con['apellidos'])): echo $con['apellidos']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Apellidos</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="dni" id="campo_dni" placeholder="Escribe tu nombre" value="<?php if(isset($con['dni_socio'])): echo $con['dni_socio']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">DNI</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="cuenta" id="campo_cuenta" placeholder="Escribe tu nombre" value="<?php if(isset($con['numero_cuenta'])): echo $con['numero_cuenta']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Número de Cuenta</label>          
                   </div>
                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="codigo" id="codigo" placeholder="Escribe tu nombre" value="<?php if(isset($con['codigo_universidad'])): echo $con['codigo_universidad']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Código Universidad</label>          
                  </div>
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="dependencia" id="campo_dependencia" placeholder="Escribir Dependencia" value="<?php if(isset($con['dependencia'])): echo $con['dependencia']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Dependencia</label>          
                   </div>


                   <div class="form-group mb-3">
                      <label class="mb-2" for="exampleFormControlSelect1">Tipo Socio</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="tipo_socio">
                          <?php 
                          // Consulta para obtener los tipos de socio disponibles
                          $consulta_tipos = "SELECT * FROM tipos_socios"; 
                          $resultado_tipos = $conexion->query($consulta_tipos);
        
                          // Verificamos si hay resultados de tipos de socio
                          if ($resultado_tipos->num_rows > 0) {
                              while ($tipo = $resultado_tipos->fetch_assoc()) {
                                  // Comprobamos si el id_tipo_socio del usuario es igual al id del tipo actual
                                  $selected = ($con['id_tipo_socio'] == $tipo['id_tipo_socio']) ? 'selected' : '';
                                  echo '<option value="' . $tipo['id_tipo_socio'] . '" ' . $selected . '>' . htmlspecialchars($tipo['tipo_socio']) . '</option>';
                              }
                          }
                          ?>
                      </select>
                   </div>





                  <div class="mb-3">
                    <label for="fechaRegistro" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fechaRegistro" name="fecha" required value="<?php if(isset($con['fecha_ingreso'])): echo $con['fecha_ingreso']; endif; ?>">
                  </div>

                  <div class="mb-3">
                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required value="<?php if(isset($con['fecha_nacimiento'])): echo $con['fecha_nacimiento']; endif; ?>">
                  </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="contacto" id="campo_contacto" placeholder="Escribir Número de Contacto" value="<?php if(isset($con['num_contacto'])): echo $con['num_contacto']; endif; ?>">
                     <label class="form-label"  for="campo_contacto">Número Contacto</label>          
                   </div>

             </div>

               <div class="col-md-6">

                   <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="distrito" id="campo_distrito" placeholder="Escribir Distrito" value="<?php if(isset($con['distrito'])): echo $con['distrito']; endif; ?>">
                     <label class="form-label"  for="campo_contacto">Distrito</label>          
                   </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="domicilio" id="campo_domicilio" placeholder="Escribir Domicilio" value="<?php if(isset($con['domicilio'])): echo $con['domicilio']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Domicilio</label>          
                   </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="correo" id="campo_correo" placeholder="Escribe correo" value="<?php if(isset($con['correo'])): echo $con['correo']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Correo</label>          
                   </div>

                  <div class="form-floating mb-2">
                     <input class="form-control"  type="text" name="usuario" id="campo_usuario" placeholder="Escribe tu nombre" value="<?php if(isset($con['username'])): echo $con['username']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Usuario</label>          
                  </div>
                  <div class="form-floating mb-2">
                     <input class="form-control"  type="password" name="contraVista" id="campo_contra" placeholder="Escribe tu nombre" value="<?php if(isset($con['contra'])): echo $con['contra']; endif; ?>">
                     <label class="form-label"  for="campo_nombre">Contraseña</label>          
                  </div>

                  <div class="form-floating mb-2">
                      <input class="form-control" type="password" name="contra" id="campo_contra" placeholder="Escribe tu nueva contraseña">
                      <label class="form-label" for="campo_contra">Nueva Contraseña</label>
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
                    <input 
                       class="form-check-input" 
                       type="radio" 
                       name="estado" 
                       value="Activo" 
                       id="estadoActivo" 
                        <?php echo isset($con['estado_usuario']) && $con['estado_usuario'] === 'Activo' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="estadoActivo">
                      Activo
                    </label>
                    </div>
                  <div class="form-check mb-3">
                    <input 
                      class="form-check-input" 
                      type="radio" 
                      name="estado" 
                      value="Inactivo" 
                      id="estadoInactivo" 
                      <?php echo isset($con['estado_usuario']) && $con['estado_usuario'] === 'Inactivo' ? 'checked' : ''; ?>>
                   <label class="form-check-label" for="estadoInactivo">
                   Inactivo
                   </label>
                  </div>

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
