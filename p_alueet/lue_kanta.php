<?php

unset($_SESSION['alueet']);
unset($_SESSION['alueilmot']);
unset($_SESSION['omatalueet']);

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

// alueet

$qa = "SELECT * FROM ".$table['alueet']." ORDER BY nimi ASC;";
$r = mysqli_query($l, $qa) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['alueet'][$data['id']] = $data;
}

// alueilmot

$qai = "SELECT etunimi, sukunimi, puhelin, email, alue FROM ".$table['alueilmot']." AL INNER JOIN ".$table['tekijat']." TEK ON TEK.id = AL.tekija ORDER BY sukunimi, etunimi ASC;";
$r = mysqli_query($l, $qai) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['alueet'][$data['alue']]['ilmot'][] = $data;
}

// tekijän alueilmot

$_SESSION['omatalueet'] = array();
$qoa = "SELECT * FROM ".$table['alueilmot']." WHERE tekija='".$tekija['id']."'";
$r = mysqli_query($l, $qoa) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['omatalueet'][$data['id']] = $data['alue'];
}


mysqli_close($l);

?>
