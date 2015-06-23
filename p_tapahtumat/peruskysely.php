<?php

print("<h3>Ilmoittaudu tapahtumaan ".$tapahtuma['nimi']."</h3>");

print("<p>".$tapahtuma['kuvaus']."</p>");

print("<h5>Paikka & aika</h5>");
print("<p>".$tapahtuma['paikka'].", ".Aika($tapahtuma['alku'])." - ".Aika($tapahtuma['loppu'])."</p>");

$paivat = NoudaPaivat($tapahtuma['alku'], $tapahtuma['loppu']);

print("<form action='".$paasivu."&amp;a=perusilmo' id=tapahtumailmo method=post>");

print("<h5>Päivät, jolloin osallistun</h5>");
print("<table class=eireunoja>");
foreach($paivat as $paiva) {
  $boksit = $boksit."<input type=checkbox name='paiva[]' value=".key($paiva)." checked=checked><br>";
  $pvtekstit = $pvtekstit .current($paiva)."<br>";
}
print("<tr><td>".$boksit."</td><td>".$pvtekstit."</td><td></td></tr>");
print("</table>");


print("<h5>Lisätietoja</h5><textarea name=lisatiedot></textarea><br>");
print("<input type=hidden name=id value=".$tapahtumaid.">");
print("<input type=submit value=Ilmoittaudu>");
print("</form>");

?>
