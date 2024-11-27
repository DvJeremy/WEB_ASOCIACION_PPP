<?php
  $host = "localhost";
  $nombre = "entidad";
  $usuario = "root";
  $contra = "";
  
  $conn = new mysqli($host, $usuario, $contra, $nombre);
  if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
  }
?> 