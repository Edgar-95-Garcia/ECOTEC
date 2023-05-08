<?php
include 'Conexion.php';

$codigo = $_GET['ID'];

$sql = "SELECT * FROM ViajeConductor WHERE ID = '$codigo'";
$result = $conexion->query($sql);

while($fila = $result -> fetch_array()){
     $viaje[] = array_map('utf8_encode', $fila);
}
echo json_encode($viaje);
$result->close();

?>