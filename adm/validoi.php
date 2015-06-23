<?php

$salasana = crypt($_POST['salasana'], $salt);

if ( $salasana == $pass_admin ) {
  print("Salasana oikein, tunnistautuminen onnistui!");
  $_SESSION['admin'] = 1;
} else {
  print("Virheellinen salasana!");
  include 'adm/tunnistaudu.php';
}


?>
