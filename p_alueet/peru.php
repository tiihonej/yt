<div class=centered>

<?php 
$ilmoid = $_POST['id'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (PoistaAlkio($l, $table['alueilmot'], $ilmoid)) {
  print("<p>Peruminen onnistui!</p>");
} else {
  print("<p>Olet jo perunut: lakkaa päivittämästä sivua!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
