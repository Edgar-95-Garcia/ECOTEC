<?php
$GLOBALS['menu'] = 'administrar_talleres';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
<?php
} else if (isset($_SESSION["admin_ecotec"]) == "ecotec" && isset($_GET["id"]) && isset($_GET["u"])) {
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    $id_taller = $_GET['id']; //id_taller
    $u = $k->dec($_GET['u']); //variable de sesion
?>
    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <br>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <!------------------------------------------------------------------------------------------->
                    <?php
                    include_once("./Modelo/Talleres/Consultar_taller.php");
                    $obj_talleres = new Consultar_taller();
                    $datos = $obj_talleres->selectTallerFromIdTaller($id_taller);
                    include_once("./Controlador/key.php");
                    $k = new key();
                    ?>
                    <?php
                    foreach ($datos as $d) {
                    ?>
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <font size="6" face="Cooper Black" color="#3CA43C">
                                    <h5 class="card-header">Formulario de actualización de talleres </h5>
                                </font>
                                <div class="card-body">
                                    <font size="4" face="Constantia" color="#3CA43C">
                                        <p class="card-text">
                                            <input type="hidden" name="id_taller" value="<?php echo ($d['ID_TALLER']); ?>">
                                            NOMBRE TALLER<br><br><input name="nombre_taller" type="text" value="<?php echo $k->dec($d['NOMBRE']); ?>"> <br><br>
                                            <hr>
                                            HORARIO Y DÍA EN QUE SE VA A IMPARTIR EL TALLER <br><br>
                                            LUNES <input name="lunes" type="text" value="<?php echo $k->dec($d['LUNES']); ?>"> <br><br>
                                            MARTES <input name="martes" type="text" value="<?php echo $k->dec($d['MARTES']); ?>"> <br><br>
                                            MIERCOLES <input name="miercoles" type="text" value="<?php echo $k->dec($d['MIERCOLES']); ?>"> <br><br>
                                            JUEVES <input name="jueves" type="text" value="<?php echo $k->dec($d['JUEVES']); ?>"> <br><br>
                                            VIERNES <input name="viernes" type="text" value="<?php echo $k->dec($d['VIERNES']); ?>"> <br><br>
                                            SABADO <input name="sabado" type="text" value="<?php echo $k->dec($d['SABADO']); ?>"> <br><br>
                                            DOMINGO <input name="domingo" type="text" value="<?php echo $k->dec($d['DOMINGO']); ?>"> <br><br>
                                            CLAVE DEL TALLER <br><br><input name="clave" type="text" value="<?php echo $k->dec($d['CLAVE']); ?>"> <br><br>
                                            DESCRIPCIÓN TALLER<br><br><br><input name="descripcion" type="text" value="<?php echo $k->dec($d['DESCRIPCION']); ?>"> <br><br>
                                            SALON EN EL QUE SE IMPARTIRA EL TALLER <br><br><br><input name="salon" type="text" value="<?php echo $k->dec($d['SALON']); ?>"> <br><br>
                                            CUPO DEL TALLER<br><br><input name="cupo" type="text" value="<?php echo ($d['CUPO']); ?>"><br><br>
                                            DEPARTAMENTO DEL TALLER<br><br><input name="departamento" type="text" value="<?php echo $k->dec($d['DEPARTAMENTO']); ?>"><br><br>
                                            ESTATUS DEL TALLER <br><br><input name="status" type="text" value="<?php echo $d['STATUS'] == 1 ? 'Activo' : 'Inactivo';  ?>"><br><br>
                                            <hr>
                                            <?php
                                            include_once("./Modelo/Usuarios/Consultar_usuario.php");
                                            $obj_usuario = new Consultar_usuario();
                                            $datos_usuario = $obj_usuario->selectUsersProfesor()
                                            ?>
                                            SELECCIONA PROFESOR A CARGO <br><br><select name="profesor" id="profesor">
                                                <?php
                                                foreach ($datos_usuario as $usuario) {
                                                ?>
                                                    <option <?php echo $d['ID_PROFESOR'] == $usuario['ID_USUARIO'] ? "selected='selected'" : "" ?> value="<?php echo $usuario['ID_USUARIO'] ?>"> <?php echo $k->dec($usuario['NOMBRES']) . ' ' . $k->dec($usuario['APELLIDO_PATERNO']) . ' ' . $k->dec($usuario['APELLIDO_MATERNO']) ?> </option>;
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br><br>
                                            <?php include("./Controlador/modificar_taller.php"); ?>
                                            <a class="btn btn-success" href="./admon_administrar_talleres.php" style="width:60% ;">CANCELAR</a>
                                            <br><br>
                                            <input type="submit" class="btn btn-success" style="width: 60%;" value="ACTUALIZAR" name="modificar_taller">
                                            <br></br>
                                </div>
                            </div>
                            <br>
                        </form>
                    <?php
                    }
                    ?>
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
?>