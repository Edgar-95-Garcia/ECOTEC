<?php
include 'Conexion.php';
$marca=$_POST["Marca"];
$modelo=$_POST["Modelo"];
$placa=$_POST["Placas"];
$serie=$_POST["Serie"];
$color=$_POST['Color'];
$control=$_POST['NoControl'];

$consulta="INSERT INTO Automoviles (Modelo, Marca, NoSerie, Placas, Color, NoControl) 
values('$modelo','$marca','$serie','$placa','$color','$control')";
$resultado= mysqli_query($conexion,$consulta);



if($resultado){
    echo "Registro Exitoso";
}else{
    echo "Error";
}

?>