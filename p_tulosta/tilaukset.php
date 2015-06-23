<?php
session_start();

$tuote = $_SESSION['tuotteet'][$_POST['id']];

print("<h2>Tuotteen ".$tuote['nimi']." tilaajat</h2>\n");

print("<table class=eireunoja>");
print("<tr><th>Nimi</th>");
if ($tuote['tyyppi']=='paita') {
  print("<th>Koko</th>");
}

print("<th>Määrä</th><th class=allekirjoitus>Maksettu</th><th class=allekirjoitus>Lunastettu</th></tr>\n\n");
foreach($tuote['tilaukset'] as $tilaus) {
  print("<tr><td>".$tilaus['sukunimi']." ".$tilaus['etunimi']."</td>");
  if ($tuote['tyyppi']=='paita') {
    print("<td>".$tilaus['koko']."</td>");
  }
  print("<td>".$tilaus['maara']."</td>");
  print("<td>");
  if ($tilaus['maksettu']) { print("kyllä"); }
  print("</td><td>");
  if ($tilaus['lunastettu']) { print("kyllä"); }
  print("</td></tr>\n");
}
print("</table>");

?>


