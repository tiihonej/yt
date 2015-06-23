<div class=centered>

<?php
$id = $tekija['id'];
$kyyti = $_POST['kyyti'];
$tilaa = $_POST['tilaa'];
$paiva = $_POST['paiva'];
$aika = $_POST['aika'];
$paikka = $_POST['paikka'];
$lisatiedot = $_POST['lisatiedot'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

if (PaivitaKyyti($l, $table['kyydit'], $kyyti, $tilaa, $aika, $paikka, $lisatiedot)) {
  print("<p>Kyydin muokkaaminen onnistui!</p>");
} else {
  print("<p>Kyydin muokkaaminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;
print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
