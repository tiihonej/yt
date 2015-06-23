<?php 
$tapahtumaid = $_POST['id'];
$tapahtuma = $_SESSION['tapahtumat'][$tapahtumaid];

print("<h2>Tapahtumaan ".$tapahtuma['nimi']." ilmoittautuneiden allergiat</h2>");

print("<ul>");
foreach($_SESSION['tapahtumat'][$tapahtumaid]['allergiat'] as $allergia) {
  print("<li>".$allergia['allergiat']."</li>");
}
print("</ul>");

?>
