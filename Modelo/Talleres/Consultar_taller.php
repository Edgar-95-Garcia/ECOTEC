<?php
class Consultar_taller
{

    function selectTalleresFromIdProfesor()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres WHERE ID_PROFESOR = '" . $_SESSION['ID'] . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectTallerFromIdTaller($id_taller)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres WHERE ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectTallerFromIdTallerReporte($id_taller)
    {
        try {
            $result = "";
            require_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres WHERE ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectTallerFromIdProfesor($id_taller, $id_profesor)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres WHERE ID_PROFESOR = '" . $id_profesor . "' AND ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectTalleresDisponibles($alumno)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres WHERE NOT EXISTS (SELECT NULL FROM alumno_has_taller where talleres.ID_TALLER=alumno_has_taller.ID_TALLER AND alumno_has_taller.ID_ALUMNO = '" . $alumno . "') AND STATUS = 1 AND LUGARES_DISPONIBLES >=1");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectTalleresRegistrados($alumno)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres WHERE EXISTS (SELECT NULL FROM alumno_has_taller where talleres.ID_TALLER=alumno_has_taller.ID_TALLER AND alumno_has_taller.ID_ALUMNO = '" . $alumno . "') AND STATUS = 1 AND LUGARES_DISPONIBLES >=1");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectTalleresRegistradosFechaAltaIdTallerIdAlumno($id_taller, $alumno)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM alumno_has_taller WHERE ID_TALLER = " . $id_taller . " AND ID_ALUMNO = " . $alumno . "");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
    function selectTalleres()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM talleres");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}
