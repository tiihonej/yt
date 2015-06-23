<?php include 'linkit.php' ?>

<div id=alueet class=kokosivu>
<h2>Osa-alueet</h2>

<?php 

include 'alalinkit.php';
include 'lue_kanta.php';

switch ($_GET['a']) {
  case "ilmoittaudu": include 'p_alueet/ilmoittaudu.php'; break;
  case "peru": include 'p_alueet/peru.php'; break;
  default: include 'p_alueet/nimilistat.php'; break;
}

?>

</div>
