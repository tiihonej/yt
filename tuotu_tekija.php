<div class=kokosivu>
<div class=centered>

<?php
unset($_SESSION[$prefix.'_tekija']);

$salasana = crypt($_POST['salasana1'], $salt);
if ( $salasana != $oldies[$_POST['kantavalinta']] ) {
  print("Virheellinen vanhan tietokannan salasana");
  include "tunnistaudu.php";
  die;
}
$salasana = crypt($_POST['salasana2'], $salt);
if ( $salasana != $pass_yleis ) {
  print("Virheellinen uuden tietokannan salasana");
  include "tunnistaudu.php";
  die;
}

$id = $_POST['id'.$_POST['kantavalinta']];
if (isset($_SESSION['tuonti'][$_POST['kantavalinta']][$id])) {
  $tekija = $_SESSION['tuonti'][$_POST['kantavalinta']][$id];
} else {
  print("Tapahtui virhe :(");
  include "tunnistaudu.php";
  die;
}
$etunimi = $tekija['etunimi'];
$sukunimi = $tekija['sukunimi'];
$lempinimi = $tekija['nick'];
$email = $tekija['email'];
$puhelin = $tekija['puhelin'];
$allergiat = $tekija['allergiat'];
$facebook = $tekija['facebook'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (TuoTekija($l, $table['tekijat'],$etunimi, $sukunimi, $lempinimi, $email, $puhelin, $allergiat,$facebook)) {
  print("<p>Tuotiin käyttäjä ".$tekija['etunimi']." ".$tekija['sukunimi']."!</p> <a href=./ class=inverse>Kirjaudu sisään</a>");
} else {
  print("<p>Lisäys epäonnistui!</p>");
}
mysqli_close($l);
?>

</div>
</div>
