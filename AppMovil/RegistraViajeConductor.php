<?php
include 'Conexion.php';
$id=$_POST["IdViaje"];
$usuario=$_POST["Usuario"];
$fecha=$_POST["Fecha"];
$horasalida=$_POST['HoraSalida'];
$destino1 = $_POST['Destino1'];
$destino2 = $_POST['Destino2'];
$destino3 = $_POST['Destino3'];
$destino4 = $_POST['Destino4'];
$estatus = $_POST['Estatus'];


$consulta="INSERT INTO ViajeConductor (IDViaje, Usuario, Fecha, HoraSalida, Destino, Ruta1, Ruta2, Ruta3, Estatus) 
values('$id','$usuario', '$fecha', '$horasalida', '$destino1', '$destino2', '$destino3','$destino4', '$estatus')";
$resultado= mysqli_query($conexion,$consulta);

if($resultado){
    echo "Registro Exitoso";
}else{
    echo "Error";
}
?>