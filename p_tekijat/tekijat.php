<?php include 'linkit.php' ?>

<div id=tekijat class=kokosivu>

<?php 

switch ($_GET['a']) {
//  case "muokkaa": include 'p_tekijat/muokkaa_jasen.php'; break;
//  case "lisaa": include 'p_tekijat/muokkaa_jasen.php'; break;
//  case "paivita": include 'p_tekijat/toteuta_jasen.php'; break;
//  case "toteuta": include 'p_tekijat/toteuta_jasen.php'; break;
//  case "poista": include 'p_tekijat/poista_jasen.php'; break;
  default: include 'p_tekijat/tulosta_lista.php'; break;
}

?>

</div>
