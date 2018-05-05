<?php
  //var_dump(http_response_code(204));
  session_start();
  if(!isset($_SESSION['correctInfo']) && $_SESSION['correctInfo'] == false)
  {
    header('Location: ../Home');
  }
  else
  {
    $conn = new mysqli("localhost","IDS_IPS", "IDSIPSADMIN", "IDS_IPS");
    if ($conn->connect_errno) {
        echo "No";
        return;
    }
    if(isset($_POST['passwordField']) && $_POST['usernameField'])
    {
      $stat = $conn->prepare("update admins set password='".$_POST['passwordField']."', username='".$_POST['usernameField']."' where username='".$_SESSION['username']."'");
      $_SESSION['username'] = $_POST['usernameField'];
      $stat->execute();
      echo "Yes";
    }
  }
 ?>
