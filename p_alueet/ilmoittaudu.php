<div class=centered>

<?php 
$alueid = $_POST['id'];
$id = $tekija['id'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (LisaaAlueilmo($l, $table['alueilmot'], $id, $alueid)) {
  print("<p>Ilmoittautuminen onnistui!</p>");
} else {
  print("<p>Olet jo ilmoittautunut: lakkaa päivittämästä sivua!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
