<?php

switch ($_GET['sivu']) {
  case "oma": $paasivu = "oma"; include 'p_oma/oma.php'; break;
  case "tekijat": $paasivu = "tekijat"; include 'p_tekijat/tekijat.php'; break;
  case "tapahtumat": $paasivu = "tapahtumat"; include 'p_tapahtumat/tapahtumat.php'; break;
  case "alueet": $paasivu = "alueet"; include 'p_alueet/alueet.php'; break;
  case "tilaukset": $paasivu = "tilaukset"; include 'p_tilaukset/tilaukset.php'; break;
  case "poistu": include 'logout.php'; break;
  case "uusi": include 'uusi_tekija.php'; session_unset(); break;
  case "lisaa": include 'lisaa_tekija.php'; break;
  case "tuo": include 'tuo_tekija.php'; unset($_SESSION[$prefix.'_tekija']); break;
  case "tuotu": include 'tuotu_tekija.php'; break;
  // admin
  // case "admin": $paasivu = "admin"; include 'adm/admin.php'; break;
  // default
  default: include 'kuvaukset.php'; break;
}
?>
