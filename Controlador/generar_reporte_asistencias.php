<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["generar_reporte"] == "GENERAR REPORTE") {
        include_once("../Lib/fpdf184/fpdf.php");
        $nombre = $_POST['taller'];
        $periodo = $_POST['PERIODO'];
        $id_taller = $_POST['id_taller'];
        class PDF extends FPDF
        {
            // Page header
            function Header()
            {
                // GFG logo image
                $this->Image('../Static/images/logo.jpg', 0, 5, 50);
                // GFG logo image
                $this->Image('../Static/images/tec1.png', 190, 2, 20);
                // Set font-family and font-size
                $this->SetFont('Times', 'B', 20);
                // Move to the right
                $this->Cell(80);
                // Set the title of pages.
                // Break line with given space
                $this->Ln(5);
            }
            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Set font-family and font-size of footer.
                $this->SetFont('Arial', 'I', 8);
                // set page number
                $this->Cell(0, 10, 'Page ' . $this->PageNo() .
                    '/{nb}', 0, 0, 'C');
            }
        }
        include_once("../Controlador/key.php");
        $k = new key();
        include_once("../Modelo/Talleres/Consultar_taller.php");
        $obj_talleres = new Consultar_taller();
        $datos_taller = $obj_talleres->selectTallerFromIdTallerReporte($id_taller);
        foreach ($datos_taller as $taller) {
            $id_profesor = $taller['ID_PROFESOR'];
        }
        include_once("../Modelo/Usuarios/Consultar_usuario.php");
        $obj_usuarios = new Consultar_usuario();
        $datos_usuario = $obj_usuarios->selectUserByIdReporte($id_profesor);
        foreach ($datos_usuario as $profesor) {
            $nombre_profesor = $k->dec($profesor['NOMBRES']);
        }
        // Create new object.
        $pdf = new PDF();
        $pdf->AliasNbPages();
        // Add new pages
        $pdf->AddPage();
        // Set font-family and font-size.
        $pdf->SetFont('Times', '', 12);
        $pdf->Text(55, 10, 'Reporte de asistencias del taller: ' . $nombre);
        $pdf->Text(55, 15, 'Responsable de taller: ' . $nombre_profesor);
        $pdf->Text(55, 20, 'Fecha:  ' . date("j - m - Y") . '          En el periodo: ' . $k->dec($periodo));
        $pdf->Line(0, 30, 210, 30);
        $pdf->Text(10, 35, 'Valor 1 equivale a asistencia. Valor 0 equivale a inasistencia. Valor 3 equivale a no determinado');
        $pdf->Line(0, 40, 210, 40);
        $pdf->SetFont('Times', '', 5);
        $pdf->Text(1, 45, 'MATRICULA'); //1
        $pdf->Line(12, 40, 12, 280);
        $pdf->Text(13, 45, 'APELLIDO PATERNO'); //13
        $pdf->Line(32, 40, 32, 280);
        $pdf->Text(33, 45, 'APELLIDO MATERNO'); //33
        $pdf->Line(52, 40, 52, 280);
        $pdf->Text(53, 45, 'NOMBRES'); //53
        $pdf->Line(74, 40, 74, 280);
        //---------------------------------
        $pdf->Line(0, 48, 210, 48);
        $pdf->SetFont('Times', '', 5);
        include_once("../Modelo/Asistencia/Consultar_asistencia.php");
        $obj_asistencias = new Consultar_asistencia();
        $datos_asistencias = $obj_asistencias->selectAsistenciaFromIdTallerPeriodo($id_taller, $periodo);
        $datos_fechas = $obj_asistencias->selectFechasFromIdTallerPeriodo($id_taller, $periodo);
        $pos_x = 0;
        $pos_y = 50;
        $pos_asistencia_x=74;
        $pos_asistencia_y=50;
        $pos_fecha_x = 74;
        $pos_fecha_y = 45;
        /*
        Romper la fecha en dia, mes y año. Así se juntan todas las fechas para que ocupen menos espacio y 
        puedan colocarse más registros.
        Se rompe la primer fecha y se obtiene el mes
        Sí el mes obtenido de la fecha a evaluar es igual al de la fecha anterior se rompe la cadena y sólo se coloca el día
        Se hace lo mismo con cada una de las siguientes fechas de la lista
        En caso contrario se rompe la fecha y se obtiene el nuevo mes
        Se repite el proceso hasta terminar con la lista de tal modo que el resultado sería el siguiente:
        11-11-11-11-11-11-11-|12-12-12-12-12-12-12-|
        12-13-15-18-20-25-26-|01-12-15-17-18-29-30-|
        */
        $auxiliar = false;
        $pdf->Line(74, 43.5, 210, 43.5);
        foreach ($datos_fechas as $fecha) {
            if ($auxiliar == false) {
                $fechas_separadas = explode("-", $fecha['FECHA']);
            }
            $fechas_separadas_temp = explode("-", $fecha['FECHA']);
            $pdf->Text($pos_fecha_x + 1, $pos_fecha_y - 2, $fechas_separadas['1']);
            /*
            $fechas_separadas[0]=año
            $fechas_separadas[1]=mes
            $fechas_separadas[2]=dia
             */
            if ($fechas_separadas_temp['1'] == $fechas_separadas['1']) {
                //son días del mismo mes, se imprimen y no se actualiza la fecha original
                $pdf->Text($pos_fecha_x + 1, $pos_fecha_y, $fechas_separadas_temp['2']);
                $pdf->Line($pos_fecha_x + 3, 40, $pos_fecha_x + 3, 280);
                $auxiliar = true;
            } else {
                //no son días del mismo mes, no se imprimen y se actualiza la fecha original
                $fechas_separadas = explode("-", $fecha['FECHA']);
                /*
                El siguiente código se repite puesto que cuando el foreach llega al último elemento de la lista
                y adeás se da un caso de que en el último elemento de la lista es cambio de mes
                entonces se tienen que actualizar las fechas temporales y las fechas sin embargo al ser el último elemento
                esto ya no se puede hacer, así que para arreglar esto simplemente se repite el código
                */
                $pdf->Line(74, 43.5, 210, 43.5);
                $fechas_separadas_temp = explode("-", $fecha['FECHA']);
                $pdf->Line($pos_fecha_x + 3, 40, $pos_fecha_x + 3, 280);
                if ($fechas_separadas_temp['1'] == $fechas_separadas['1']) {
                    //son días del mismo mes, se imprimen y no se actualiza la fecha original
                    $pdf->Text($pos_fecha_x + 1, $pos_fecha_y, $fechas_separadas_temp['2']);
                    $pdf->Line($pos_fecha_x + 3, 43.5, $pos_fecha_x + 3, 210);
                    $auxiliar = true;
                }
                /** */
                $auxiliar = false;
            }
            $pos_fecha_x += 2;
        }
        foreach ($datos_asistencias as $datos) {
            $datos_usuario = $obj_usuarios->selectUserByIdReporte($datos['ID_ALUMNO']);
            //DATOS CONTIENE LA INFORMACIÓN RELACIONADA A LAS ASISTENCIAS
            //DATOS USUARIO CONTIENE TODA LA INFORMACIÓN DEL USUARIO
            foreach ($datos_usuario as $usuario) {
                $pdf->Text($pos_x + 1, $pos_y, $k->dec($usuario['MATRICULA']));
                $pdf->Text($pos_x + 13, $pos_y, $k->dec($usuario['APELLIDO_PATERNO']));
                $pdf->Text($pos_x + 33, $pos_y, $k->dec($usuario['APELLIDO_MATERNO']));
                $pdf->Text($pos_x + 53, $pos_y, $k->dec($usuario['NOMBRES']));
                $asistencias_estudiante = $obj_asistencias->selectAsistenciasFromIdTallerPeriodoIdEstudiante($id_taller, $periodo, $usuario['ID_USUARIO']);
                foreach($asistencias_estudiante as $asistencia_individual){
                    $pdf->Text($pos_asistencia_x+1, $pos_asistencia_y, ($asistencia_individual['ASISTENCIA']));
                    $pos_asistencia_x+=2;
                }
                $pos_asistencia_x=74;
                $pos_asistencia_y+=3;
                $pdf->Line(0, $pos_y + 0.5, 280, $pos_y + 0.5);
                $pos_y = $pos_y + 3;
            } //datos usuario
        } //datos asistencias
        $pdf->Output();
    }
}
