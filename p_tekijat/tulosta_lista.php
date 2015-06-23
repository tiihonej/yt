<?php

$filter = $_SESSION['sort']['url']['f'];
$order = $_SESSION['sort']['url']['s'];
$dir = $_SESSION['sort']['url']['d'];
$idir = $_SESSION['sort']['url']['id'];
$iinv = $_SESSION['sort']['url']['iinv'];
$inv = $_SESSION['sort']['url']['inv'];
$sivu = $_SESSION['sort']['url']['p'];
$even = false;

include 'alalinkit.php';

print("<form action=tulosta&a=ruokalista method=post>");
print("<input type=submit value='Tulosta ruokalista'>");
print("</form>");

$p = Sivutus($_SESSION['tekijat'], $paasivu, $sivukoko, $_SESSION['sort']);

print("<table id=tekijataulu><tr>");
print("<th>#</th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=sukunimi'>Sukunimi</a></th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=etunimi'>Etunimi</a></th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=nick'>Lempinimi</a></th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=email'>Sähköposti</a></th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=puhelin'>Puhelin</a></th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=muokattu'>Muokattu</a></th>");
print("<th><a href='".$paasivu.$filter.$idir.$sivu.$inv."&amp;s=facebook'>FB</a></th>");
print("</tr>\n");

for ($i=$sivukoko*($p-1); $i<$sivukoko*$p;$i++) {
  if (isset($_SESSION['tekijat'][$_SESSION['idt'][$i]])) {
    $tekija = $_SESSION['tekijat'][$_SESSION['idt'][$i]];
  } else {
    break;
  }

  if (!$even) {
    print("<tr>");
    $even = true;
  } else {
    print("<tr class=even>");
    $even = false;
  }
  print("<td class=cent>".($i+1)."</td>");
  print("<td>".$tekija['sukunimi']."</td>"
       ."<td>".$tekija['etunimi']."</td>"
       ."<td>".$tekija['nick']."</td>"
       ."<td>".$tekija['email']."</td>"
       ."<td>".$tekija['puhelin']."</td>"
       ."<td class=cent>".substr($tekija['muokattu'],0,10)."</td>");
  if (!empty($tekija['facebook'])) {
    print("<td class=cent><a href='http://www.facebook.com/".$tekija['facebook']."' target=_blank><img src='fb.png'></a></td>");
  } else {
    print("<td></td>");
  }
  print("</tr>\n");
}

print("</table>\n\n");

Sivutus($_SESSION['tekijat'], $paasivu, $sivukoko, $_SESSION['sort']);

?>
