<?php
$GLOBALS['menu'] = 'talleres/horarios';
include_once("./cabecera.php");
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION["user"]) == null) {
?>
  <script>
    document.location.replace("index.php");
  </script>
<?php
} else {
  include_once("./cabecera.php");
?>


  <br>
  <CENTER>
    <font size="6" face="Ravie" color="#072373"> <br>
      ¡¡VEN e INSCRIBETE A UNO DE NUESTROS TALLERES!!
      </br></font>
  </CENTER>
  </center>
  </font></br>
  <br></br>
  <?php
  include_once("./Controlador/key.php");
  $k = new key();
  include_once("./Modelo/Talleres/Consultar_taller.php");
  $obj_talleres = new Consultar_taller();
  $datos_talleres = $obj_talleres->selectTalleresDisponibles($_SESSION["id"]);
  include_once("./Modelo/Fotos/Consultar_foto.php");
  $obj_fotos = new Consultar_foto();
  if ($datos_talleres != null) {
    foreach ($datos_talleres as $data) {
      $datos_fotos = $obj_fotos->selectFotoPorIdTaller($data["ID_TALLER"]);
  ?>
      <div class="card" style="width: 50%; text-align:center;position:relative;left:25%;">
        <?php
        if ($datos_fotos != null) {
        ?>
          <div id="carrusel-contenido" style="width:60%">
            <div id="carrusel-caja">
              <?php
              foreach ($datos_fotos as $foto_individual) {
              ?>
                <div class="carrusel-elemento" style="text-align:center ;">
                  <img class="imagenes" style="width: 100%;height:100%" src="data:image/png;base64,<?php echo strval($k->dec($foto_individual['FOTO'])); ?>">
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        <?php
        }
        ?>
        <div class="card-body">
          <h3 class="card-title"><strong><?php echo $k->dec($data["NOMBRE"]) ?></strong></h3>
          <hr>
          <p class="card-text"><?php echo $k->dec($data["DESCRIPCION"]) ?></p>
          <hr>
          <p class="card-text">HORARIOS: <br></p>
          <p><?php echo $k->dec($data["LUNES"]) == null ?  "" : "LUNES: " . $k->dec($data["LUNES"]) ?></p>
          <p><?php echo $k->dec($data["MARTES"]) == null ?  "" : "MARTES: " . $k->dec($data["MARTES"]) ?></p>
          <p><?php echo $k->dec($data["MIERCOLES"]) == null ?  "" : "MIÉRCOLES: " . $k->dec($data["MIERCOLES"]) ?></p>
          <p><?php echo $k->dec($data["JUEVES"]) == null ?  "" : "JUEVES: " . $k->dec($data["JUEVES"]) ?></p>
          <p><?php echo $k->dec($data["VIERNES"]) == null ?  "" : "VIERNES: " . $k->dec($data["VIERNES"]) ?></p>
          <p><?php echo $k->dec($data["SABADO"]) == null ?  "" : "SÁBADO: " . $k->dec($data["SABADO"]) ?></p>
          <p><?php echo $k->dec($data["DOMINGO"]) == null ?  "" : "DOMINGO: " . $k->dec($data["DOMINGO"]) ?></p>
          <hr>
          <p class="card-text">SALON: <br></p>
          <p class="card-text"><?php echo $k->dec($data["SALON"]) ?></p>


        </div>

        <div class="card-body">
          <?php
          if (isset($_SESSION["admin"]) != null) {
          ?>
            <a class='card-link btn btn-danger' style="color:wheat">PROFESORES NO PUEDEN INSCRIBIRSE A TALLERES</a>
          <?php
          } else if (isset($_SESSION["admin"]) == null) {
          ?>
            <a href="./Controlador/alta_taller_alumno.php?id=<?php echo $data["ID_TALLER"] ?>&a=<?php echo $_SESSION["id"] ?>" onClick="return confirm('Verificar que el horario no se sobreponga al de clases.\nPara darse de baja de un taller se tiene que acercar al departamento de ECOTEC.\n ¿Continuar?')" class="card-link btn btn-primary">INSCRIBIRSE A ESTE TALLER</a>
          <?php
          }
          ?>
        </div>
      </div>
      <br><br>
  <?php
    }
  }
  ?>


<?php
  include_once("./pie.php");
} ?>