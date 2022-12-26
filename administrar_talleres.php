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
} else {
    include_once("./cabecera.php");
?>

    <div class="card text-center" style="height:100%; position:relative;left:0%">
        <br>
        <div class="card-body">
            <a href="./registrar_taller.php" class="btn btn-success" style="width: 60%;">Crear nuevo taller</a>
            <br><br>
            <div class="card">
                <P class="card-header" style="color:#0860DF; font-size:large;font-family:Bodoni MT Black">TALLERES REGISTRADOS</P>
                <div class="card-body">
                    <!------------------------------------------------------------------------------------------->
                    <?php
                    include_once("./Modelo/Talleres/Consultar_taller.php");
                    $obj_talleres = new Consultar_taller();
                    $datos = $obj_talleres->selectTalleresFromIdProfesor();
                    include_once("./Controlador/key.php");
                    $k = new key();
                    ?>
                    <div style="overflow-x: auto; white-space: nowrap;">
                        <table class="table table-hover" border="2px" style="table-layout:auto ;">
                            <thead>
                                <tr>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">NOMBRE TALLERES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">LUNES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">MARTES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">MIERCOLES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">JUEVES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">VIERNES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">SABADO</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">DOMINGO</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">CLAVE</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black;">DESCRIPCION</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">SALON</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">CUPO</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">DEPARTAMENTO</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">LUGARES DISPONIBLES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">IMAGENES</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">ESTATUS</th>
                                    <th style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">OPERACION</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($datos as $d) {
                                ?>
                                    <tr>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['NOMBRE']);
                                            if ($d['STATUS'] == 1) {
                                                date_default_timezone_set("America/Mexico_City");
                                                $dia = date("d");
                                                $mes = date("F");
                                                $year = date("o");
                                            }
                                            ?>

                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['LUNES']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['MARTES']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['MIERCOLES']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['JUEVES']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['VIERNES']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['SABADO']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['DOMINGO']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['CLAVE']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black; white-space: normal;">
                                            <?php echo $k->dec($d['DESCRIPCION']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['SALON']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo ($d['CUPO']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo $k->dec($d['DEPARTAMENTO']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php echo ($d['LUGARES_DISPONIBLES']); ?>
                                        </td>
                                        <td style="color:#032F51; font-size:medium;font-family:Bodoni MT Black">
                                            <?php
                                            include_once("./Modelo/Fotos/Consultar_foto.php");
                                            $obj_fotos = new Consultar_foto();
                                            $data = $obj_fotos->selectFotoPorIdTaller($d['ID_TALLER']);
                                            ?>
                                            <a class="btn btn-success" href="./administrar_talleres_agregar_foto.php?id=<?php echo ($d["ID_TALLER"]) ?>&u=<?php echo ($_SESSION["user"]) ?>&p=<?php echo ($_SESSION["ID"]) ?>&n=<?php echo $d['NOMBRE'] ?>" style="width:210px ;">AGREGAR NUEVA FOTO</a>
                                            <br><br>
                                            <div id="carrusel-contenido">
                                                <div id="carrusel-caja" style="height: 300px;width: 300%;">
                                                    <?php foreach ($data as $foto) { ?>
                                                        <div class="carrusel-elemento">
                                                            <img class="imagenes" style="width: 100%;height:100%" src="data:image/png;base64,<?php echo strval($k->dec($foto['FOTO'])); ?>">
                                                            <br><br>
                                                            <a class="btn btn-danger" onClick="return confirm('Confirmar eliminación')" href="./Controlador/eliminar_foto.php?id=<?php echo ($d["ID_TALLER"]) ?>&p=<?php echo ($_SESSION["ID"]) ?>&id_f=<?php echo $foto['ID_FOTO'] ?>&u=<?php echo ($_SESSION["user"]) ?>" style="width:70% ;">ELIMINAR FOTO</a>

                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($d['STATUS'] == 1) {
                                                echo "Activo";
                                            } else {
                                                echo "Inactivo";
                                            } ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="./administrar_taller_alumnos.php?i=<?php echo ($d["ID_TALLER"]) ?>&u=<?php echo ($_SESSION["user"]) ?>&p=<?php echo ($_SESSION["ID"]) ?>" style="width:100% ;">LISTA DE ALUMNOS INSCRITOS</a>
                                            <br><br>
                                            <a class="btn btn-primary" href="./administrar_talleres_actualizar.php?id=<?php echo ($d["ID_TALLER"]) ?>&u=<?php echo ($_SESSION["user"]) ?>&p=<?php echo ($_SESSION["ID"]) ?>" style="width:100% ;">MODIFICAR DATOS TALLER</a>
                                            <br><br>
                                            <a class="btn btn-info" href="./administrar_talleres_asistencia.php?id=<?php echo ($d["ID_TALLER"]) ?>&u=<?php echo ($_SESSION["user"]) ?>&p=<?php echo ($_SESSION["ID"]) ?>" style="width:100% ;">ASISTENCIA DEL DÍA <?php echo $dia . " - " . $mes . " - " . $year ?></a>
                                            <br><br>
                                            <a class="btn btn-warning" href="./administrar_talleres_asistencia_reporte.php?id=<?php echo ($d["ID_TALLER"]) ?>&u=<?php echo ($_SESSION["user"]) ?>&p=<?php echo ($_SESSION["ID"]) ?>" style="width:100% ;">GENERAR REPORTE DE ASISTENCIA</a>
                                            <br><br>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
}
?>