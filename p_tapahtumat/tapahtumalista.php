<h2>Aktiiviset tapahtumat</h2>

<?php

unset($_SESSION['omstart']);

if (empty($_SESSION['tapahtumat'])) {
  print("<p>Ei tapahtumia.</p></div>");
  return;
}

foreach($_SESSION['tapahtumat'] as $tapahtuma) {
  if (strtotime($tapahtuma['loppu']) < strtotime(date('Y-m-d')) ) {
    $menneita = true;
    continue;
  }

  $maara = sizeof($tapahtuma['ilmot']);
  $paivat = noudaPaivat($tapahtuma['alku'],$tapahtuma['loppu']);
  print("<div id=tapahtuma".$tapahtuma['id']." class=tapahtuma>\n");
  print("<table>\n");
  print("<tr><th class=otsikko>".$tapahtuma['nimi']." (".$maara.")<span>".$tapahtuma['id']."</span></th>");

  // ilmoittaudu / peru / enpaase
  if ( $_SESSION['tapahtumat'][$tapahtuma['id']]['enpaase'] ) {
    print("<td class=enpaase><form action='".$paasivu."&amp;a=ilmoittaudu' method=post>");
    print("<input type=hidden name=id value=".$tapahtuma['id'].">");
    print("<input type=submit class=taulunappi value='Poissa - ilmoittaudu sittenkin'>");
    print("</form></td>\n");
  } elseif ( isset( $_SESSION['tapahtumat'][$tapahtuma['id']]['oma'] )) {
    if ($tapahtuma['tyyppi'] == 'kyyti') {
      print("<td class=kyytikysely><form action='".$paasivu."&amp;a=kyytikysely' method=post>");
      print("<input type=hidden name=id value=".$tapahtuma['id'].">");
      print("<input type=submit class=taulunappi value=Kyytisäätö>");
      print("</form></td>\n");
    }
    print("<td class=peru><form action='".$paasivu."&amp;a=peru' method=post "
         ."onsubmit=\"return confirm('Haluatko varmasti perua ilmoittautumisen?')\">");
    print("<input type=hidden name=id value=".$_SESSION['tapahtumat'][$tapahtuma['id']]['oma'].">");
    print("<input type=hidden name=tapahtuma value=".$tapahtuma['id'].">");
    print("<input type=submit class=taulunappi value='Ilmoittautunut - peru'>");
    print("</form></td>\n");
  } else {
    print("<td class=ilmoittaudu><form action='".$paasivu."&amp;a=ilmoittaudu' method=post>");
    print("<input type=hidden name=id value=".$tapahtuma['id'].">");
    print("<input type=submit class=taulunappi value=Ilmoittaudu>");
    print("</form></td>\n");
    print("<td class=enpaase><form action='".$paasivu."&amp;a=enpaase' method=post>");
    print("<input type=hidden name=id value=".$tapahtuma['id'].">");
    print("<input type=submit class=taulunappi value='En pääse'>");
    print("</form></td>\n");
  }

  print("</tr>\n</table>\n");
  print("<div>");

  // Kuvaus
  print("<p>".$tapahtuma['kuvaus']."</p>");

  // Allergiat
  if ($tapahtuma['ruoka']) {
    print("<form action='".$paasivu."&amp;a=allergiat' method=post>");
    print("<input type=hidden name=id value=".$tapahtuma['id'].">");
    print("<input type=submit value=Allergiat>");
    print("</form>\n<br>");
  }

  // Aika & Paikka
  print("<h5>Paikka & aika</h5>");
  print("<p>".$tapahtuma['paikka'].", ".Aika($tapahtuma['alku'])." - ".Aika($tapahtuma['loppu'])."</p>");

  // Linkki
  if (!empty($tapahtuma['linkki'])) {
    print("<a href='".$tapahtuma['linkki']."' target=_blank>Linkki</a>");
  }

  // Osallistujat
  $ilmot = $tapahtuma['ilmot'];
  $paivittain = array();
  foreach($paivat as $paiva) {
    $paivittain[key($paiva)] = 0;
  }

  if (!empty($ilmot)) {
    print("<h5>Ilmoittautuneet</h5>");
    if ($tapahtuma['tyyppi'] == 'simple') { // simple
      print("<ul>\n");
      foreach($ilmot as $ilmo) {
        $tekija = $_SESSION['tekijat'][$ilmo['tekija']];
        print("<li>".$tekija['sukunimi']." ".$tekija['etunimi']."</li>");
      }
      print("</ul>");
    } else { // perus & kyyti
      print("<table class=ilmoittautuneet>");
      foreach($ilmot as $ilmo) {
        if (!$even) {
          print("<tr>");
          $even = true;
        } else {
          print("<tr class=even>");
          $even = false;
        }
        $tekija = $_SESSION['tekijat'][$ilmo['tekija']];
        print("<td class=ilmonimi>".$tekija['sukunimi']." ".$tekija['etunimi']."</td>");
        foreach($paivat as $paiva) {
          $ilmopaivat = explode(',',$ilmo['paivat']);
          if (in_array(key($paiva),$ilmopaivat)) {
            print("<td>".key($paiva)."</td>");
            $paivittain[key($paiva)]++; 
          } else {
            print("<td></td>");
          }
        }
        print("<td>".$ilmo['lisatiedot']."</td>");
        print("</tr>");
      }
      print("<tr>");
      print("<td><b>Yhteensä</b></td>");
      foreach($paivittain as $paiva) {
        print("<td><b>".$paiva."</b></td>");
      }
      print("</tr>");
      print("</table><br>\n");
    }
  }

  // Poissaolevat
  $pois = $tapahtuma['pois'];
  if (!empty($pois)) {
    print("<h5>Poissaolevat</h5>");
    print("<ul>\n");
    foreach($pois as $poi) {
      $tekija = $_SESSION['tekijat'][$poi['tekija']];
      print("<li>".$tekija['sukunimi']." ".$tekija['etunimi']."</li>");
    }
    print("</ul>");
  }

  print("</div>");
  print("</div>");
}

