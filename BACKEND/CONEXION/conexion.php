<?php
  $host = "localhost";
  $nombre = "entidad";
  $usuario = "root";
  $contra = "";
  
  $conexion = new mysqli($host, $usuario, $contra, $nombre);
  if ($conexion->connect_error) {
      die("Conexión fallida: " . $conexion->connect_error);
  }
?> 