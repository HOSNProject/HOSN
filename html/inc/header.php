<?php
  include "../inc/config.php";
 ?>
<html>
    <head>
    <!--- Basics HTML5 --->
    <meta charset="utf-8">
    <meta name="auther" content="Yahya Alfaifi">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imgs/favicon.ico">
    <!--- My Code --->
    <title> HOSN </title>
    <link rel="icon" href="../inc/img/logoTab.png">
    <link rel="stylesheet" type="text/css" href="../inc/CSS/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <script src="../inc/js/sha512.js"></script>
    <script type="text/javascript" src="../inc/js/validationAndDynamicFormScript.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script type="text/javascript">
      function hashPassword()
      {
        var passField = document.getElementById('passwordField');
        passField.value = sha512(passField.value);
      }
</script>
    </head>

<body style="background-color: #efefef">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
   <a class="navbar-brand" href="../Home" style="padding:0px">
    <img src="../inc/img/logonav.png" width="45" height="45" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="homeMenu">
        <a class="nav-link" href="../Home" >Home<span class="sr-only">(current)</span></a>
      </li>
      <?php
        session_start();
        if(isset($_SESSION['correctInfo']) && $_SESSION['correctInfo'] == true)
        {
          echo
          '
          <li class="nav-item" id="settingsMenu">
            <a class="nav-link" href="../Setting">Setting</a>
          </li>
          <li class="nav-item" id="AddRulesMenu">
            <a class="nav-link" href="../IPS">Add Rules</a>
          </li>
          <li class="nav-item" id="MyRulesMenu">
            <a class="nav-link" href="../MyRules">My Rules</a>
          </li>
          <li class="nav-item" id="AnalyticsMenu">
            <a class="nav-link" href="../Analytics">Analytics <span class="badge badge-danger" >ALPHA</span></a>
          </li>
          ';
        }
       ?>
    </ul>
    <form style="margin:0px; margin-right: 10px" action="../Not" method="post">
      <?php
        $logsNum = exec('wc -l < '.$snortLogsDir.'alert');
        if($logsNum == "0")
        {
          if(isset($_SESSION['correctInfo']) && $_SESSION['correctInfo'] == false)
          {
            echo
            '
            <button type="submit" class="btn btn-link " style="margin-right: 1%;text-decoration: none;" disabled>
              <span class="fas fa-bell fa-1x" style="color:white"></span> <span class="badge badge-light">0</span>
            </button>
            ';
          }
          else
          {
            echo
            '
            <button type="submit" class="btn btn-link " style="margin-right: 1%;text-decoration: none;">
              <span class="fas fa-bell fa-1x" style="color:white"></span> <span class="badge badge-light">0</span>
            </button>
            ';
          }
        }
        else
        {
          if(isset($_SESSION['correctInfo']) && $_SESSION['correctInfo'] == false)
          {
            echo
            "
            <button type='submit' class='btn btn-link' style='margin-right: 1%;text-decoration: none;' disabled>
              <span class='fas fa-bell fa-1x' style='color:white'></span> <span class='badge badge-light'>$logsNum</span>
            </button>
            ";
          }
          else
          {
            echo
            "
            <button type='submit' class='btn btn-link' style='margin-right: 1%;text-decoration: none;'>
              <span class='far fa-bell fa-lg' style='color:white'></span> <span class='badge badge-light'>$logsNum</span>
            </button>
            ";
          }
        }
       ?>
   </form>
  <?php
    if(isset($_SESSION['correctInfo']) && $_SESSION['correctInfo'] == true)
    {
      echo
      '
      <form action="../inc/logout.php" style="margin:0px" method="post">
        <button class="btn btn-danger" type="submit" name="logout_btn">Logout</button>
      </form>
      ';
    }
    else
    {
      echo '
    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" style="margin-right: 50;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Log in
      </button>
      <form requireSSL="true" onsubmit="hashPassword()" class="dropdown-menu p-4" style="margin-left: -100%; margin-top: 10%;"   method="post" action="../inc/login.php">
      <div class="form-group">
        <label for="exampleDropdownFormEmail2">Username</label>
        <input name="username" type="text" class="form-control" id="exampleDropdownFormEmail2" placeholder="Username">
      </div>
      <div class="form-group">
        <label for="exampleDropdownFormPassword2">Password</label>
        <input id="passwordField" name="password" type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
      </div>
      <div class="form-check">
        <input name="rememberMe" type="checkbox" class="form-check-input" id="dropdownCheck2">
        <label class="form-check-label" for="dropdownCheck2">
          Remember me
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
  </div>
      ';
    }
   ?>
  </div>
</nav>
