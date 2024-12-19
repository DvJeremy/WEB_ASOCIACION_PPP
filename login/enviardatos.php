<?php
include("../BACKEND/CONEXION/conexion.php");

if (isset($_POST['btnEntrar'])){
				   
    $usuario=$_POST['user'];
    $contra=$_POST['pass'];
    
    $consulta="SELECT id_usuario,username,tipo_usuario, contra FROM usuarios WHERE username='$usuario'";
    
    $resultado= mysqli_query($conexion,$consulta);
   
    if(mysqli_num_rows($resultado) > 0){
        $row = mysqli_fetch_array($resultado);

       /* // Depuración: verifica los valores obtenidos
          var_dump($row['contra']);
          var_dump(password_verify($contra, $row['contra']));
          exit;*/
        if (password_verify($contra, $row['contra'])){
           session_start();
           $_SESSION["id"]= $row['username'];
           $_SESSION["cod"]= $row['id_usuario'];
           $_SESSION["us"]= $row['tipo_usuario'];

           if ($_SESSION["us"]='Admin'){
            header("Location: ../ADMINISTRADOR/informes_c.php");
           }elseif ($_SESSION["us"]='Usuario'){
            header("Location: ../USUARIO/index_usuario.php");
           }

           //header("Location: ../ADMINISTRADOR/index_administrador.php");
           
        }else{
           echo "<script>";
           echo "alert('Contraseña incorrecta! Intentelo de nuevo...')";
           echo "</script>";
        }  
   } else {
           echo "<script>alert('Usuario no encontrado. Verifique sus credenciales.');</script>";
          }
          mysqli_close($conexion);
   }
?> 