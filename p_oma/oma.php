<?php include 'linkit.php' ?>

<div id=oma class=kokosivu>

<?php 

include 'p_oma/lue_kanta.php';

switch ($_GET['a']) {
  case "muokkaa": include 'p_oma/muokkaa.php'; break;
  case "toteuta": include 'p_oma/toteuta.php'; break;
  case "poista": include 'p_oma/poista.php'; break;
  default: include 'p_oma/yhteenveto.php' ; break;
}

?>

</div>
