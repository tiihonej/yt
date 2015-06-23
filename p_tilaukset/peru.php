<div class=centered>

<?php 

$tilausid = $_POST['id'];
$tilaus = $_SESSION['tuotteet'][$tilausid];
$deadline = $_SESSION['tuotteet'][$tilaus['tuote']]['deadline'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (PoistaAlkio($l, $table['tilaukset'], $tilausid) && strtotime($deadline) < strtotime(date('Y-m-d'))) {
  print("<p>Peruminen onnistui!</p>");
} else {
  print("<p>Peruminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
