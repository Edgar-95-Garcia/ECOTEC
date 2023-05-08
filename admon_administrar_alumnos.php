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
} else if (isset($_SESSION["admin_ecotec"]) == "ecotec") {
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    include_once("./Modelo/Usuarios/Consultar_usuario.php");
    $obj_profesores = new Consultar_usuario();
    $datos_profesores = $obj_profesores->selectUsersAlumno();
?>

    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <br>
        <div class="card-body">
            <div class="card">
                <h5 class="card-header">ALUMNO REGISTRADOS EN SISTEMA</h5>
                <div class="card-body">
                    <div style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-hover" border="2px" style="table-layout:auto; ">
                            <thead>
                                <tr>
                                    <th>NOMBRES</th>
                                    <th>APELLIDO PATERNO</th>
                                    <th>APELLIDO MATERNO</th>
                                    <th>MATRICULA</th>
                                    <th>TELEFONO CONTACTO</th>
                                    <th>CORREO</th>
                                    <th>CONTRASEÑA</th>
                                    <th>FECHA DE REGISTRO</th>
                                    <th>ESTATUS <br><i>Si el estatus es 0, el usuario no podrá iniciar sesión</i></th>
                                    <th>NIVEL<br><i>El nivel 0 corresponde a los profesores</i><br><i>El nivel 1 corresponde a los alumnos</i></th>
                                    <th>OPERACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($datos_profesores as $profesor) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $k->dec($profesor['NOMBRES']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['APELLIDO_PATERNO']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['APELLIDO_MATERNO']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['MATRICULA']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['TEL_CONTACTO']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['CORREO']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['PASS']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($profesor['FECHA_REGISTRO']); ?>
                                        </td>
                                        <td>
                                            <?php echo ($profesor['STATUS']); ?>
                                        </td>
                                        <td>
                                            <?php echo ($profesor['LEVEL']); ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="./admon_administrar_alumnos_modificar.php?id=<?php echo ($profesor["ID_USUARIO"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">MODIFICAR</a>
                                            <br><br>
                                            <a class="btn btn-danger" onClick="return confirm('Confirmar eliminación')" href="./Controlador/eliminar_alumno.php?id=<?php echo ($profesor["ID_USUARIO"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">ELIMINAR</a>

                                        </td>
                                    </tr>
                                <?php

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
?>