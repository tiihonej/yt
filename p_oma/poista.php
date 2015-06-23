<?php 

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

// alueilmot
if (PoistaEhdolla($l, $table['alueilmot'], $prefix.'_tekija', $tekija['id'])) {
  print("<p>Tekijän ".$tekija['etunimi']." ".$tekija['sukunimi']." osa-alueilmoittautumiset poistettu!</p>");
} else {
  print("<p>Poistaminen ei onnistunut</p>");
}

// tapahtumailmot
if (PoistaEhdolla($l, $table['tapahtumailmot'], $prefix.'_tekija', $tekija['id'])) {
  print("<p>Tekijän ".$tekija['etunimi']." ".$tekija['sukunimi']." tapahtumailmoittautumiset poistettu!</p>");
} else {
  print("<p>Poistaminen ei onnistunut</p>");
}

// kyydit
if (PoistaEhdolla($l, $table['kyydit'], $prefix.'_tekija', $tekija['id'])) {
  print("<p>Tekijän ".$tekija['etunimi']." ".$tekija['sukunimi']." tarjoamat kyydit poistettu!</p>");
} else {
  print("<p>Poistaminen ei onnistunut</p>");
}

// kyyti-ilmot
if (PoistaEhdolla($l, $table['kyytiin'], $prefix.'_tekija', $tekija['id'])) {
  print("<p>Tekijän ".$tekija['etunimi']." ".$tekija['sukunimi']." kyyti-ilmoittatumiset poistettu!</p>");
} else {
  print("<p>Poistaminen ei onnistunut</p>");
}

// tekijä itse
if (PoistaAlkio($l, $table['tekijat'], $tekija['id'])) {
  print("<p>Profiili nimellä ".$tekija['etunimi']." ".$tekija['sukunimi']." poistettu!</p>");
} else {
  print("<p>Poistaminen ei onnistunut</p>");
}

mysqli_close($l);
session_unset();

$_SESSION['omstart'] = true;

print("<p class=inverse><a href='".$paasivu."'>Takaisin</a></p>");

?>
