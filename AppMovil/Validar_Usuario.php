<?php
include 'Conexion.php';
$usu_Usuario = $_POST['NoControl'];
$usu_Password = $_POST['Pass'];

$sentences = "SELECT * FROM usuario WHERE NoControl='$usu_Usuario' AND Pass='$usu_Password' AND TipoUsuario='Conductor'";
$resultado = mysqli_query($conexion,$sentences);

$sentences2 = "SELECT * FROM usuario WHERE NoControl='$usu_Usuario' AND Pass='$usu_Password' AND TipoUsuario='Pasajero'";
$resultado2 = mysqli_query($conexion,$sentences2);

if($resultado->num_rows > 0){
    echo "Conductor";
}else if($resultado2->num_rows >0){
    echo "Pasajero";
}else{
    echo "Datos Incorrectos";
}
?>