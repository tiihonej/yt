<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="tyyli/tulostus.css">
<title>NääsPeksin yhteystietojärjestelmä</title>
</head>
<body>

<?php 

switch ($_GET['a']) {
  case "tilaukset": include 'p_tulosta/tilaukset.php'; break;
  case "ruokalista": include 'p_tulosta/ruokalista.php'; break;
  case "rundibussi": include 'p_tulosta/rundibussi.php'; break;
  default: include 'p_tulosta/takaisin.php'; break;
}

?>

</body>
</html>

