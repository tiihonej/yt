<div class=centered>

<?php 
$id = $_POST['id'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

if (PoistaEhdolla($l, $table['kyytiin'], 'kyyti', $id)) {
  print("<p>Kyytiläisten poistaminen onnistui!</p>");
} else {
  print("<p>Kyytiläisten poistaminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}

if (PoistaAlkio($l, $table['kyydit'], $id)) {
  print("<p>Kyydin poistaminen onnistui!</p>");
} else {
  print("<p>Kyydin poistaminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
