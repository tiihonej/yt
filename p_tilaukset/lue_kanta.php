<?php

unset($_SESSION['tuotteet']);
unset($_SESSION['tilaukset']);

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

// tuotteet

$q = "SELECT * FROM ".$table['tuotteet'].";";
$r = mysqli_query($l, $q) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tuotteet'][$data['id']] = $data;
}

// omat tilaukset

$qj = "SELECT * FROM ".$table['tilaukset']." WHERE tekija='".$tekija['id']."';";
$r = mysqli_query($l, $qj) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tilaukset'][$data['id']] = $data;
}

// kaikki tilaukset

$qj = "SELECT tuote, etunimi, sukunimi, koko, maara, maksettu, lunastettu FROM ".$table['tilaukset']." TIL INNER JOIN ".$table['tekijat']." TEK ON TIL.tekija = TEK.id ORDER BY sukunimi, etunimi;";
$r = mysqli_query($l, $qj) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tuotteet'][$data['tuote']]['tilaukset'][] = $data;
  $_SESSION['tuotteet'][$data['tuote']]['koot'][$data['koko']][] = $data['maara'];
}

mysqli_close($l);

?>
