<?php

unset($_SESSION['tuonti']);

foreach($oldies as $pref => $oldie) {
  $l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
  $q = "SELECT * "
      ."FROM ".$pref."_tekijat "
      ."ORDER BY sukunimi, etunimi;";
  $r = mysqli_query($l, $q) or die('Köyrintä epäonnistui');

  while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
    $_SESSION['tuonti'][$pref][$data['id']] = $data;
  }
  mysqli_close($l);
}

?>
