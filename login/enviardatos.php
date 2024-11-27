<?php
include("../BACKEND/CONEXION/conexion.php");

if (isset($_POST['btnEntrar'])){
				   
    $usuario=$_POST['user'];
    $contra=$_POST['pass'];
    
    $consulta="SELECT id_usuario,username, contra FROM usuarios WHERE username='$usuario' AND contra ='$contra'";
    
    $resultado= mysqli_query($conexion,$consulta);
    $num_row = mysqli_num_rows($resultado);
    
    if($num_row > 0){
        session_start();
        $row = mysqli_fetch_array($resultado);
        $_SESSION["id"]= $row['username'];
        $_SESSION["cod"]= $row['id_usuario'];

        header("Location: ../ADMINISTRADOR/index_administrador.php");
    }else{
        echo "<script>";
        echo "alert('Usuario o contraseña incorrecta! Intentelo de nuevo...')";
        echo "</script>";
    }  
   }
?>