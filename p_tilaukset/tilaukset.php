<?php include 'linkit.php' ?>

<div id=tilaukset class=kokosivu>

<?php 

include 'p_tilaukset/lue_kanta.php';

$sivu = $_GET['a'];
switch ($sivu) {
  case "tilaa": include 'p_tilaukset/tilauskysely.php'; break;
  case "lista": include 'p_tilaukset/lista.php'; break;
  case "vahvista_tilaus": include 'p_tilaukset/vahvista_tilaus.php'; break;
  case "peru": include 'p_tilaukset/peru.php'; break;
  default: include 'p_tilaukset/tuotteet.php'; break;
}

?>

</div>
