<?php
$GLOBALS['menu'] = 'admon';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_SESSION["admin_ecotec"]) == "ecotec" && isset($_GET['id']) && isset($_GET['u'])) {
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    $id_taller = $_GET["id"]; //id taller
    $id = $_GET["id"]; //id taller
    $sesion = $k->dec($_GET["u"]); //sesion
    if ($_SESSION["admin_ecotec"] == $sesion) {
        include_once("./Modelo/TalleresAlumnos/Consultar_taller_alumno.php");
        $obj_talleres_alumnos = new Consultar_taller_alumno();
        $id_alumnos = $obj_talleres_alumnos->selectAlumnosTallerByIdTaller($id_taller);
        include_once("./Modelo/Talleres/Consultar_taller.php");
        $obj_talleres = new Consultar_taller();
        include_once("./Modelo/Usuarios/Consultar_usuario.php");
        $obj_usuarios = new Consultar_usuario();
        $datos_taller = $obj_talleres->selectTallerFromIdTaller($id_taller);

        foreach ($datos_taller as $taller) {
            $nombre = $k->dec($taller['NOMBRE']);
            $lugares = $taller['LUGARES_DISPONIBLES'];
        }
    ?>

        <div class="card text-center" style="height:100%; position:relative;left:0%">
            <br>
            <div class="card-body">
                <div class="card">
                    <h5 class="card-header">A continuación se enlistan los alumnos registrados en el taller con nombre: <br><strong><?php echo $nombre ?></strong> <br>Que tiene <strong><?php echo $lugares ?></strong> lugares disponibles</h5>
                    <div class="card-body">
                        <div style="overflow-x: auto; white-space: nowrap;">
                            <table class="table table-hover" border="2px" style="table-layout:auto;">
                                <thead>
                                    <tr>
                                        <th>NOMBRES ALUMNO</th>
                                        <th>APELLIDO PATERNO</th>
                                        <th>APELLIDO MATERNO</th>
                                        <th>MATRICULA</th>
                                        <th>FECHA EN QUE SE INSCRIBIÓ ALUMNO</th>
                                        <th>OPERACION</th>
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
                                                <td>
                                                    <a class="btn btn-danger" href="./Controlador/eliminar_alumno_taller.php?id=<?php echo $id ?>&u=<?php echo $k->enc(($_SESSION["admin_ecotec"]))?>&t=<?php echo $id_taller?>" style="width:210px ;">ELIMINAR DE TALLER</a>
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
        //llaverito.xp.star@gmail.com
        //081217Ver@
    }
}
?>