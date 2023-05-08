<?php
require_once 'Conexion.php';

$sql = "SELECT * FROM ViajeConductor";
$result = mysqli_query($conexion, $sql);
$user = array();

while($row = mysqli_fetch_assoc($result)){
    $index['ID'] = $row['ID'];
    $index['Usuario'] = $row['Usuario'];
    $index['Destino'] = $row['Destino'];
    $index['Fecha'] = $row['Fecha'];
    $index['HoraSalida'] = $row['HoraSalida'];
    $index['Ruta1'] = $row['Ruta1'];
    $index['Ruta2'] = $row['Ruta2'];
    $index['Ruta3'] = $row['Ruta3'];
    array_push($user, $index);
}
echo json_encode($user);
?>