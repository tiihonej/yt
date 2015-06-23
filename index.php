<?php
  session_start();
  if($_GET['sivu'] == 'kayttoehdot') {
    include 'kayttoehdot.php';
    return;
  } elseif($_GET['sivu'] == 'tulosta') {
    include 'p_tulosta/tulosta.php';
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/scripts.js"></script>
<link rel="stylesheet" type="text/css" href="tyyli/yleinen.css">
<link rel="stylesheet" type="text/css" href="tyyli/osiot.css">
<title>NääsPeksin yhteystietojärjestelmä</title>
</head>
<body>

<div id=logo>
<a href=./></a>
</div>

<div id=boksi>

<?php

  // luetaan tarvittavat funktiot
  require 'asetukset.php';
  require 'funktiot/funktiot.php';
  require 'funktiot/sorting.php';

  // validoidaan käyttäjä
  require 'validoi.php';

  // näytetään joko sisältö tai annetaan mahdollisuus tunnistautua
  if (isset($_SESSION[$prefix.'_tekija'])) {
    require 'p_tekijat/lue_kanta.php';
    $tekija = $_SESSION['tekijat'][$_SESSION[$prefix.'_tekija']];
    require 'sisalto.php';
  } else {
    require 'p_tekijat/lue_kanta.php';
    require 'tunnistaudu.php';
  }
?>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
