<?php

// omat tilaukset

unset($_SESSION['omstart']);

if (!empty($_SESSION['tilaukset'])) {
  print("<h2>Omat tilaukset</h2>");
}

foreach($_SESSION['tilaukset'] as $tilaus) {
  $tuote = $_SESSION['tuotteet'][$tilaus['tuote']];
  print("<div id=tilaus".$tilaus['id']." class=tilaus>\n");
  print("<table>\n");
  print("<tr><th class=otsikko>".$tilaus['maara']."x ".$tuote['nimi']
       ." (".$tuote['hinta']*$tilaus['maara']."e)");
  if ($tuote['tyyppi'] == 'paita') {
    print(", ".$tilaus['koko']);
  }
  print("</th>");

  if (strtotime($tuote['deadline']) < strtotime(date('Y-m-d')) ) {
    print("<td class=peru>Peruminen myöhäistä.</td>");
  } else {
    print("<td class=peru><form action='".$paasivu."&amp;a=peru' method=post "
         ."onsubmit=\"return confirm('Haluatko varmasti perua tilauksen?')\">");
    print("<input type=hidden name=id value=".$tilaus['id'].">");
    print("<input type=submit class=taulunappi value='Peru tilaus'>");
    print("</form></td>\n");
  }

  print("</tr></table>");
  print("</div>");
}

// tilattavat tuotteet

print("<h2>Tilattavat tuotteet</h2>");

if (empty($_SESSION['tuotteet'])) {
  print("<p>Ei tilattavia tuotteita.</p></div>");
  return;
}

foreach($_SESSION['tuotteet'] as $tuote) {
  if (strtotime($tuote['deadline']) < strtotime(date('Y-m-d')) ) {
    $vanhoja = true;
    continue;
  }

  print("<div id=tuote".$tuote['id']." class=tuote>\n");
  print("<table>\n");
  print("<tr><th class=otsikko>".$tuote['nimi']." (".$tuote['hinta']."e)");
  $paivia = floor( (strtotime($tuote['deadline']) - strtotime(date('Y-m-d')))/(60*60*24) );
  if ( $paivia < 5 ) {
    print(" - ".$paivia." PV AIKAA!");
  }
  print("<span>".$tuote['id']."</span></th>");

  print("<td class=kyytikysely><form action='".$paasivu."&amp;a=lista' method=post>");
  print("<input type=hidden name=id value=".$tuote['id'].">");
  print("<input type=submit class=taulunappi value=Tilauslista>");
  print("</form></td>\n");

  print("<td class=ilmoittaudu><form action='".$paasivu."&amp;a=tilaa' method=post>");
  print("<input type=hidden name=id value=".$tuote['id'].">");
  print("<input type=submit class=taulunappi value=Tilaa>");
  print("</form></td>\n");
  print("</tr>\n</table>\n");
  print("<div>");

  // Deadline
  print("<p>Tilattava ".$tuote['deadline']." mennessä.</p>");

  // Kuvaus
  print("<p>".$tuote['kuvaus']."</p>");

  // Linkki
  if (!empty($tuote['linkki'])) {
    print("<a href='".$tuote['linkki']."' target=_blank>Linkki</a>");
  }

  print("</div>");
  print("</div>");
}

if ($vanhoja) {
  print("<h2>Menneet tuotetilaukset</h2>");
}

foreach($_SESSION['tuotteet'] as $tuote) {
  if (strtotime($tuote['deadline']) >= strtotime(date('Y-m-d')) ) {
    continue;
  }

  print("<div id=tuote".$tuote['id']." class=tuote>\n");
  print("<table>\n");
  print("<tr><th class=otsikko>".$tuote['nimi']." (".$tuote['hinta']."e)");
  $paivia = floor( (strtotime($tuote['deadline']) - strtotime(date('Y-m-d')))/(60*60*24) );
  if ( $paivia < 5 ) {
    print(" - ".-$paivia." PV SITTEN!");
  }
  print("<span>".$tuote['id']."</span></th>");

  print("<td class=kyytikysely><form action='".$paasivu."&amp;a=lista' method=post>");
  print("<input type=hidden name=id value=".$tuote['id'].">");
  print("<input type=submit class=taulunappi value=Tilauslista>");
  print("</form></td>\n");
  print("</tr>\n</table>\n");
  print("<div>");

  // Kuvaus
  print("<p>".$tuote['kuvaus']."</p>");

  // Linkki
  if (!empty($tuote['linkki'])) {
    print("<a href='".$tuote['linkki']."' target=_blank>Linkki</a>");
  }

  print("</div>");
  print("</div>");
}



?>
