<div class=centered>

<?php
$muokkaa = $_POST['muokkaa'];
$mp = $_POST['mp'];
$tapahtuma = $_SESSION['tapahtumat'][$_POST['id']];
if ($muokkaa) {
  $kyyti = $_SESSION['tapahtumat'][$tapahtuma['id']][$mp][$_POST['kyyti']];
  $ilmoja = sizeof($kyyti['ilmot']);
}

if ($mp == 'm') {
  print("<h2>Menokyyti tapahtumaan ".$tapahtuma['nimi']."</h2>");
} else {
  print("<h2>Paluukyyti tapahtumaan ".$tapahtuma['nimi']."</h2>");
}

if ($muokkaa) {
  print("<form action='".$paasivu."&amp;a=muokkaakyyti' id=luokyyti method=post>");
} else {
  print("<form action='".$paasivu."&amp;a=lisaakyyti' id=luokyyti method=post>");
}
print("<table class=eireunoja>");

// paikkoja
print("<tr><td>Vapaita paikkoja</td><td><select name=tilaa>");
for($i = $ilmoja; $i < 10; $i++) {
  if ($i == $kyyti['tilaa']) {
    print("<option value=".$i." selected>".$i."</option>"); 
  } else {
    print("<option value=".$i.">".$i."</option>");
  }
}
print("</select>");
if ($muokkaa && $ilmoja > 0) { print("paikkoja on vähintään kyytiisi ilmoittautuneiden määrä"); }
print("</td></tr>");

// päivät
if ($muokkaa) {
  print("<tr><td>Lähtöpäivä</td><td>".$kyyti['paiva']." (muuttaaksesi poista kyyti ja luo uusi)</td></tr>");
} else {
  $paivat = NoudaPaivat($tapahtuma['alku'], $tapahtuma['loppu']);
  print("<tr><td>Lähtöpäivä</td><td><select name=paiva>");
  foreach($paivat as $paiva) {
    print("<option value=".key($paiva).">".current($paiva)."</option>");
  }
  print("</select></td></tr>");
}

print("<tr><td>Lähtöaika (HH:MM)</td><td>"
      ."<input type=text name=aika value=".substr($kyyti['aika'],0,-3)."></td><td></td></tr>");
if ($mp == 'm') { 
  print("<tr><td>Lähtöpaikka</td><td><input type=text name=paikka value=".$kyyti['paikka']."></td><td></td></tr>");
} else {
  print("<tr><td>Määränpää</td><td><input type=text name=paikka value=".$kyyti['paikka']."></td><td></td></tr>");
}
print("<tr><td>Lisätietoja</td><td><textarea name=lisatiedot size=75>".$kyyti['lisatiedot']."</textarea></td><td></td></tr>");
print("</table>");

print("<input type=hidden name=mp value=".$mp.">");
print("<input type=hidden name=id value=".$tapahtuma['id'].">");
if ($muokkaa) {
  print("<input type=hidden name=kyyti value=".$kyyti['id'].">");
  print("<input type=reset value='Palauta'>");
  print("<input type=submit value='Päivitä'>");
} else {
  print("<input type=submit value='Luo uusi kyyti'>");
}

print("</form>");

?>
</div>
