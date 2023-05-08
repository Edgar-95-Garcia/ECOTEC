<?php
class Consultar_config
{
    function select_config(){
        $result="";
        try {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("SELECT * FROM `o8V9FikNS/0amrwqdQ==`");
            $statementHandle->execute();
            $result = $statementHandle->fetchAll();
        } catch (PDOException $e) {
            //print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $result;
    }
}
