<?php
class Consultar_tabla_inicio_anunciatec
{
    function selectTablaInicio()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM anuncitec_tabla");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }
}
