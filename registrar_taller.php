<?php
$GLOBALS['menu'] = 'BOLSA DE TRABAJO';
include_once("./cabecera.php");
?>

<div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
    <div class="card-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <font size="6" face="Cooper Black" color="#3CA43C">
                    <h5 class="card-header">Formulario de registro de talleres </h5>
                </font>
                <div class="card-body">
                    <font size="4" face="Constantia" color="#3CA43C">
                        <p class="card-text">
                            NOMBRE TALLER<br><br><input name="nombre_taller" type="text"> <br><br>
                            <hr>
                            HORARIO Y DÍA EN QUE SE VA A IMPARTIR EL TALLER <br><i>Dejar en blanco en caso de que algún día no aplique</i><br><br>
                            LUNES <input name="lunes" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            MARTES <input name="martes" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            MIERCOLES <input name="miercoles" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            JUEVES <input name="jueves" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            VIERNES <input name="viernes" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            SABADO <input name="sabado" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            DOMINGO <input name="domingo" type="text" placeholder="Ejemplo 12:00-13:00"> <br><br>
                            CLAVE DEL TALLER <br><i>Lo proporciona el departamento, dejar en blanco en caso de no contar con clave</i><br><br><input name="clave" type="text"> <br><br>
                            DESCRIPCIÓN TALLER<br><i>Ingresa información relevante y atractiva acerca del taller (Productos, aptitudes, información general)</i><br><br><input name="descripcion" type="text"> <br><br>
                            SALON EN EL QUE SE IMPARTIRA EL TALLER <br><i>Dejar en blanco en caso de no contar con salon</i><br><br><input name="salon" type="text"> <br><br>
                            CUPO DEL TALLER<br><i>Ingresa el número de estudiantes que pueden inscribirse al taller</i><br><input name="cupo" type="text"><br><br>
                            DEPARTAMENTO DEL TALLER<br><i>Ingresa el departamento al cual pertenece el taller (Ecotec) </i><br><input name="departamento" type="text"><br><br>
                            <?php include("./Controlador/registro_taller.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="REGISTRAR" name="registrar_taller">
                            <br></br>
                            <a href="./administrar_talleres.php"> <input class="btn btn-success" style="width: 60%;" type="button" value="REGRESAR"></a>

                </div>
            </div>
            <br>
        </form>
    </div>
</div>
<?php
include_once("./pie.php");
?>