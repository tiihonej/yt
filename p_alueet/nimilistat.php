<?php

unset($_SESSION['omstart']);

foreach($_SESSION['alueet'] as $alue) {
  $maara = sizeof($alue['ilmot']);
  print("<div id=alue".$alue['id']." class=alue>\n");
  print("<table>\n");
  print("<tr><th class=otsikko>".$alue['nimi']." (".$maara.")<span>".$alue['id']."</span></th>");

  // ilmoittaudu / peru
  if ( in_array($alue['id'], $_SESSION['omatalueet']) ) {
    print("<td class=peru><form action='".$paasivu."&amp;a=peru' method=post>");
    print("<input type=hidden name=id value=".array_search($alue['id'],$_SESSION['omatalueet']).">");
    print("<input type=submit class=taulunappi value='Peru ilmoittautuminen'>");
    print("</form></td>\n");
  } else {
    print("<td class=ilmoittaudu><form action='".$paasivu."&amp;a=ilmoittaudu' method=post>");
    print("<input type=hidden name=id value=".$alue['id'].">");
    print("<input type=submit class=taulunappi value=Ilmoittaudu>");
    print("</form></td>\n");
  } 
  print("</tr>\n</table>\n");

  print("<div>");
  // pomo
  if ($alue['pomo'] > 0) {
    if ($alue['pomo2'] > 0) {
      print("<h5>Pomot</h5>");
    } else {
      print("<h5>Pomo</h5>");
    }
    print("<ul>\n");
    $pomo = $_SESSION['tekijat'][$alue['pomo']];
    print("<li>".$pomo['sukunimi']." ".$pomo['etunimi']
           ."<span class=alueyhteys><i> - ".$pomo['email']."</i> <b>".$pomo['puhelin']."</b></span></li>");
    if($alue['pomo2'] > 0) {
      $pomo = $_SESSION['tekijat'][$alue['pomo2']];
    print("<li>".$pomo['sukunimi']." ".$pomo['etunimi']
           ."<span class=alueyhteys><i> - ".$pomo['email']."</i> <b>".$pomo['puhelin']."</b></span></li>");
    }
    if($alue['pomo3'] > 0) {
      $pomo = $_SESSION['tekijat'][$alue['pomo3']];
    print("<li>".$pomo['sukunimi']." ".$pomo['etunimi']
           ."<span class=alueyhteys><i> - ".$pomo['email']."</i> <b>".$pomo['puhelin']."</b></span></li>");
    }
    print("</ul>");
  }

  // tekijät

  $ilmot = $alue['ilmot'];
  if (empty($ilmot)) {
    print("<p>Osa-alueeseen ei ilmoittautuneita.</p>\n");
  } else {
    print("<h5>Ilmoittautuneet</h5>");
    print("<ul>\n");
    foreach($ilmot as $ilmo) {
      print("<li>".$ilmo['sukunimi']." ".$ilmo['etunimi']
           ."<span class=alueyhteys><i> - ".$ilmo['email']."</i> <b>".$ilmo['puhelin']."</b></span></li>");
    }
    print("</ul>");
  }
  print("</div>");
  print("</div>");
}

?>
