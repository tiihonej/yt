<div class=centered>

<?php
$tapahtumaid = $_POST['id'];
$id = $tekija['id'];
$tapahtuma = $_SESSION['tapahtumat'][$tapahtumaid];
$lisatiedot = $_POST['lisatiedot'];
$paivat = $_POST['paiva'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (isset($_SESSION['tapahtumat'][$tapahtuma['id']]['enpaase'])) {
  PoistaAlkio($l, $table['tapahtumailmot'], $_SESSION['tapahtumat'][$tapahtuma['id']]['enpaase']);
}

if (LisaaTapahtumailmo($l, $table['tapahtumailmot'], 'perus', $id, $tapahtumaid, $paivat, $lisatiedot)) {
  print("<p>Ilmoittautuminen onnistui!</p>");
  if ($tapahtuma['tyyppi'] == 'kyyti') {
    print("<form action='".$paasivu."&amp;a=kyytikysely' method=post>");
    print("<input type=hidden name=id value=".$tapahtumaid.">");
    print("<p>Tapahtumaan mennään omalla kyydillä. "
         ."<input type=submit value='Täytä kyytisäätö'>");
    print("</form>");
  }
} else {
  print("<p>Ilmoittautuminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
