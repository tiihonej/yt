<?php include 'linkit.php' ?>

<div id=tapahtumat class=kokosivu>

<?php 

include 'p_tapahtumat/lue_kanta.php';

$sivu = $_GET['a'];
switch ($sivu) {
  case "allergiat": include 'p_tapahtumat/allergiat.php'; break;
  case "ilmoittaudu": include 'p_tapahtumat/ilmoittaudu.php'; break;
  case "peru": include 'p_tapahtumat/peru.php'; break;
  case "enpaase": include 'p_tapahtumat/enpaase.php'; break;
  case "perusilmo": include 'p_tapahtumat/perusilmo.php'; break;
  case "luokyyti": include 'p_tapahtumat/luokyyti.php'; break;
  case "lisaakyyti": include 'p_tapahtumat/lisaakyyti.php'; break;
  case "muokkaakyyti": include 'p_tapahtumat/muokkaakyyti.php'; break;
  case "kyytiin": include 'p_tapahtumat/kyytiin.php'; break;
  case "poistakyytiin": include 'p_tapahtumat/poistakyytiin.php'; break;
  case "poistakyyti": include 'p_tapahtumat/poistakyyti.php'; break;
  case "kyytikysely": include 'p_tapahtumat/kyytikysely.php'; break;
  default: include 'p_tapahtumat/tapahtumalista.php'; break;
}

?>

</div>
