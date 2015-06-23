<div class=centered>

<?php 
$tapahtumaid = $_POST['id'];
$id = $tekija['id'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (LisaaTapahtumailmo($l, $table['tapahtumailmot'], 'enpaase', $id, $tapahtumaid, array(), "")) {
  print("<p>Ilmoittautuminen poissaolevaksi onnistui!</p>");
} else {
  print("<p>Ilmoittautuminen poissaolevaksi onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
