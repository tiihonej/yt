<?php

switch ($_SESSION['sort']['s']) {
  case "etunimi": $jarjestys = 'etunimi'; break;
  case "email": $jarjestys = 'email'; break;
  case "nick": $jarjestys = 'nick'; break;
  case "puhelin": $jarjestys = 'puhelin'; break;
  case "muokattu": $jarjestys = 'muokattu'; break;
  case "facebook": $jarjestys = 'facebook'; break;
  default: $jarjestys = 'sukunimi';
}

$dir = ($_SESSION['sort']['d']) ? 'desc' : 'asc';

unset($_SESSION['tekijat']);
unset($_SESSION['idt']);

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

$q = "SELECT * "
    ."FROM ".$table['tekijat']." "
    ."ORDER BY ".$jarjestys." ".$dir.";";
$r = mysqli_query($l, $q) or die('Köyrintä epäonnistui');

while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tekijat'][$data['id']] = $data;
  $_SESSION['idt'][] = $data['id'];
}

mysqli_close($l);

?>
