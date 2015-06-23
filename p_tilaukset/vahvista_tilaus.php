<div class=centered>

<?php 
$tuoteid = $_POST['id'];
$koko = $_POST['koko'];
$maara = $_POST['maara'];
$id = $tekija['id'];
$tuote = $_SESSION['tuotteet'][$tuoteid];
$selite = $maara."x ".$tuote['nimi'].", (".$tuote['hinta'].") ".$tekija['etunimi']." ".$tekija['sukunimi'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (LisaaTilaus($l, $table['tilaukset'], $id, $tuoteid, $koko, $maara, $selite)) {
  print("<p>Tilauksen lisääminen onnistui!</p>");
} else {
  print("<p>Tilauksen lisääminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
