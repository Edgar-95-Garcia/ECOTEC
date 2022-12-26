<?php
$GLOBALS['menu'] = 'administrar_talleres';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin"]) == null) { //se verifica que exista sesion en el servidor
?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_GET['id']) && isset($_GET['u']) && isset($_GET['p'])) {
    //se verifica que la ruta ingresada sea igual al de la sesion generada
    include_once("./Controlador/key.php");
    $k = new key();
    if ($_SESSION["user"] == $_GET['u']) {
        include_once("./cabecera.php");
        date_default_timezone_set("America/Mexico_City");
        $id_taller = $_GET['id'];
        $dia = date("d");
        $mes = date("F");
        $year = date("o");
        include_once("./Modelo/Talleres/Consultar_taller.php");
        $obj_talleres = new Consultar_taller();
        $datos = $obj_talleres->selectTallerFromIdTaller($id_taller);
        foreach ($datos as $nombre_taller) {
            $nombre = $k->dec($nombre_taller['NOMBRE']);
        }
        include_once("./Modelo/TalleresAlumnos/Consultar_taller_alumno.php");
        $obj_taller_alumnos = new Consultar_taller_alumno();
        $datos_taller_alumnos = $obj_taller_alumnos->selectAlumnosTallerByIdTaller($id_taller);
    ?>

        <div class="card text-center" style="height:100%; position:relative;left:0%">
            <br>
            <div class="card-body">
                <div class="card">
                    <P class="card-header" style="color:#0860DF; font-size:large;font-family:Bodoni MT Black">ASISTENCIA DEL DÍA <?php echo $dia . " - " . $mes . " - " . $year ?> <br> PARA EL TALLER CON NOMBRE <?php echo $nombre ?></P>
                    <div class="card-body">
                        <!------------------------------------------------------------------------------------------->

                        <div style="overflow-x: auto; white-space: nowrap;">
                            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">SELECCIONA PERIODO</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="periodo">
                                        <option value="Enero - Junio <?php echo $year; ?>">Enero - Junio <?php echo $year; ?></option>
                                        <option value="Agosto - Diciembre <?php echo $year; ?>">Agosto - Diciembre <?php echo $year; ?></option>
                                    </select>
                                </div>
                                <table class="table table-hover" border="2px" style="table-layout:auto ;">
                                    <thead>
                                        <tr>
                                            <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">MATRICULA ALUMNO</th>
                                            <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">NOMBRES ALUMNO</th>
                                            <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">APELLIDO PATERNO</th>
                                            <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">APELLIDO MATERNO</th>
                                            <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">ASISTENCIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $contador_alumnos = 0; //sirve para identificar cada uno de los input-radio generados dinámicamente
                                        //y así poder obtener sus datos para cada alumno 
                                        include_once("./Modelo/Usuarios/Consultar_usuario.php");
                                        $obj_usuarios = new Consultar_usuario();
                                        if ($datos_taller_alumnos == null) {
                                        ?>
                                            <tr>
                                                <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black" colspan="6">
                                                    <i>NO HAY ALUMNOS INSCRITOS EN EL TALLER</i>
                                                </td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($datos_taller_alumnos as $alumnos) {
                                                $datos_usuario = $obj_usuarios->selectUserById($alumnos['ID_ALUMNO']);
                                                foreach ($datos_usuario as $datos_alumno) {
                                            ?>
                                                    <tr>
                                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                                            <?php echo $k->dec($datos_alumno['MATRICULA']) ?>
                                                        </td>
                                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                                            <?php echo $k->dec($datos_alumno['NOMBRES']) ?>
                                                        </td>
                                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                                            <?php echo $k->dec($datos_alumno['APELLIDO_PATERNO']) ?>
                                                        </td>
                                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                                            <?php echo $k->dec($datos_alumno['APELLIDO_MATERNO']) ?>
                                                        </td>
                                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black; text-align:left">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="alumno<?php echo $contador_alumnos; ?>" id="alumno<?php echo $contador_alumnos; ?>" value="No especificado" checked>
                                                                <label class="form-check-label">
                                                                    No especificado
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="alumno<?php echo $contador_alumnos; ?>" id="alumno<?php echo $contador_alumnos; ?>" value="Asistencia">
                                                                <label class="form-check-label">
                                                                    Asistencia
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="alumno<?php echo $contador_alumnos; ?>" id="alumno<?php echo $contador_alumnos; ?>" value="Falta">
                                                                <label class="form-check-label">
                                                                    Falta
                                                                </label>
                                                                <input type="hidden" name="alumno_id<?php echo $contador_alumnos; ?>" value="<?php echo $datos_alumno['ID_USUARIO'] ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $contador_alumnos++;
                                                }
                                            }
                                            ?>
                                    </tbody>
                                <?php
                                        }
                                ?>
                                </table>
                                <input type="hidden" name="total" value="<?php echo $contador_alumnos; ?>">
                                <input type="hidden" name="taller" value="<?php echo $id_taller; ?>">
                                <input type="hidden" name="fecha" value="<?php echo $dia . ' - ' . $mes . ' - ' . $year ?>">
                                <?php include_once("./Controlador/registro_asistencia.php");
                                if ($contador_alumnos != 0) {
                                ?>
                                    <input class="btn btn-primary" style="width:50%" type="submit" value="Registrar Asistencia" name="aceptar_asistencia">
                                <?php
                                }
                                ?>
                            </form>

                        </div>
                        <!------------------------------------------------------------------------------------------->
                    </div>
                    <br>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    <?php
        include_once("./pie.php");
    } else {
    ?>
        <script>
            window.location.replace("index.php");
        </script>
    <?php
    }
} else {
    ?>
    <script>
        window.location.replace("index.php");
    </script>
<?php
}
?>