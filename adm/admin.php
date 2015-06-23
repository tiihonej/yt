<?php include 'linkit.php' ?>

<div id=admin class=kokosivu>

<?php 

switch ($_GET['a']) {
  case "logout": include 'adm/logout.php'; break;
  case "validoi": include 'adm/validoi.php'; break;
  default: include 'adm/tunnistaudu.php'; break;
}

?>

</div>
