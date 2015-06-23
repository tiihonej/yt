<?php

if ($_SESSION['admin'] == 1) {
  print("<h2>Kirjaudu ulos</h2>");
  print("<form action='".$paasivu."&amp;a=logout'>");
  print("<input type=submit value='Kirjaudu ulos'>");
  print("</form>");
} else {
  print("<h2>Tunnistaudu</h2>");
  print("<form action='".$paasivu."&amp;a=validoi' method=post>");
  print("<input type=password name=salasana><br>");
  print("<input type=submit value='Tunnistaudu'>");
  print("</form>");
}

?>
