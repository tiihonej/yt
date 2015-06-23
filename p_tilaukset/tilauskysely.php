<?php

$tuoteid = $_POST['id'];
$tuote = $_SESSION['tuotteet'][$tuoteid];

print("<h3>Tilaa tuote ".$tuote['nimi']."</h3>");

print("<p>".$tuote['kuvaus']."</p>");

print("<form action='".$paasivu."&amp;a=vahvista_tilaus' method=post>");

// määrä
print("<h5>Määrä</h5>");
print("<select name=maara>");
for($i = 1; $i <= $tuote['maksimitilaus']; $i++) {
  print("<option value=".$i.">".$i."</option>");
}
print("</select>");


// koko
if ($tuote['tyyppi']=='paita') {
  print("<h5>Valitse koko</h5>");
  print("<select name=koko>");
  foreach(explode(',',$tuote['koko']) as $koko) {
    print("<option value='".$koko."'>".$koko."</option>");
  }
  print("</select>");
}

// vahvista
print("<h5>Vahvista</h5>\n");
print("<input type=hidden name=id value=".$tuoteid.">");
print("<input type=submit value='Vahvista tilaus'>");
print("</form>");

?>
