<?php
    //var_dump(http_response_code(204));
    include 'config.php';
    session_start();
    if(isset($_SESSION['correctInfo']) == false)
    {
      header('Location: ../Home');
    }
    else
    {
      if(isset($_POST['rules']))
      {
          $results = explode(",", $_POST['rules']);
          $output = "";
          foreach ($results as $value) {
            if($value != "")
            {
              exec("cat ".$snortUserAddedRulesDir."userAddedRules | grep '$value' >> ".$snortUserAddedRulesDir."saveChangesToRules");
            }
          }
          exec('cat '.$snortUserAddedRulesDir.'saveChangesToRules > '.$snortUserAddedRulesDir.'userAddedRules');
          exec('echo -n "" > '.$snortUserAddedRulesDir.'saveChangesToRules');
          exec('sudo /usr/bin/killall -9 snort');
          exec('sudo /usr/sbin/snort -i eth0 -c /etc/snort/snort.conf -l '.$snortLogsDir.' -A fast -d -D -u snort -g snort');
      }
      else {
        echo "ERROR";
      }
    }
 ?>
