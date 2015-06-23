<div class=centered>

<?php

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if ( in_array($tapahtuma['id'], $_SESSION['enpaase']) ) {
  PoistaAlkio($l, $table['tapahtumailmot'], array_search($tapahtuma['id'],$_SESSION['enpaase']));
}

if (LisaaTapahtumailmo($l, $table['tapahtumailmot'], 'simple', $id, $tapahtumaid, array(), "")) {
  print("<p>Ilmoittautuminen onnistui!</p>");
} else {
  print("<p>Ilmoittautuminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
