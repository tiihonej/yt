<?php

print("<div id=paluumatka>");
print("<h2>Paluumatka</h2>");

if ( $omakyytip ) {
  print("<p>Olet ilmoittanut tarjoavasi yleisen kyydin.</p>");
} elseif ( $omakyytiinp ) {
  print("<p>Olet ilmoittautunut kyytiin</p>");
} elseif ( $omallap ) {
  print("<p>Olet ilmoittanut saapuvasi omalla kyydillä.</p>");
} else {
  print("<p>Ilmoittaudu yleiseen kyytiin tai luo sellainen itse. Jos yleisiä kyytejä ei ole tarjolla, odota kunnes joku sellaisen ilmoittaa. Jos taas tulet esim. junalla tai polkupyörällä etkä pysty tarjoamaan yleistä kyytiä, ilmoita saapuvasi omalla kyydillä.</p>");
}

print("<table class=kyytiheader><tr>");
if ( $omakyytip ) {
  print("<td class=enpaase><form action='".$paasivu."&amp;a=luokyyti' method=post>"
       ."<input type=hidden name=id value=".$tapahtuma['id'].">"
       ."<input type=hidden name=muokkaa value=1>"
       ."<input type=hidden name=kyyti value=".$_SESSION['tapahtumat'][$tapahtuma['id']]['p']['omakyyti'].">"
       ."<input type=hidden name=mp value=p>"
       ."<input type=submit value='Muokkaa omaa kyytiäsi' class=taulunappi></form></td>");
  print("<td class=peru><form action='".$paasivu."&amp;a=poistakyyti' method=post "
       ."onsubmit=\"return confirm('Haluatko varmasti poistaa kyytisi ja samalla "
       ."kyyti-ilmoittautumiset kaikilta siihen ilmoittautuneilta?')\">"
       ."<input type=hidden name=id value=".$_SESSION['tapahtumat'][$tapahtuma['id']]['p']['omakyyti'].">"
       ."<input type=submit value='Poista oma kyytisi' class=taulunappi></form></td>");
} elseif ( $omakyytiinp ) {
  print("<td class=peru><form action='".$paasivu."&amp;a=poistakyytiin' method=post "
       ."onsubmit=\"return confirm('Haluatko varmasti poistaa ilmoittautumisen kyytiin?')\">"
       ."<input type=hidden name=id value=".$_SESSION['tapahtumat'][$tapahtuma['id']]['p']['oma'].">"
       ."<input type=submit value='Peru kyyti-ilmoittautuminen' class=taulunappi></form></td>");
} elseif ( $omallap ) {
  print("<td class=peru><form action='".$paasivu."&amp;a=poistakyytiin' method=post "
       ."onsubmit=\"return confirm('Haluatko varmasti perua tulevasi omalla kyydillä?')\">"
       ."<input type=hidden name=id value=".$_SESSION['tapahtumat'][$tapahtuma['id']]['p']['omalla'].">"
       ."<input type=submit value='Peru tulevasi omalla kyydillä' class=taulunappi></form></td>");
} else {
  print("<td class=ilmoittaudu><form action='".$paasivu."&amp;a=luokyyti' method=post>"
       ."<input type=hidden name=id value=".$tapahtuma['id'].">"
       ."<input type=hidden name=mp value=p>"
       ."<input type=submit value='Luo uusi kyyti' class=taulunappi></form></td>");
  print("<td class=enpaase><form action='".$paasivu."&amp;a=kyytiin' method=post>"
       ."<input type=hidden name=id value=".$tapahtuma['id'].">"
       ."<input type=hidden name=tyyppi value=oma>"
       ."<input type=hidden name=mp value=p>"
       ."<input type=submit value='Tulen omalla kyydillä' class=taulunappi></form></td>");
}
print("</tr></table>");
print("<br>");

