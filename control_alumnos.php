<?php 
$GLOBALS['menu'] = 'BOLSA DE TRABAJO';
include_once("./cabecera.php");
?>
<?php
$mes_actual = date('n');
$ano_actual = date('Y');
$i = 1;
$th   =   "";
$td   =   "";
while (checkdate($mes_actual,$i,$ano_actual)) {
   $i<10?$n='0'.$i:$n=$i;
   $th .= "<th class='dia'> $n </th>";
   $td .= "<td class='dia'> </td>";
   $i++;
};
$nombres   =   array("Fulanito","Menganito","Sutanito","Perinseco","Anita","Pepita","Juanita");
?>
<style>
table {
   border-collapse:collapse;
   font-family:Tahoma, Geneva, sans-serif;
   font-size:10px;
   border: 1px solid #999;
}
td, th {
   border:1px solid #CCC;
   padding:2px 5px;
}
th {
   background:#CCC;
   border-color:#999;
}
th.nombre {
   background:none;
}
td.dia {
   text-align:center;
   width:24px;
   height:24px;
   padding:0px;
   overflow:hidden;
}
.nombre {
   text-align:left;
   width:150px;
}
</style>
<table border="0" cellspacing="0" cellpadding="0">
   <tr>
     <th colspan="<?php echo $i+1; ?>" scope="col"><?php echo date('F'); ?></th>
  </tr>
  <tr>
    <th>Nombre</th>
    <?php echo $th; ?>
  </tr>
  <?php 
      $o=0;
      while ($o<count($nombres)) { 
         $o%2?$bg='#EEE':$bg='#FFF';
      ?>
  <tr style="background:<?php echo $bg; ?>">
    <th scope="row" class="nombre"><?php echo $nombres[$o]; ?></th>
    <?php echo $td; ?>
  </tr>
  <?php $o++; }; ?>
</table>

<?php
include_once("./pie.php");