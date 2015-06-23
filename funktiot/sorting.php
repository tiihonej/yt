<?php

// tämä tiedosto auttaa taulukoiden järjestämisen ja suodatuksen kanssa

unset($_SESSION['sort']);

// Suodatin

if (isset($_GET['f'])) {
  $_SESSION['sort']['f'] = $_GET['f'];
  $_SESSION['sort']['url']['f'] = "&amp;f=".$_GET['f'];
}

// Binäärisen suodattimen inverssi

if (isset($_GET['inv'])) {
  $_SESSION['sort']['inv'] = ($_GET['inv']) ? 1 : 0;
  $_SESSION['sort']['url']['inv'] = ($_GET['inv']) ? "&amp;inv=1" : "&amp;inv=0";
}

$_SESSION['sort']['iinv'] = ($_GET['inv']) ? 0 : 1;
$_SESSION['sort']['url']['iinv'] = ($_GET['inv']) ? "&amp;inv=0" : "&amp;inv=1";

// Järjestys

if (isset($_GET['s'])) {
  $_SESSION['sort']['s'] = $_GET['s'];
  $_SESSION['sort']['url']['s'] = "&amp;s=".$_GET['s'];
}

// Sivu

if (isset($_GET['p'])) {
  $_SESSION['sort']['p'] = $_GET['p'];
  $_SESSION['sort']['url']['p'] = "&amp;p=".$_GET['p'];
}

// Suunta

if (isset($_GET['d'])) {
  $_SESSION['sort']['d'] = ($_GET['d']) ? 1 : 0;
  $_SESSION['sort']['url']['d'] = ($_GET['d']) ? "&amp;d=1" : "&amp;d=0";
}

$_SESSION['sort']['id'] = ($_GET['d']) ? 0 : 1;
$_SESSION['sort']['url']['id'] = ($_GET['d']) ? "&amp;d=0" : "&amp;d=1";

?>
