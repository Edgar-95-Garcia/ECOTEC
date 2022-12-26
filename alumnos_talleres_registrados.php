<?php
$GLOBALS['menu'] = 'talleres_registrados';
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
  <div style="text-align:center ;">

    <font size="4" face="Cooper Black" color="#072373">
      <p>A CONTINUACIÓN SE ENLISTAN LOS TALLERES <br>EN LOS QUE TE HAS REGISTRADO:</br></p>
    </font>
  </div>
  <br></br>
  <?php
  include_once("./Controlador/key.php");
  $k = new key();
  include_once("./Modelo/Talleres/Consultar_taller.php");
  $obj_talleres = new Consultar_taller();
  $datos_talleres = $obj_talleres->selectTalleresRegistrados($_SESSION["id"]);
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
          <font size="" face="Bodoni MT Black" color="#072373">
            <p class="card-text">HORARIOS: <br></p>
          </font>
          <font size="" face="Constantia" color="#072373">
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
            <hr>
            <font size="" face="Bodoni MT Black" color="#072373">
              <p class="card-text">FECHA EN QUE SE REALIZÓ REGISTRO: <br></p>
            </font>
            <?php
            $datos_fecha = $obj_talleres->selectTalleresRegistradosFechaAltaIdTallerIdAlumno($data['ID_TALLER'], $_SESSION["id"]);
            foreach ($datos_fecha as $fecha) {
            ?>
              <p class="card-text"><?php echo ($fecha["FECHA_ALTA"]) ?></p>
            <?php
            }
            ?>
          </font>
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