<?php
class Consultar_tabla_inicio_ecoride
{
    function selectTablaInicio()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM rideecotec_tabla");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }
}
