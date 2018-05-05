<?php
  var_dump(http_response_code(204));
  session_start();
  if(!isset($_SESSION['correctInfo']) || $_SESSION['correctInfo'] == false)
  {
    header('Location: ../Home');
  }
  else
  {
    system('sudo /sbin/reboot');
  }
 ?>
