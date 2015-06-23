<div class=centered>

<?php
$tapahtuma = $_SESSION['tapahtumat'][$_POST['id']];
$id = $tekija['id'];
$mp = $_POST['mp'];
$tyyppi = $_POST['tyyppi'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

if ( $tyyppi == 'oma' ) {
  $kyyti = 0;  
} else {
  $kyyti = $_POST['kyyti'];
}

if (LisaaKyytiin($l, $table['kyytiin'], $mp, $id, $kyyti, $tapahtuma['id'])) {
  print("<p>Kyyti-ilmoittautuminen onnistui!</p>");
} else {
  print("<p>Kyyti-ilmoittautuminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}

mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
