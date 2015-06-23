<?php 

$id = $_POST['id'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

foreach($_SESSION['tapahtumailmot'] as $ilmo) {
  if ($ilmo['dedis']) {
    print("<p>Ei poistettu</p>");
  } else {
    PoistaAlkio($l, $table['tapahtumailmot'], $ilmo['id']);
  }
}

if (PoistaAlkio($l, $table['jasenlista'], $id)) {
  print("<p>Jäsen ".$_SESSION['jasenet'][$id]['etunimi']." ".$_SESSION['jasenet'][$id]['sukunimi']." poistettu!</p>");
} else {
  print("<p>Poistaminen ei onnistunut</p>");
}
mysqli_close($l);

print("<p><a href=".$paasivu.">Takaisin</a></p>");

?>
