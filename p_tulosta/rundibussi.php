<?php
session_start();

$kyyti = $_SESSION['tapahtumat'][$_POST['tapahtuma']][$_POST['mp']][$_POST['id']];
$tapahtuma = $_SESSION['tapahtumat'][$_POST['tapahtuma']];

print("<h2>Rundibussi tapahtumaan ".$tapahtuma['nimi']."</h2>\n");

print("<ul>");

foreach($kyyti['ilmot'] as $ilmo) {
  $tekija = $_SESSION['tekijat'][$ilmo[$prefix.'_tekija']];
  print("<li>".$tekija['sukunimi']." ".$tekija['etunimi']."</li>");
}
print("</ul>");

?>


