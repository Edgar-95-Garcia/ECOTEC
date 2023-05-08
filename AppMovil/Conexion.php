<?php 
$hostname='localhost';
$database='ecotecca_ecotec';
$username='ecotecca_admin';
$password='Ecotec@22-/-';

$conexion = new mysqli($hostname,$username,$password,$database);

if($conexion -> connect_errno){
   echo "Error";
}

?>