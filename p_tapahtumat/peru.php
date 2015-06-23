<div class=centered>

<?php 
$ilmoid = $_POST['id'];
$tapahtuma = $_SESSION['tapahtumat'][$_POST['tapahtuma']];

$l = mysqli_connect($mysql_host, $mysql_user, $mysql_passwd, $db);

if (PoistaAlkio($l, $table['tapahtumailmot'], $ilmoid)) {
  print("<p>Peruminen onnistui!</p>");
} else {
  print("<p>Peruminen onnistui jo: lakkaa päivittämästä selainta!</p>");
}

if ($tapahtuma['tyyppi'] == 'kyyti' && !$_SESSION['omstart']) {
  if ( isset($tapahtuma['m']['omakyyti']) ) {
    PoistaAlkio($l, $table['kyydit'], $tapahtuma['m']['omakyyti']);
    PoistaEhdolla($l, $table['kyytiin'], 'kyyti', $tapahtuma['m']['omakyyti']);
    print("<p>Menokyyti poistettu</p>");
  }
  if ( isset($tapahtuma['p']['omakyyti']) ) {
    PoistaAlkio($l, $table['kyydit'], $tapahtuma['p']['omakyyti']);
    PoistaEhdolla($l, $table['kyytiin'], 'kyyti', $tapahtuma['p']['omakyyti']);
    print("<p>Paluukyyti poistettu</p>");
  }
  if ( isset($tapahtuma['m']['oma']) ) {
    PoistaAlkio($l, $table['kyytiin'], $tapahtuma['m']['oma']);
    print("<p>Menokyyti poistettu</p>");
  }
  if ( isset($tapahtuma['p']['oma']) ) {
    PoistaAlkio($l, $table['kyytiin'], $tapahtuma['p']['oma']);
    print("<p>Paluukyyti poistettu</p>");
  }
}

mysqli_close($l);

$_SESSION['omstart'] = true;

print("<p><a class=inverse href='".$paasivu."'>Takaisin</a></p>");

?>

</div>
