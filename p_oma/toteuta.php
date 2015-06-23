<div class=centered>

<?php 
$id = $_POST['id'];
$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$nick = $_POST['nick'];
$email = $_POST['email'];
$puhelin = $_POST['puhelin'];
$allergiat = $_POST['allergiat'];
$facebook = $_POST['facebook'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (PaivitaTekija($l, $table['tekijat'], $id, $etunimi, $sukunimi, $nick, $email, $puhelin, $allergiat, $facebook)) {
  print("<p>Tiedot päivitetty!</p>");
} else {
  print("<p>Muokkaus onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a href='".$paasivu."' class=inverse>Takaisin</a></p>");

?>

</div>
