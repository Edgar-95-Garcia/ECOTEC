<?php
class Consultar_asistencia
{
    function selectAsistenciaFromIdTaller($id_taller)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT DISTINCT PERIODO FROM asistencia WHERE ID_TALLER = '" . $id_taller . "' ORDER BY FECHA ASC");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAsistenciaFromIdTallerPeriodo($id_taller, $id_periodo)
    {
        try {
            $result = "";
            require_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT DISTINCT ID_ALUMNO FROM asistencia WHERE PERIODO = '" . $id_periodo . "' AND ID_TALLER ='" . $id_taller . "' ORDER BY FECHA ASC");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectFechasFromIdTallerPeriodo($id_taller, $id_periodo)
    {
        try {
            $result = "";
            require_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT DISTINCT date_format(asistencia.FECHA, '%Y-%m-%d') AS FECHA FROM asistencia WHERE ID_TALLER='" . $id_taller . "' AND PERIODO = '" . $id_periodo . "' ORDER BY FECHA asc");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectAsistenciasFromIdTallerPeriodoIdEstudiante($id_taller, $id_periodo, $id_estudiante)
    {
        try {
            $result = "";
            require_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM asistencia WHERE ID_TALLER='" . $id_taller . "' AND ID_ALUMNO= '" . $id_estudiante . "' AND PERIODO = '" . $id_periodo . "' ORDER BY FECHA asc");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}
