<div class=centered>

<?php
$id = $tekija['id'];
$tapahtuma = $_SESSION['tapahtumat'][$_POST['id']];
$tilaa = $_POST['tilaa'];
$paiva = $_POST['paiva'];
$aika = $_POST['aika'];
$paikka = $_POST['paikka'];
$mp = $_POST['mp'];
$lisatiedot = $_POST['lisatiedot'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

if (LisaaKyyti($l, $table['kyydit'], $id, $tapahtuma['id'], $mp, $tilaa, $paiva, $aika, $paikka, $lisatiedot)) {
  print("<p>Kyydin lisäys onnistui!</p>");
} else {
  print("<p>Kyydin lisäys onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;
print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
