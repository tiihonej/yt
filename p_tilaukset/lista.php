<?php 
$tuoteid = $_POST['id'];
$tuote = $_SESSION['tuotteet'][$tuoteid];

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

if ($tuote['tyyppi']=='paita') {

  print("<h3>Määrät</h3>");
  print("<ul>");
  foreach($_SESSION['tuotteet'][$tuoteid]['koot'] as $koko => $maara) {
    $kpl = 0;
    foreach($maara as $yks) {
      $kpl = $kpl + $yks;
    }
    print("<li>".$koko.": ".$kpl."</li>");
  }
  print("</ul>");
}

print("<form action=tulosta&a=tilaukset method=post>");
print("<input type=hidden name=id value=".$tuote['id'].">");
print("<input type=submit value='Tulosta'>");
print("</form>");

?>
