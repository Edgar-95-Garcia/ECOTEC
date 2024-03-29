<?php
$GLOBALS['menu'] = 'administrar_talleres';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin"]) == null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_GET["i"]) && isset($_GET["p"]) && isset($_GET["p"])) {
    $id = $_GET["i"]; //id taller
    $p = $_GET["p"]; //id profesor
    $sesion = $_GET["u"];
    if ($_SESSION["ID"] == $p && $_SESSION["user"] == $sesion) {
        include_once("./cabecera.php");
        include_once("./Controlador/key.php");
        $k = new key();
        include_once("./Modelo/TalleresAlumnos/Consultar_taller_alumno.php");
        $obj_talleres_alumnos = new Consultar_taller_alumno();
        $id_alumnos = $obj_talleres_alumnos->selectAlumnosTallerByIdTaller($id);
        include_once("./Modelo/Talleres/Consultar_taller.php");
        $obj_talleres = new Consultar_taller();
        include_once("./Modelo/Usuarios/Consultar_usuario.php");
        $obj_usuarios = new Consultar_usuario();
        $datos_taller = $obj_talleres->selectTallerFromIdProfesor($id, $p);

        foreach ($datos_taller as $taller) {
            $nombre = $k->dec($taller['NOMBRE']);
            $lugares = $taller['LUGARES_DISPONIBLES'];
        }

    ?>

        <div class="card text-center" style="height:100%; position:relative;left:0%">
            <br>
            <div class="card-body">
                <div class="card">
                <font size="5" face="Elephant" color="#032F51"> <h5 class="card-header">A continuación se enlistan los alumnos registrados en el taller con nombre: <?php echo $nombre ?> <br>Que tiene <?php echo $lugares ?> lugares disponibles</h5></font>
                    <div class="card-body">
                        <div style="overflow-x: auto; white-space: nowrap;">
                            <table class="table table-hover" border="2px" style="table-layout:auto;">
                                <thead>
                                <tr> 
                                        <th>NOMBRE (s)</th>
                                        <th >APELLIDO PATERNO</th>
                                        <th >APELLIDO MATERNO</th>
                                        <th >MATRICULA</th>
                                        <th >FECHA EN QUE SE INSCRIBIÓ ALUMNO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($id_alumnos as $alumno) {
                                        $id = $alumno['ID_ALUMNO'];
                                        $datos_usuarios = $obj_usuarios->selectUserById($id);
                                        foreach ($datos_usuarios as $datos) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $k->dec($datos['NOMBRES']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $k->dec($datos['APELLIDO_PATERNO']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $k->dec($datos['APELLIDO_MATERNO']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $k->dec($datos['MATRICULA']); ?>
                                                </td>
                                                <td>
                                                    <?php echo ($alumno['FECHA_ALTA']); ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
<?php
        include_once("./pie.php");
    }
}
?>