<?php 
$tapahtumaid = $_POST['id'];
$id = $tekija['id'];
$tapahtuma = $_SESSION['tapahtumat'][$tapahtumaid];

switch ($tapahtuma['tyyppi'] ) {
  case 'simple': include "p_tapahtumat/simpleilmo.php"; break;
  case 'perus': include "p_tapahtumat/peruskysely.php"; break;
  case 'kyyti': include "p_tapahtumat/peruskysely.php"; break;
}

?>
