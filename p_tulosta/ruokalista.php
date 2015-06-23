<?php
session_start();

print("<h2>NääsPeksin tekijät</h2>\n");

print("<table class=eireunoja>");
print("<tr><th>#</th><th>Nimi</th><th>Opiskelija</th><th>Ei opiskelija</th></tr>\n\n");

$i = 1;
foreach($_SESSION['tekijat'] as $tekija) {
  print("<tr><td>".$i."</td><td>".$tekija['sukunimi']." ".$tekija['etunimi']."</td>");
  print("<td></td><td></td></tr>");
  $i++;
}
print("</table>");

?>


