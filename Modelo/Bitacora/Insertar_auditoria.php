<?php

class Insertar_auditoria
{

    function inicio_sesion($id)
    {
        $fecha = date("Y-m-d");
        $hora = date(time());
        include_once("./Controlador/key.php");
        $k = new key();
        $data = array(null, $k->enc($fecha), $k->enc($hora), $id, $k->enc("Inicio sesión"), $k->enc("No aplica"), $k->enc("No aplica"), $k->enc("No aplica"), $k->enc("No aplica"), $k->enc("No aplica"));
        try {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO auditoria(ID,FECHA,HORA,ID_USUARIO,OPERACION, ID_REGISTRO, CAMPO,TABLA,DATO_ANTIGUO,DATO_NUEVO) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $statementHandle->execute($data);
        } catch (PDOException $e) {
            echo "Error " . $e;
        }
    }
}
