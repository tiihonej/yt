<?php

unset($_SESSION['omstart']);

print("<table width='100%'>\n");
print("<tr><th class=otsikko>");
print("<form action='".$paasivu."&amp;a=muokkaa' method=post>");
print("<input type=submit class=taulunappi value='Muokkaa/Poista'>");
print("</form>");
print("</th></tr>");
print("</table>\n");

print("<h3>Omat tiedot</h3>\n");
print("<table id=yhteenveto>\n");
print("<tr><th>Etunimi</th><td>".$tekija['etunimi']."</td></tr>\n");
print("<tr><th>Sukunimi</th><td>".$tekija['sukunimi']."</td></tr>\n");
print("<tr><th>Lempinimi</th><td>".$tekija['nick']."</td></tr>\n");
print("<tr><th>Email</th><td>".$tekija['email']."</td></tr>\n");
print("<tr><th>Puhelin</th><td>".$tekija['puhelin']."</td></tr>\n");
print("<tr><th>Facebook</th><td>".$tekija['facebook']."</td></tr>\n");
print("<tr><th>Allergiat</th><td>".$tekija['allergiat']."</td></tr>\n");
print("</table>\n");

print("<h3>Osa-alueet</h3>\n");

if (empty($_SESSION['alueilmot'])) {
  print("<p>Et ole ilmoittautunut yhteenkään osa-alueeseen.</p>\n");
} else {
  print("<ul>");
  foreach($_SESSION['alueilmot'] as $alueilmo) {
    $alue = $_SESSION['alueet'][$alueilmo['alue']];
    print("<li>".$alue['nimi']."</li>");
  }
  print("</ul>");
}

print("<h3>Tapahtumat</h3>\n");

if (empty($_SESSION['tapahtumailmot'])) {
  print("<p>Et ole ilmoittautunut yhteenkään tapahtumaan.</p>");
} else {
  print("<ul>");
  foreach($_SESSION['tapahtumailmot'] as $tapahtumailmo) {
    $tapahtuma = $_SESSION['tapahtumat'][$tapahtumailmo['tapahtuma']];
    print("<li>".$tapahtuma['nimi']."</li>");
  }
  print("</ul>");
}

print("<h3>Tilaukset</h3>");

if (empty($_SESSION['tilaukset'])) {
  print("<p>Sinulla ei ole voimassaolevia tilauksia.</p>");
} else {
  print("<ul>");
  foreach($_SESSION['tilaukset'] as $tilaus) {
    $tuote = $_SESSION['tuotteet'][$tilaus['tuote']];
    print("<li>".$tuote['nimi']."");
    if ($tilaus['maksettu']) {
      print(" - <b>maksettu</b>");
    } else {
      print(" - <b>maksamatta</b>");
    }
    print("</li>");
  }
  print("</ul>");
}

?>
