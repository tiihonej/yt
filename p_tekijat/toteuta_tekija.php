<?php 

$id = $_POST['id'];
$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$email = $_POST['email'];
$sukupuoli = $_POST['sukupuoli'];
$fuksi = $_POST['fuksi'];
$tyyppi = $_POST['tyyppi'];

if (!isset($fuksi)) { $fuksi = 0; }

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if ($id == 0) {
  if (LisaaJasen($l, $table['jasenlista'], $etunimi, $sukunimi, $email, $sukupuoli, $fuksi, $tyyppi)) {
    print("<p>Jäsen ".$etunimi." ".$sukunimi." lisätty!</p>");
  } else {
    print("<p>Lisäys epäonnistui!</p>");
  }
} else {
  if (PaivitaJasen($l, $table['jasenlista'], $id, $etunimi, $sukunimi, $email, $sukupuoli, $fuksi, $tyyppi)) {
    print("<p>Jäsen ".$etunimi." ".$sukunimi." päivitetty!</p>");
  } else {
    print("<p>Päivitys epäonnistui!</p>");
  }
}
mysqli_close($l);
print("<p><a href=".$paasivu.">Takaisin</a></p>");

?>
