<?php

unset($_SESSION['tapahtumailmot']);
unset($_SESSION['tapahtumat']);
unset($_SESSION['alueet']);
unset($_SESSION['alueilmot']);
unset($_SESSION['tilaukset']);
unset($_SESSION['tuotteet']);

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

$tekija = lueTekija($l, $table['tekijat'], $_SESSION[$prefix.'_tekija']);

// tapahtumat

$qt = "SELECT * FROM ".$table['tapahtumat'].";";
$r = mysqli_query($l, $qt) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tapahtumat'][$data['id']] = $data;
}

// tapahtumailmot

$qti = "SELECT * FROM ".$table['tapahtumailmot']." WHERE tekija='".$tekija['id']."' AND tyyppi != 'enpaase';";
$r = mysqli_query($l, $qti) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  if (strtotime($_SESSION['tapahtumat'][$data['tapahtuma']]['alku']) < strtotime(date('Y-m-d'))) {
    $data['dedis'] = true;
  }
  $_SESSION['tapahtumailmot'][$data['id']] = $data;
}

// alueet

$qa = "SELECT * FROM ".$table['alueet'].";";
$r = mysqli_query($l, $qa) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['alueet'][$data['id']] = $data;
}

// alueilmot

$qa = "SELECT * FROM ".$table['alueilmot']." WHERE tekija='".$tekija['id']."'";
$r = mysqli_query($l, $qa) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['alueilmot'][$data['id']] = $data;
}

// tuotteet

$q = "SELECT * FROM ".$table['tuotteet'].";";
$r = mysqli_query($l, $q) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tuotteet'][$data['id']] = $data;
}

// tilaukset

$qj = "SELECT * FROM ".$table['tilaukset']." WHERE tekija='".$tekija['id']."';";
$r = mysqli_query($l, $qj) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tilaukset'][$data['id']] = $data;
}

mysqli_close($l);

?>
