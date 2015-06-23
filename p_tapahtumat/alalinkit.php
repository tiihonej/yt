<div class=alalinkit>

<h2>Suodata</h2>
<table><tr>

<?php

if (isset($_SESSION['sort']['f'])) {
  print("<td><a href='".$paasivu.$order.$sivu.$dir."'>Poista suodatus</a></td>");
}

print("<td><a href='".$paasivu.$order.$sivu.$dir."&amp;f=merkki'>Merkit</a></td>");
print("<td><a href='".$paasivu.$order.$sivu.$dir."&amp;f=pruju'>Prujut</a></td>");
print("<td><a href='".$paasivu.$order.$sivu.$dir."&amp;f=jasen'>Jäsenmaksut</a></td>");
print("<td><a href='".$paasivu.$order.$sivu.$dir."&amp;f=muu'>Muut</a></td>");
print("<td><a href='".$paasivu.$order.$sivu.$dir."&amp;f=siirto'>Siirrot</a></td>");

//print("<td><a href='tulosta&amp;p=".$paasivu."'>Tulostusnäkymä</a></td>");

?>

</tr></table>
</div>
