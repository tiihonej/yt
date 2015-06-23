<div id=tunnistaudu class=kokosivu>
<div class=centered>

<h2>Tunnistaudu</h2>

<form action=uusi method=post>
<input type=hidden name=tekija value=0>
<input type=submit value="Luo uusi käyttäjä">
</form>
<form action=tuo method=post>
<input type=hidden name=tekija value=0>
<input type=submit value="Tuo käyttäjä">
</form>

<form action=./ method=post id=tunnistauduform>

<hr><h4>Valitse, kuka olet</h4>

<?php

print("<table id=tunnistaudutable><tr>");
if (!empty($_SESSION['tekijat'])) {
  $rivilla = 6;
  $riveja = ceil(sizeof($_SESSION['tekijat'])/$rivilla);
  $tekijat = array();
  $paikka = 1;
  $i = 0;
  foreach($_SESSION['idt'] as $id) {
    if ( $i >= $riveja) {
      $i = 0;
      $paikka++;
    }
    $rivit[$i][$paikka] = $_SESSION['tekijat'][$id];
    $i++;
  }
  foreach($rivit as $rivi) {
    print("<tr>");
    foreach ( $rivi as $tekija ) {
      print("<td class=tavis id=tekija".$tekija['id'].">\n");
      print("<input type=radio name=tekija value=".$tekija['id'].">".$tekija['sukunimi']." ".$tekija['etunimi']);
      print("\n</td>\n");
    }
    print("</tr>");
  }
}

print("</tr></table>");

?>

<p id=error></p>
<p>Rainasalasana:
<input type=password name=salasana>
<input class=tunnistaudu type=submit value='Tunnistaudu'></p>

</form>

</div>
</div>
