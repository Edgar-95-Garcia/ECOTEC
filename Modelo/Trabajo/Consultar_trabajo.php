<?php
class Consultar_trabajo
{
    function selectBolsaTrabajo()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM bolsa_trabajo");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }

    function selectBolsaTrabajoById($id)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM bolsa_trabajo WHERE ID = '$id'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e;
        }
        return $result;
    }
}
