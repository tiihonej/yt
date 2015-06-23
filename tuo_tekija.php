<div id=tunnistaudu class=kokosivu>
<div class=centered>

<h2>Tuo käyttäjä</h2>

<form action=tuotu method=post id=tuoform>

<?php

include("lue_tuonti.php");

print("<select name=kantavalinta id=tuontivalinta>");
print("<option value=0> - valitse tietokanta - </option>");
foreach ($oldies as $pref => $oldie) {
  print("<option value=".$pref.">".$pref."</option>");
}
print("</select><br><br>");

foreach ($oldies as $pref => $oldie) {
  print("<select name=id".$pref." class=valitsetekija id=valitse".$pref.">");
  print("<option value=0> - valitse tekija - </option>");
  foreach ( $_SESSION['tuonti'][$pref] as $tekija ) {
    print("<option value=".$tekija['id'].">".$tekija['sukunimi']." ".$tekija['etunimi']."</option>");
  }
  print("</select>");
}

?>

<input type=hidden name=tekija value=0>
<div id=salasanakysely>
<p id=error></p>
<p>Salasana vanhaan tietokantaan:</p>
<input type=password name=salasana1>

<p id=error></p>
<p>Salasana uuteen tietokantaan:</p>
<input type=password name=salasana2><br>
<input class=tunnistaudu type=submit value='Tuo'>
</div>

</form>

</div>
</div>
