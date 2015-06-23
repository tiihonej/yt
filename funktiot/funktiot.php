<?php 

function LisaaTekija($l, $table, $etunimi, $sukunimi, $lempinimi, $email, $puhelin, $allergiat) {
  if ($_SESSION['omstart']) { return false; }
  $q = "INSERT INTO ".$table." (etunimi, sukunimi, nick, email, puhelin, allergiat, muokattu, facebook) "
      ."VALUES ('".$etunimi."','".$sukunimi."','".$lempinimi."','"
      .$email."','".$puhelin."','".$allergiat."',CURRENT_TIMESTAMP(), '');";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function LisaaAlueilmo($l, $table, $id, $alue) {
  if ($_SESSION['omstart']) { return false; }
  $q = "INSERT INTO ".$table." (tekija, alue, pvm) "
      ."VALUES (".$id.", ".$alue.",CURRENT_TIMESTAMP());";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function LisaaTilaus($l, $table, $id, $tuote, $koko, $maara, $selite) {
  if ($_SESSION['omstart']) { return false; }
  $q = "INSERT INTO ".$table." (tekija, tuote, koko, maara, selite, pvm) "
      ."VALUES (".$id.", ".$tuote.", '".$koko."', ".$maara.", '".$selite."',CURRENT_TIMESTAMP());";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function LisaaKyytiin($l, $table, $mp, $id, $kyyti, $tapahtuma) {
  if ($_SESSION['omstart']) { return false; }
  $q = "INSERT INTO ".$table." (mp, tekija, kyyti, tapahtuma, pvm) "
      ."VALUES ('".$mp."', ".$id.", ".$kyyti.", ".$tapahtuma.",CURRENT_TIMESTAMP());";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function LisaaKyyti($l, $table, $tekija, $tapahtuma, $mp, $tilaa, $paiva, $aika, $paikka, $lisatiedot) {
  if ($_SESSION['omstart']) { return false; }
  $q = "INSERT INTO ".$table." (tekija, tapahtuma, mp, tilaa, paiva, aika, paikka, lisatiedot) "
      ."VALUES (".$tekija.", ".$tapahtuma.", '".$mp."', ".$tilaa.", '".$paiva."',"
      ." '".$aika."', '".$paikka."', '".$lisatiedot."');";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function LisaaTapahtumailmo($l, $table, $tyyppi, $id, $tapahtuma, $paivat, $lisatiedot) {
  if ($_SESSION['omstart']) { return false; }
  foreach ($paivat as $paiva) {
    $pv = $pv.$paiva.",";
  }
  $q = "INSERT INTO ".$table." (tyyppi, tekija, tapahtuma, paivat, lisatiedot, pvm) "
      ."VALUES ('".$tyyppi."',".$id.", ".$tapahtuma.", '".$pv."', '".$lisatiedot."', "
      ."CURRENT_TIMESTAMP());";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function LueTekija($l, $table, $id) {
  $q = "SELECT * FROM ".$table." WHERE id='".$id."'";
  $r = mysqli_query($l, $q) or die('Köyrintä epäonnistui');
  while ($data = mysqli_fetch_array($r, MYSQL_ASSOC)) {
    $tekija = $data;
  }
  return $tekija;
}

function PaivitaTekija($l, $table, $id, $etunimi, $sukunimi, $lempinimi, $email, $puhelin, $allergiat, $facebook) {
  if ($_SESSION['omstart']) { return false; }
  $q = "UPDATE ".$table." SET "
      ."etunimi='".$etunimi."', "
      ."sukunimi='".$sukunimi."', "
      ."nick='".$lempinimi."', "
      ."email='".$email."', "
      ."puhelin='".$puhelin."', "
      ."facebook='".$facebook."', "
      ."allergiat='".$allergiat."' "
      ."WHERE id=".$id.";";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function PoistaAlkio($l, $table, $id) {
  if ($_SESSION['omstart']) { return false; }
  $q = "DELETE FROM ".$table." WHERE id=".$id.";";
  $r = mysqli_query($l, $q) or die("poistaminen ei onnistunut");
  return true;
}

function PoistaEhdolla($l, $table, $kentta, $arvo) {
  if ($_SESSION['omstart']) { return false; }
  $q = "DELETE FROM ".$table." WHERE ".$kentta."=".$arvo.";";
  $r = mysqli_query($l, $q) or die("poistaminen ei onnistunut");
  return true;
}

function PaivitaKyyti($l, $table, $id, $tilaa, $aika, $paikka, $lisatiedot) {
  if ($_SESSION['omstart']) { return false; }
  $q = "UPDATE ".$table." SET "
      ."tilaa=".$tilaa.", "
      ."aika='".$aika."', "
      ."paikka='".$paikka."', "
      ."lisatiedot='".$lisatiedot."' "
      ."WHERE id=".$id.";";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}

function TuoTekija($l, $table, $etunimi, $sukunimi, $lempinimi, $email, $puhelin, $allergiat, $facebook) {
  if ($_SESSION['omstart']) { return false; }
  $q = "INSERT INTO ".$table."
       (etunimi, sukunimi, nick, email, puhelin, allergiat, muokattu, facebook) "
      ."VALUES ('".$etunimi."','".$sukunimi."','".$lempinimi."','"
      .$email."','".$puhelin."','".$allergiat."',CURRENT_TIMESTAMP(),'".$facebook."');";
  $r = mysqli_query($l, $q) or die("tietokantavirhe");
  return true;
}


// Viikonpäivät

function Viikko() {
  $viikko = array(1=>array("ma"=>"maanantai"),2=>array("ti"=>"tiistai"),3=>array("ke"=>"keskiviikko"),
                  4=>array("to"=>"torstai"),5=>array("pe"=>"perjantai"),6=>array("la"=>"lauantai"),
                  7=>array("su"=>"sunnuntai") );
  return $viikko;
}

function NoudaPaivat($alku, $loppu) {
  $paivat = array();
  $viikko = Viikko();

  // alkupäivä
  $alkupv = date("N", strtotime($alku));
  $i = 1;
  while ($i < $alkupv) {
    next($viikko);
    $i++;
  }
  $paivat[0] = current($viikko);

  // loppupäivä
  $aika = strtotime($alku) + (60*60*24);
  while ($aika <= strtotime($loppu)) {
    if (current($viikko) != array("su"=>"sunnuntai")) {
      $paivat[] = next($viikko);
    } else {
      reset($viikko);
      $paivat[] = current($viikko);
    }
    $aika = $aika + (60*60*24);
  }

  return $paivat;
}

// Järkevä aikaformaatti

function Aika($pvm) {
  $aika = date("j.n.", strtotime($pvm));
  return $aika;
}

// Sivutusfunktio

function Sivutus($data, $paasivu, $sivukoko, $sort) {
  $filter = $sort['url']['f'];
  $order = $sort['url']['s'];
  $dir = $sort['url']['d'];
  $invdir = $sort['url']['id'];
  $inv = $sort['inv'];
  $sivu = $sort['url']['p'];

  $pgs = ceil(sizeof($data)/$sivukoko);
  if (isset($_SESSION['sort']['p'])) {
    $p = $_SESSION['sort']['p'];
    if ($p > $pgs) {
      $p = $pgs;
    }
  } else {
    $p = 1;
  }

  print("<table class=sivutus><tr>\n");

  if ($p == 1) {
    print("<td><a></a></td>");
  } else {
    print("<td><a href='".$paasivu.$order.$filter.$dir."&amp;p=".($p-1)."'>&lt;-</a></td>\n");
  }

  for ($i=1; $i<=$pgs; $i++) {
    if ($i == $p) {
      print("<td class=valittu><a href='".$paasivu.$order.$filter.$dir."&amp;p=".($i)."'>".$i."</a></td>\n");
    } else {
      print("<td><a href='".$paasivu.$order.$filter.$dir."&amp;p=".($i)."'>".$i."</a></td>\n");
    }
  }

  if ($p >= $pgs) {
    print("<td><a></a></td>");
  } else {
    print("<td><a href='".$paasivu.$order.$filter.$dir."&amp;p=".($p+1)."'>-></a></td>\n");
  }

  print("</tr></table>\n");

  return $p;
}

?>
