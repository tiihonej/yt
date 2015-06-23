<div class=alalinkit>

<table><tr>

<?php 

// tähän jotain admin-touhuja sitten joskus?
if ($_SESSION['admin']) {
  print("</tr><tr><td><a href='".$paasivu."&amp;a=hallitsemerkit'>Hallitse merkkejä</a></td>");
  print("<td><a href='".$paasivu."&amp;a=hallitseprujut'>Hallitse prujuja</a></td>");
}

?>
</tr></table>
</div>
