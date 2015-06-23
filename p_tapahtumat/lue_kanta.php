<?php

unset($_SESSION['tapahtumat']);

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

// tapahtumat

$q = "SELECT * FROM ".$table['tapahtumat']." ORDER BY alku ASC;";
$r = mysqli_query($l, $q) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tapahtumat'][$data['id']] = $data;
}

// tapahtumailmot

$qti = "SELECT TAP.id, tyyppi, tekija, tapahtuma, paivat, lisatiedot, etunimi, sukunimi FROM ".$table['tapahtumailmot']." TAP INNER JOIN ".$table['tekijat']." TEK ON TAP.tekija = TEK.id ORDER BY TEK.sukunimi, TEK.etunimi ASC;";
$r = mysqli_query($l, $qti) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  if ( $data['tyyppi'] == 'enpaase' ) {
    $_SESSION['tapahtumat'][$data['tapahtuma']]['pois'][] = $data;
  } else {
    $_SESSION['tapahtumat'][$data['tapahtuma']]['ilmot'][] = $data;
  }
}

// Kyydit

$qk = "SELECT * FROM ".$table['kyydit']." ORDER BY paiva ASC;";
$r = mysqli_query($l, $qk) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tapahtumat'][$data['tapahtuma']][$data['mp']][$data['id']] = $data;
}

// Kyyti-ilmot

$qki = "SELECT KYY.id, KYY.tekija, TEK.etunimi, TEK.sukunimi, KYY.kyyti, KYY.tapahtuma, KYY.mp FROM ".$table['kyytiin']." KYY LEFT JOIN ".$table['tekijat']." TEK ON KYY.tekija = TEK.id ORDER BY TEK.sukunimi,TEK.etunimi ASC;";
$r = mysqli_query($l, $qki) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  if ($data['kyyti'] == 0) {
    $_SESSION['tapahtumat'][$data['tapahtuma']]['omat'][$data['mp']][] = $data;
  } else {
    $_SESSION['tapahtumat'][$data['tapahtuma']][$data['mp']][$data['kyyti']]['ilmot'][] = $data;
  }
}

// Ilman kyytiä

foreach($_SESSION['tapahtumat'] as $tapahtuma) {
  $id = $tapahtuma['id'];
  $qm = "SELECT TAP.tekija, TAP.tapahtuma, T.mp FROM "
       ."( SELECT KTN.tekija, KTN.tapahtuma, KTN.mp FROM ".$table['kyytiin']." KTN "
       ."WHERE (KTN.mp = 'm' AND KTN.tapahtuma = ".$id.") "
       ."UNION SELECT KDT.tekija, KDT.tapahtuma, KDT.mp FROM ".$table['kyydit']." KDT "
       ."WHERE (KDT.mp = 'm' AND KDT.tapahtuma = ".$id.") ) T "
       ."RIGHT JOIN ".$table['tapahtumailmot']." TAP ON TAP.tekija = T.tekija "
       ."WHERE ( T.tekija IS NULL AND TAP.tapahtuma = ".$id." AND TAP.tyyppi != 'enpaase');";
  $qp = "SELECT TAP.tekija, TAP.tapahtuma, T.mp FROM "
       ."( SELECT KTN.tekija, KTN.tapahtuma, KTN.mp FROM ".$table['kyytiin']." KTN "
       ."WHERE (KTN.mp = 'p' AND KTN.tapahtuma = ".$id.") "
       ."UNION SELECT KDT.tekija, KDT.tapahtuma, KDT.mp FROM ".$table['kyydit']." KDT "
       ."WHERE (KDT.mp = 'p' AND KDT.tapahtuma = ".$id.") ) T "
       ."RIGHT JOIN ".$table['tapahtumailmot']." TAP ON TAP.tekija = T.tekija "
       ."WHERE ( T.tekija IS NULL AND TAP.tapahtuma = ".$id." AND TAP.tyyppi != 'enpaase');";
  $r = mysqli_query($l, $qm) or die('Köyrintä epäonnistui');
  while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
    $_SESSION['tapahtumat'][$id]['puuttuu']['m'][] = $data;
  }
  $r = mysqli_query($l, $qp) or die('Köyrintä epäonnistui');
  while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
    $_SESSION['tapahtumat'][$id]['puuttuu']['p'][] = $data;
  }
}
// tekijän tapahtumailmot

$qoi = "SELECT * FROM ".$table['tapahtumailmot']." WHERE tekija='".$tekija['id']."'";
$r = mysqli_query($l, $qoi) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  if ($data['tyyppi'] == 'enpaase' ) {
    $_SESSION['tapahtumat'][$data['tapahtuma']]['enpaase'] = $data['id'];
  } else {
    $_SESSION['tapahtumat'][$data['tapahtuma']]['oma'] = $data['id'];
  }
}

// tekijän kyydit

$qok = "SELECT * FROM ".$table['kyydit']." WHERE tekija='".$tekija['id']."'";
$r = mysqli_query($l, $qok) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tapahtumat'][$data['tapahtuma']][$data['mp']]['omakyyti'] = $data['id'];
}

// tekijä kyydissä

$qok = "SELECT * FROM ".$table['kyytiin']." WHERE tekija='".$tekija['id']."'";
$r = mysqli_query($l, $qok) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  if ($data['kyyti'] == 0) {
    $_SESSION['tapahtumat'][$data['tapahtuma']][$data['mp']]['omalla'] = $data['id'];
  } else {
    $_SESSION['tapahtumat'][$data['tapahtuma']][$data['mp']]['oma'] = $data['id'];
  }
}

// allergiat

$qa = "SELECT TAP.id, allergiat, etunimi, sukunimi, tapahtuma FROM ".$table['tapahtumailmot']." TAP INNER JOIN ".$table['tekijat']." TEK ON TAP.tekija = TEK.id WHERE allergiat != '' AND TAP.tyyppi != 'enpaase'";
$r = mysqli_query($l, $qa) or die('Köyrintä epäonnistui');
while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
  $_SESSION['tapahtumat'][$data['tapahtuma']]['allergiat'][$data['id']] = $data;
}

mysqli_close($l);

?>