// Vanhat tapahtumat

if ($menneita) {
  print("<h2>Menneitä tapahtumia</h2>");
}

foreach($_SESSION['tapahtumat'] as $tapahtuma) {
  if (strtotime($tapahtuma['loppu']) >= strtotime(date('Y-m-d')) ) {
    continue;
  }
  $maara = sizeof($tapahtuma['ilmot']);
  $paivat = noudaPaivat($tapahtuma['alku'],$tapahtuma['loppu']);
  print("<div id=tapahtuma".$tapahtuma['id']." class=tapahtuma>\n");
  print("<table>\n");
  print("<tr><th class=otsikko>".$tapahtuma['nimi']." (".$maara.")<span>".$tapahtuma['id']."</span></th>");
  print("</tr>\n</table>\n");
  print("<div>");

  // Kuvaus
  print("<p>".$tapahtuma['kuvaus']."</p>");

  // Aika & Paikka
  print("<h5>Paikka & aika</h5>");
  print("<p>".$tapahtuma['paikka'].", ".Aika($tapahtuma['alku'])." - ".Aika($tapahtuma['loppu'])."</p>");

  // Linkki
  if (!empty($tapahtuma['linkki'])) {
    print("<a href='".$tapahtuma['linkki']."' target=_blank>Linkki</a>");
  }

  // Osallistujat
  $ilmot = $tapahtuma['ilmot'];
  $paivittain = array();
  foreach($paivat as $paiva) {
    $paivittain[key($paiva)] = 0;
  }
  if (!empty($ilmot)) {
    print("<h5>Ilmoittautuneet</h5>");
    if ($tapahtuma['tyyppi'] == 'simple') { // simple
      print("<ul>\n");
      foreach($ilmot as $ilmo) {
        $tekija = $_SESSION['tekijat'][$ilmo['tekija']];
        print("<li>".$tekija['sukunimi']." ".$tekija['etunimi']."</li>");
      }
      print("</ul>");
    } else { // perus & kyyti
      print("<table class=ilmoittautuneet>");
      foreach($ilmot as $ilmo) {
        if (!$even) {
          print("<tr>");
          $even = true;
        } else {
          print("<tr class=even>");
          $even = false;
        }
        $tekija = $_SESSION['tekijat'][$ilmo['tekija']];
        print("<td class=ilmonimi>".$tekija['sukunimi']." ".$tekija['etunimi']."</td>");
        foreach($paivat as $paiva) {
          $ilmopaivat = explode(',',$ilmo['paivat']);
          if (in_array(key($paiva),$ilmopaivat)) {
            print("<td>".key($paiva)."</td>");
            $paivittain[key($paiva)]++; 
          } else {
            print("<td></td>");
          }
        }
        print("<td>".$ilmo['lisatiedot']."</td>");
        print("</tr>");
      }
      print("<tr>");
      print("<td><b>Yhteensä</b></td>");
      foreach($paivittain as $paiva) {
        print("<td><b>".$paiva."</b></td>");
      }
      print("</tr>");
      print("</table><br>\n");
    }
  }

  // Poissaolevat
  $pois = $tapahtuma['pois'];
  if (!empty($pois)) {
    print("<h5>Poissaolevat</h5>");
    print("<ul>\n");
    foreach($pois as $poi) {
      $tekija = $_SESSION['tekijat'][$poi['tekija']];
      print("<li>".$tekija['sukunimi']." ".$tekija['etunimi']."</li>");
    }
    print("</ul>");
  }

  print("</div>");
  print("</div>");
}


?>
