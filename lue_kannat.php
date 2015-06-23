<?php

require 'sorting.php';

if (!isset($_SESSION['jasenet']) or !isset($_SESSION['tapahtumat'])) {
  $_SESSION['update'] = 1;
}
$_SESSION['update'] = 1;
if ($_SESSION['update']) {
  include 'jasen/lue_kanta.php';
  include 'tapa/lue_kanta.php';
  include 'lisays/lue_kanta.php';
  $_SESSION['update'] = 0;
}

?>
