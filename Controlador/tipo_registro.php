<?php
include_once("./Modelo/Config/Consultar_config.php");
$config = new Consultar_config();
$resul = $config->select_config();
foreach ($resul as $r) {
    $t = $r['re9HPwQlYcY1sJYMVA=='];
    $c = $r['sOtAIxclbMs='];
}
if ($t == 0) {
    include_once("./Controlador/key.php");
    $k = new key();
    //Se usa configuracion 0, es decir, por contraseña del sistema";
    echo 'CONTRASEÑA DE REGISTRO <br><i>*TE LA PROPORCIONA EL ENCARGADO DEL DEPARTAMENTO DE ECOTEC</i> <br><br><input name="pass_registro" type="text"><br><br>';
} else {
}
