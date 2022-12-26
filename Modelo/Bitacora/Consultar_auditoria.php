<?php

class Consultar_auditoria{

    function selectAuditoria()
    {
        try {
            $result = "";
            include_once("./Modelo/conect.php");
            $c = new conect("aeroline_user", ".+X?pZZ+E9hU");
            $stmt = $c->connect()->prepare("SELECT * FROM auditoria");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            #print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $result;
    }


}