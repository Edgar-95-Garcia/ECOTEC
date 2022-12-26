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
    include_once("./Modelo/Talleres/Consultar_taller.php");
    $obj_talleres = new Consultar_taller();
    $datos_talleres = $obj_talleres->selectTalleres();
?>

    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <br>
        <div class="card-body">
            <div class="card">
                <h5 class="card-header">TALLERES REGISTRADOS EN SISTEMA</h5>
                <div class="card-body">
                    <div style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-hover" border="2px" style="table-layout:auto; ">
                            <thead>
                                <tr>
                                    <th>PROFESOR A CARGO</th>
                                    <th>NOMBRE</th>
                                    <th>HORARIO</th>
                                    <th>CLAVE</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>SALÓN</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>CUPO</th>
                                    <th>LUGARES DISPONIBLES</th>
                                    <th>OPERACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($datos_talleres as $taller) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            include_once("./Modelo/Usuarios/Consultar_usuario.php");
                                            $obj_usuarios = new Consultar_usuario();
                                            $nombre = null;
                                            $datos_usuario = $obj_usuarios->selectUsersProfesorById($taller['ID_PROFESOR']);
                                            if ($datos_usuario == null) {
                                                echo 'No hay profesor asignado';
                                            } else {
                                                foreach ($datos_usuario as $profesor) {
                                                    $nombre = $k->dec($profesor['NOMBRES']) . " " . $k->dec($profesor['APELLIDO_PATERNO']) . " " . $k->dec($profesor['APELLIDO_MATERNO']);
                                                }
                                                echo $nombre;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($taller['NOMBRE']); ?>
                                        </td>
                                        <td>
                                            <p><?php echo $k->dec($taller["LUNES"]) == null ?  "" : "LUNES: " . $k->dec($taller["LUNES"]) ?></p>
                                            <p><?php echo $k->dec($taller["MARTES"]) == null ?  "" : "MARTES: " . $k->dec($taller["MARTES"]) ?></p>
                                            <p><?php echo $k->dec($taller["MIERCOLES"]) == null ?  "" : "MIÉRCOLES: " . $k->dec($taller["MIERCOLES"]) ?></p>
                                            <p><?php echo $k->dec($taller["JUEVES"]) == null ?  "" : "JUEVES: " . $k->dec($taller["JUEVES"]) ?></p>
                                            <p><?php echo $k->dec($taller["VIERNES"]) == null ?  "" : "VIERNES: " . $k->dec($taller["VIERNES"]) ?></p>
                                            <p><?php echo $k->dec($taller["SABADO"]) == null ?  "" : "SÁBADO: " . $k->dec($taller["SABADO"]) ?></p>
                                            <p><?php echo $k->dec($taller["DOMINGO"]) == null ?  "" : "DOMINGO: " . $k->dec($taller["DOMINGO"]) ?></p>
                                            
                                        </td>
                                        <td>
                                            <?php echo $k->dec($taller['CLAVE']); ?>
                                        </td>
                                        <td style="white-space: normal;">
                                            <?php echo $k->dec($taller['DESCRIPCION']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($taller['SALON']); ?>
                                        </td>
                                        <td>
                                            <?php echo $k->dec($taller['DEPARTAMENTO']); ?>
                                        </td>
                                        <td>
                                            <?php echo ($taller['CUPO']); ?>
                                        </td>
                                        <td>
                                            <?php echo ($taller['LUGARES_DISPONIBLES']); ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="./admon_administrar_taller_modificar.php?id=<?php echo ($taller["ID_TALLER"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">MODIFICAR</a>
                                            <br><br>
                                            <a class="btn btn-success" href="./admon_administrar_taller_alumnos.php?id=<?php echo ($taller["ID_TALLER"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">ADMINISTRAR ALUMNOS</a>
                                            <br><br>
                                            <a class="btn btn-danger" onClick="return confirm('Confirmar eliminación')" href="./Controlador/eliminar_taller.php?id=<?php echo ($taller["ID_TALLER"]) ?>&u=<?php echo $k->enc($_SESSION["admin_ecotec"]) ?>" style="width:210px ;">ELIMINAR</a>

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