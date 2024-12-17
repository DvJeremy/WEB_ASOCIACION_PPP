<?php
 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 
include("../BACKEND/CONEXION/conexion.php");
 
  if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cuenta']) 
  && isset($_POST['dni']) && isset($_POST['fecha'])
  && isset($_POST['codigo'])&& isset($_POST['tipo_socio']) && isset($_POST['usuario'])
  && isset($_POST['contra']) && isset($_POST['tipo_usuario'])&& isset($_POST['estado'])
  && isset($_POST['dependencia']) && isset($_POST['fechaNacimiento']) && isset($_POST['contacto'])
  && isset($_POST['distrito']) && isset($_POST['domicilio']) && isset($_POST['correo'])
  ){
    
    
    $tipo_socio=$_POST['tipo_socio'];
    $dni=$_POST['dni'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $cuenta=$_POST['cuenta'];
    $codigo=$_POST['codigo'];
    $fecha=$_POST['fecha'];
    $usuario=$_POST['usuario'];
    $contra=$_POST['contra'];
    $tipo_usuario=$_POST['tipo_usuario'];
    $estado=$_POST['estado'];

    $dependencia=$_POST['dependencia'];
    $nacimiento=$_POST['fechaNacimiento'];
    $contacto=$_POST['contacto'];
    $distrito=$_POST['distrito'];
    $domicilio=$_POST['domicilio'];
    $correo=$_POST['correo'];

    $hashed_password = password_hash($contra, PASSWORD_DEFAULT);
/*
    $consulta= "SELECT * FROM tipos_socios WHERE tipo_socio='$tipo_socio'";
    $resultado=mysqli_query($conexion,$consulta);
	  $fila = mysqli_fetch_array($resultado);
	  $idtipo_socio=$fila['id_tipo_socio'];*/

    $idtipo_socio = intval($tipo_socio);

    $consulta="INSERT INTO socios(dni_socio,nombres,apellidos,fecha_ingreso,numero_cuenta,codigo_universidad, dependencia, id_tipo_socio, correo, fecha_nacimiento, domicilio, distrito, num_contacto) VALUES('$dni','$nombre','$apellido','$fecha','$cuenta','$codigo','$dependencia',$idtipo_socio,'$correo','$nacimiento','$domicilio','$distrito','$contacto')";
    $resultado=mysqli_query($conexion,$consulta) or die("Error de registro1". mysqli_error($conexion));

    $consulta="INSERT INTO usuarios(id_usuario,username,contra,tipo_usuario,dni_socio,estado_usuario) VALUES(null,'$usuario','$hashed_password','$tipo_usuario','$dni','$estado')";
    $resultado=mysqli_query($conexion,$consulta) or die("Error de registro2");
    
    mysqli_close($conexion);
    
    header("location: index_administrador.php");
  }

