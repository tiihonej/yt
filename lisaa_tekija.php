<div class=kokosivu>
<div class=centered>

<?php 
unset($_SESSION[$prefix.'_tekija']);

$salasana = crypt($_POST['salasana'], $salt);
if ( $salasana != $pass_yleis ) {
  print("Virheellinen salasana");
  include "tunnistaudu.php";
  die;
}

session_unset();
$id = $_POST['id'];
$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$lempinimi = $_POST['lempinimi'];
$email = $_POST['email'];
$puhelin = $_POST['puhelin'];
$allergiat = $_POST['allergiat'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (LisaaTekija($l, $table['tekijat'], $etunimi, $sukunimi, $lempinimi, $email, $puhelin, $allergiat)) {
  print("<p>Lisätty profiili ".$etunimi." ".$sukunimi."!</p> <a href=./ class=inverse>Kirjaudu sisään</a>");
} else {
  print("<p>Lisäys epäonnistui!</p>");
}
mysqli_close($l);
?>

</div>
</div>
