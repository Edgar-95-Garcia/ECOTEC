<?php
include 'Conexion.php';
$nombre=$_POST["Nombre"];
$apaterno=$_POST["Apaterno"];
$amaterno=$_POST["Amaterno"];
$control=$_POST["NoControl"];
$correo=$_POST['Correo'];
$password=$_POST['Pass'];
$telefono=$_POST['Telefono'];
$tipo=$_POST['TipoUsuario'];

$consulta="INSERT INTO usuario (Nombre, Apaterno, Amaterno, NoControl, Correo, Pass, Telefono, TipoUsuario) 
values('$nombre','$apaterno','$amaterno','$control','$correo','$password', '$telefono', '$tipo')";
$resultado= mysqli_query($conexion,$consulta);

if($resultado){
    echo "Registro Exitoso";
}else{
    echo "Error";
}

?>