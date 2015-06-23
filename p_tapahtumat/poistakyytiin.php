<div class=centered>

<?php 
$ilmoid = $_POST['id'];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);
if (PoistaAlkio($l, $table['kyytiin'], $ilmoid)) {
  print("<p>Kyydin peruminen onnistui!</p>");
} else {
  print("<p>Kyydin peruminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}
mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
