<?php
require_once 'Conexion.php';

$control = ['Conductor'];

$sql = "SELECT * FROM ViajesPasajeros WHERE Conductor = '$control' AND Estatus='Espera'";
$result = mysqli_query($conexion, $sql);
$user = array();

while($row = mysqli_fetch_assoc($result)){
    $index['Destino'] = $row['Destino'];
    $index['Usuario'] = $row['Usuario'];
    
    array_push($user, $index);
}
echo json_encode($user);
?>