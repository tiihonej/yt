<div class=centered>

<?php 
unset($_SESSION['omstart']);
$tapahtuma = $_SESSION['tapahtumat'][$_POST['id']];
$omakyytim = isset($_SESSION['tapahtumat'][$tapahtuma['id']]['m']['omakyyti']);
$omakyytip = isset($_SESSION['tapahtumat'][$tapahtuma['id']]['p']['omakyyti']);
$omakyytiinm = isset($_SESSION['tapahtumat'][$tapahtuma['id']]['m']['oma']);
$omakyytiinp = isset($_SESSION['tapahtumat'][$tapahtuma['id']]['p']['oma']);
$omallam = isset($_SESSION['tapahtumat'][$tapahtuma['id']]['m']['omalla']);
$omallap = isset($_SESSION['tapahtumat'][$tapahtuma['id']]['p']['omalla']);

if ( !isset($_SESSION['tapahtumat'][$tapahtuma['id']]['oma'])) {
  print("<p>Ilmoittaudu ensin tapahtumaan, homo!</p></div>");
  return;
}

print("<h1>Kyytisäätö tapahtumaan ".$tapahtuma['nimi']."</h1>");

print("<table id=kyytitable><tr>");
// MENOMATKA
print("<td>");
include "p_tapahtumat/menomatka.php";
print("</td>");
// PALUUMATKA
print("<td>");
include "p_tapahtumat/paluumatka.php";
print("</td>");
print("</tr></table>");

?>

</div>
