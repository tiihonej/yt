<?php 

print("<h2>Muokkaa tietojasi</h2>");

print("<form id='tekijatiedot' action='".$paasivu."&amp;a=toteuta' method=post>");
print("<table class=eireunoja>");
print("<tr><td>Etunimi</td><td><input type=text name=etunimi value='".$tekija['etunimi']."'></td><td></td></tr>");
print("<tr><td>Sukunimi</td><td><input type=text name=sukunimi value='".$tekija['sukunimi']."'></td><td></td></tr>");
print("<tr><td>Lempinimi</td><td><input type=text name=nick value='".$tekija['nick']."'></td><td></td></tr>");
print("<tr><td>Sähköposti</td><td><input type=text name=email value='".$tekija['email']."'></td><td></td></tr>");
print("<tr><td>Puhelin</td><td><input type=text name=puhelin value='".$tekija['puhelin']."'></td><td></td></tr>");
print("<tr><td>http://www.facebook.com/</td><td><input type=text name=facebook value='".$tekija['facebook']."'></td><td></td></tr>");
print("<tr><td>Allergiat</td><td><textarea name=allergiat size=75>".$tekija['allergiat']."</textarea></td><td></td></tr>");
print("</table>");
print("<input type=hidden name=id value=".$tekija['id'].">");
print("<input type=reset value=Palauta>");
print("<input type=submit value=Toteuta>");
print("</form>\n\n");

// poistonamiska, jos muokataan
print("<h3>Poista profiili</h3>");
print("<form action='".$paasivu."&amp;a=poista' method=post "
     ."onsubmit=\"return confirm('Poistamista ei voi peruuttaa. Kaikki ennen määräaikaa tekemäsi varaukset ja ilmoittautumiset purkautuvat. Harkitse poistoa vain, jos olet tehnyt tuplaprofiilin ja aiot poistaa ylimääräisen tarpeettomana. Oletko nyt aivan varma?')\">");
print("<input type=submit value='Poista tietokannasta'>");
print("</form>");

?>
