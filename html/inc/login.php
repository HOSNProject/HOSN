<?php
  if(!isset($_POST['password']) || !isset($_POST['username']))
  {
    header("Location: ../Home");
    die();
  }
  session_start();
  $conn = new mysqli("localhost","IDS_IPS", "IDSIPSADMIN", "IDS_IPS");
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }
  $stat = $conn->prepare("SELECT username, password FROM admins WHERE username = ?");
  $stat->bind_param("s", $_POST["username"]);
  $stat->execute();
  $stat->bind_result($username, $password);
  $stat->fetch();
  if($password == $_POST['password'])
  {
    $_SESSION['username'] = $username;
    $_SESSION['correctInfo'] = true;
    header("Location: ../Home");
    session_write_close();
  }
  else
  {
    $_SESSION['correctInfo'] = false;
    header("Location: ../Home");
  }
 ?>
