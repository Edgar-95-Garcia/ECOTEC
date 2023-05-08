<?php
include 'Conexion.php';
$id=$_POST["IDViaje"];
$usuario=$_POST["Usuario"];
$fecha=$_POST["Fecha"];
$horasalida=$_POST['Hora'];
$destino = $_POST['Destino'];
$estatus = $_POST['Estatus'];
$conductor = $_POST['Conductor'];


$consulta="INSERT INTO ViajesPasajeros (IDViaje, Usuario, Fecha, HoraSalida, Destino, Estatus, Conductor) 
values('$id','$usuario', '$fecha', '$horasalida', '$destino', '$estatus', '$conductor')";
$resultado= mysqli_query($conexion,$consulta);


if($resultado){
    echo "Registro Exitoso";
}else{
    echo "Error";
}

?>