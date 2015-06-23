<?php

if (isset($_POST['tekija'])) {
  $salasana = crypt($_POST['salasana'], $salt);

  if ( $salasana == $pass_yleis || $_POST['tekija'] == 0 ) {
    $_SESSION[$prefix.'_tekija'] = $_POST['tekija'];
//  } else if ( $salasana == $pass_admin ) {
//    $_SESSION['admin'] = 1;
  } else {
    print("<p>Virheellinen salasana!</p>");
  }
}

?>