print("<h4>Yleiset paluukyydit</h4>");
if (empty($tapahtuma['p'])) {
  print("<p>Ei kyytejä.</p>");
} else {

foreach($tapahtuma['p'] as $id => $kyyti) {
  if ($id == 'oma' || $id == 'omalla' || $id == 'omakyyti') {
    continue;
  }
  $rundibussi = false;

  if ($kyyti['tekija'] == 0) {
    $rundibussi = true;
  }

  if ( $rundibussi ) {
    $kuski = array( 'etunimi'=>'Rundibussi', 'sukunimi'=>'' );
  } else {
    $kuski = $_SESSION['tekijat'][$kyyti['tekija']];
  }
  $maara = sizeof($kyyti['ilmot']);
  print("<div id=kyyti".$id." class=kyyti>\n");
  print("<table><tr>\n");
  print("<th class=otsikko>".$kyyti['paiva'].": ".$kuski['etunimi']." ".$kuski['sukunimi']." "
       ."(".$maara."/".$kyyti['tilaa'].") "
       ."<span>".$id."</span></th>");
  if ( !$omakyytip && !$omakyytiinp && !$omallap && $maara < $kyyti['tilaa'] ) {
    print("<td class=ilmoittaudu><form action='".$paasivu."&amp;a=kyytiin' method=post>"
         ."<input type=hidden name=id value=".$tapahtuma['id'].">"
         ."<input type=hidden name=tyyppi value=m>"
         ."<input type=hidden name=kyyti value=".$id.">"
         ."<input type=hidden name=mp value=p>"
         ."<input type=submit value='Ilmoittaudu' class=taulunappi></form></td>");
  }
  print("</tr>\n</table>\n");

  // ALAPALKKI

  print("<div>");

  if ($rundibussi) {
    print("<form action='tulosta&a=rundibussi' method=post>");
    print("<input type=hidden name=tapahtuma value=".$tapahtuma['id'].">");
    print("<input type=hidden name=mp value='p'>");
    print("<input type=hidden name=id value=".$kyyti['id'].">");
    print("<input type=submit value='Tulosta lista kyytiläisistä'>");
    print("</form>");
  }

  // Yhteystiedot
  if ( !$rundibussi ) {
    print("<h5>Yhteystiedot</h5>");
    print("<p>".$kuski['puhelin'].", ".$kuski['email']."</p>");
  }

  // Aika

  print("<h5>Aika & paikka</h5>");
  print("<p>".$kyyti['paiva']." ".$kyyti['aika'].", ".$kyyti['paikka']."</p>");  

  // Kyytilistaus

  print("<h5>Kyydissä</h5>");
  if (!empty($kyyti['ilmot'])) {
    print("<ul>");
    foreach($kyyti['ilmot'] as $ilmo) {
      $tekija = $_SESSION['tekijat'][$ilmo['tekija']];
      print("<li>".$tekija['etunimi']." ".$tekija['sukunimi']
           ."<span class=alueyhteys><i> - ".$tekija['email']."</i> <b>".$tekija['puhelin']."</b></span></li>");
    }
    print("</ul>");
  } else {
    print("<p>Ei kyytiläisiä.</p>");
  }

  // Lisätiedot

  if (!empty($kyyti['lisatiedot'])) {
    print("<h5>Lisätiedot</h5>");
    print("<p>".$kyyti['lisatiedot']."</p>");    
  }

  print("</div>");
  print("</div>");
}
}

// Kyytitilanne

if (!empty($_SESSION['tapahtumat'][$tapahtuma['id']]['puuttuu']['p'])) {
  print("<h4>Ei kyytiä</h4>");
  print("<p>");
  foreach( $_SESSION['tapahtumat'][$tapahtuma['id']]['puuttuu']['p'] as $kyyditon) {
    $tekija = $_SESSION['tekijat'][$kyyditon['tekija']];
    print($tekija['sukunimi']." ".$tekija['etunimi'].", ");
  }
  print("</p>");
}

if (!empty($_SESSION['tapahtumat'][$tapahtuma['id']]['omat']['p'])) {
  print("<h4>Omalla kyydillä</h4>");
  print("<p>");
  foreach( $_SESSION['tapahtumat'][$tapahtuma['id']]['omat']['p'] as $oma) {
    $tekija = $_SESSION['tekijat'][$oma['tekija']];
    print($tekija['sukunimi']." ".$tekija['etunimi'].", ");
  }
  print("</p>");
}

print("</div>");

?>
