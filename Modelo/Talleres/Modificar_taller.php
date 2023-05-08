<?php
class Modificar_taller
{
    #-------------------------------------------------------------------------------------------------------
    function updateTaller($id_profesor, $nombre, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $clave, $descripcion, $salon, $cupo, $departamento, $status, $id_taller)
    {
        try {
            if ($status == "Activo") {
                $status = 1;
            } else {
                $status = 0;
            }
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE talleres SET ID_PROFESOR = '" . $id_profesor . "', NOMBRE = '" . $k->enc($nombre) . "' ,LUNES = '" . $k->enc($lunes) . "' ,MARTES = '" . $k->enc($martes) . "' ,MIERCOLES='" . $k->enc($miercoles) . "' ,JUEVES = '" . $k->enc($jueves) . "' ,VIERNES ='" . $k->enc($viernes) . "' ,SABADO = '" . $k->enc($sabado) . "' ,DOMINGO = '" . $k->enc($domingo) . "',CLAVE = '" . $k->enc($clave) . "' ,DESCRIPCION = '" . $k->enc($descripcion) . "' ,SALON = '" . $k->enc($salon) . "' ,CUPO = '" . $cupo . "' ,DEPARTAMENTO = '" . $k->enc($departamento) . "', STATUS = '" . $status . "' WHERE ID_TALLER='" . $id_taller . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
        }
        return $coincidencia;
    }

    function updateTallerLugares($id_taller)
    {
        try {
            include_once("../Modelo/conect.php");
            $c = new conect();
            include_once("../Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE talleres SET LUGARES_DISPONIBLES = LUGARES_DISPONIBLES-1 WHERE ID_TALLER='" . $id_taller . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
            echo "" . $e;
        }
        return $coincidencia;
    }

    function updateTallerLugaresAumenta($id_taller)
    {
        try {
            include_once("../Modelo/conect.php");
            $c = new conect();
            include_once("../Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE talleres SET LUGARES_DISPONIBLES = LUGARES_DISPONIBLES+1 WHERE ID_TALLER='" . $id_taller . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
            echo "" . $e;
        }
        return $coincidencia;
    }
}
