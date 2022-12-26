<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["aceptar_asistencia"] == "Registrar Asistencia") {
        include_once("./Modelo/Asistencia/Insertar_asistencia.php");
        $obj_asistencia = new Insertar_asistencia();
        include_once("./Controlador/key.php");
        $k = new key();
        $total = $_POST['total'];
        $contador = 0;
        $asistencia = null;
        for ($aux = 0; $aux < $total; $aux++) {
            if ($_POST['alumno' . $aux] == 'Asistencia') {
                $asistencia = 1;
            } else if ($_POST['alumno' . $aux] == 'Falta') {
                $asistencia = 0;
            } else {
                $asistencia = 3;
            }
            $data = array(null, $_POST['taller'], $_POST['alumno_id' . $contador], null, $asistencia, $k->enc($_POST['periodo']));
            $contador += $obj_asistencia->add_asistencia($data);
            unset($data);
        }
        if ($contador == $total) {
            echo '<script type="text/javascript">alert("Registros realizados correcamente");</script>';
        } else if ($contador < $total) {
            echo '<script type="text/javascript">alert("Se registraron ' . $total - $contador . ' de ' . $total . ' registros, avisar a soporte");</script>';
        }
    }
}
